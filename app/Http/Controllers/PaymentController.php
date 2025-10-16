<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Emailqueue;
use App\Models\Billing;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\Newpurchase;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function paymentgateway(Request $request){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('fail')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->cartTotals
                    ]
                ]
            ]
        ]);

        //dd($response);
        //dd(config('paypal'));
        if ( isset($response['id']) && $response['id']!=null ) {
            foreach($response['links'] as $link){
                if ( $link['rel']=='approve' ) {
                    return redirect()->away($link['href']);
                }
            }
        }else {
            return redirect()->route('fail');
        }
    }

    public function status(){
        $promotion = Product::where('prod_Percent_discount', '>', 0)->get()->toArray();

        if (session()->get('payment_status')=='success' ) {
            return view('payment.status',[
                'status' => 'success',
                'purchaseLists' => $this->getPurchasedItems(),
                'promotions' => $promotion,
                'canonical_url' => url()->current(),
            ]);
        }else if (session()->get('payment_status')=='fail' ) {
            return view('payment.status',[
                'status' => 'fail',
                'promotions' => $promotion,
                'canonical_url' => url()->current(),
            ]);
        }else{
            return view('payment.status',[
                'status' => 'noPayment',
                'promotions' => $promotion,
                'canonical_url' => url()->current(),
            ]);
        }
        
        
    }
    public function success(Request $request){
        // $subject = "";
        // $body = "";
        $name = "";
        $to_email = "";
        
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);
        //dd($response["status"]==="COMPLETED");
        
        //dd($response);

        if ( isset($response['status']) && $response['status']=="COMPLETED") {
            //$payer_name = $response['name']['given_name'].' '.$response['name']['surname'];
            Payment::create([
                'bill_orderid' => session()->get('orderId'),
                'pay_paidamount'  => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
                'pay_netpay'  => $response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['net_amount']['value'],
                'pay_currency'  => $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'],
                'pay_payerid'  => $response['payer']['payer_id'],
                'pay_payername'  => $response['payer']['name']['given_name'].' '.$response['payer']['name']['surname'],
                'pay_payerEmail' =>  $response['payer']['email_address'],
                'pay_payercountry' =>  $response['payer']['address']['country_code'],
                'pay_transactionid' =>  $response['id'],
                'pay_paymentstatus' =>  $response['status'],
                'pay_paymentsource' =>  'paypal'

            ]);
            //update bill status
            Billing::where('bill_orderid',session()->get('orderId'))
                ->update([
                    'bill_status' => 'PAID',
                    'downloadlink_status' => 1
                ]);
           
            //populate email queue;
            $this->populateEmailqueue($response['payer']['email_address'], "Subject", "Body");
            $this->populateEmailqueue('mwaurakelvinn@gmail.com', "Subject", "Body");

             //Destroy session variables
             $this->destroySessionVars();

             //set access session variables
             session()->put('payment_status', 'success');

            //Send mail
            // $subject = "subject";
            // $url = "";
            $name = $response['payer']['name']['given_name'].' '.$response['payer']['name']['surname'];
            $to_email = $response['payer']['email_address'];

            $this->sendMail($name, $to_email);
            //sendMail($subject, $body, $name);
            
            return redirect()->to('/payment/status');

        }else{
            return redirect()->route('fail');
        }

        
    }

    public function fail(Request $request){
        session()->put('payment_status', 'fail');
        return redirect()->to('/payment/status');
    }

    public function destroySessionVars(){
        //session()->forget('orderId');
        session()->forget('cartTotals');

        for ($i=0; $i < 10; $i++) { 
            $session_name = "cart".$i;

            if( session()->get($session_name) !=null ){
                session()->forget($session_name);
            }
        }

    }
    public function getPurchasedItems(){
        $purchaseLists = [];
        $counter = 0;
        if( session()->get('orderId')!=null ){
            $purchasedItems = Billing::where('bill_orderid', session()->get('orderId') )->get()->toArray();

            if( $purchasedItems!=null ){
                foreach($purchasedItems as $purchasedItem){
                    $purchaseLists[$counter]['id'] = $purchasedItem['bill_prodid'];
                    $purchaseLists[$counter]['title'] = Product::find($purchaseLists[$counter]['id'])->prod_title;
                    $counter++;
                }
            }
        }
        return $purchaseLists;
    }
    public function populateEmailqueue($email, $subject, $body){
        Emailqueue::create([
            'email_email' => $email,
            'email_subject' =>$subject,
            'email_body' => $body,
            'email_type' => 'New sale',
            'email_status' => 0,
            'email_retry' => 0,
        ]);
    }

    public function sendMail($name, $to_email){

        $records = Billing::where('bill_orderid', session()->get('orderId'))->get()->toArray();
        $urls = [];
        $counter = 0;
        foreach ($records as $record) {
            $urls[$counter]['link'] = $record['downloadlink'];
            $urls[$counter]['prodTitle'] = Product::find($record['bill_prodid'])['prod_title'];
            $counter++;
        }

        if ( count($records)==1){
            $subject = 'Document Purchased:'. $urls[0]['prodTitle'].'-'.session()->get('orderId');
        }else{
            $subject = 'Documents Purchased at Gradestar Solutions - '.session()->get('orderId');
        }
        
        //Send email to customer
        mail::to($to_email)
        ->send(new Newpurchase($subject, $urls, $name));

        //Alert Admin of a new sale
        mail::to("kevohmwach@gmail.com")
        ->send(new Newpurchase("Document Sold", $urls, "Kelvin"));

    }
    
}
