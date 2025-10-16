<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Billing;
use Illuminate\Support\Str;

class BillingController extends Controller
{
    public function index(){
        return view('billing.index',[
            'canonical_url' => url()->current(),
        ]);
    }
    public function transactions(){
        return view('billing.transactions',[
            'canonical_url' => url()->current(),
        ]);
    }

    public function checkout(){

        // return view ('billing.checkout', [
        //     //'dataArray' => $dataArray,
        //     //'cartTotals' => $cartTotals
        // ]);
        $promotion = Product::where('prod_Percent_discount', '>', 0)->get()->toArray();
        
        $dataArray = [];
        $cartTotals = 0;
        for ($i=0; $i < 10; $i++) { 
            $session_name = "cart".$i;

            $id = session()->get($session_name);
            if($id){
                $item =Product::find($id);
                $dataArray[$i]['id']= $item->id;
                $dataArray[$i]['user_id']= $item->user_id;
                $dataArray[$i]['prod_title']= $item->prod_title;
                $dataArray[$i]['slug']= $item->slug;
                $dataArray[$i]['prod_description']= $item->prod_description;
                $dataArray[$i]['prod_category']= $item->prod_category;
                $dataArray[$i]['prod_isbn']= $item->prod_isbn;
                $dataArray[$i]['prod_course']= $item->prod_course;

                $dataArray[$i]['prod_file']= $item->prod_file;
                $dataArray[$i]['prod_image']= $item->prod_image;
                $dataArray[$i]['prod_preview']= $item->prod_preview;
                $dataArray[$i]['prod_actualPrice']= $item->prod_actualPrice;
                $dataArray[$i]['prod_disctPrice']= $item->prod_disctPrice;
                $dataArray[$i]['prod_Percent_discount']= $item->prod_Percent_discount;
                $dataArray[$i]['prod_keyword1']= $item->prod_keyword1;
                $dataArray[$i]['prod_keyword2']= $item->prod_keyword2;
                $dataArray[$i]['prod_keyword3']= $item->prod_keyword3;
                $dataArray[$i]['prod_views']= $item->prod_views;

                //$cartTotals = $cartTotals+$item->prod_disctPrice;
                if($item->prod_Percent_discount > 0){
                    $cartTotals = $cartTotals+ (round($item->prod_actualPrice * (1-($item->prod_Percent_discount*0.01)),2) );
                }else{
                    $cartTotals = $cartTotals+ $item->prod_actualPrice;
                }

            }
        }
        session()->put('cartTotals', $cartTotals);

        return view ('billing.checkout', [
            'dataArray' => $dataArray,
            'cartTotals' => $cartTotals,
            'promotions' => $promotion,
            'canonical_url' => url()->current(),
        ]);
    }

    public function store(){
        $data= request()->validate([
            'bill_name' => 'required',
            'bill_email' => 'required',
            'bill_address' => 'required',
        ]);
        $orderId = 'GS-'.Str::random(5);
        session()->put('orderId', $orderId);


        for ($i=0; $i < 10; $i++) { 
            $session_name = "cart".$i;

            $id = session()->get($session_name);
            if($id){
                $item =Product::find($id);
                Billing::create([
                    'bill_name' => $data['bill_name'],
                    'bill_email' => $data['bill_email'],
                    'bill_address' => $data['bill_address'],
        
                    'bill_orderid' => $orderId,
                    'bill_prodid' => $item['id'],
                    'bill_authorid' => $item['user_id'],
                    'bill_status' => 0,
                    'downloadlink' => '/file/download/'.$orderId.'/'.$item['id'].'/'.$item['prod_title'],
                    'downloadlink_status' => 0,
                    'downloadlink_views' => 0,
                ]);
            }
        }

        //set payment session
        return redirect()->to('/checkout')->with([
            'payment_ready' => TRUE,
            'cartTotals' => session()->get('cartTotals')
        ]);
        
        //dd($data);
    }
    public function retryPayment(){
        return redirect()->to('/checkout')->with([
            'payment_ready' => TRUE,
            'cartTotals' => session()->get('cartTotals')
        ]);
    }
}
