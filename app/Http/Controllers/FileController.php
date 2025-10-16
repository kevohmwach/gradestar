<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Product;
use File;
use Response;

class FileController extends Controller
{
    public function checkInput($data) {
    
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES);
        return $data;
    }

    public function download($orderRef, $id){
        $id = filter_var(($this->checkInput( $id)),FILTER_SANITIZE_NUMBER_INT);
        $orderRef = filter_var($this->checkInput( $orderRef),FILTER_SANITIZE_STRING);
        
        $product = Billing::where('bill_orderid', $orderRef)
                            ->where('bill_status','PAID')
                            ->where('bill_prodid', $id)
                            ->where('downloadlink_status', 1)
                            ->where('downloadlink_views', '<', 3)
                            ->get();
        if( $product->count() ){
            //show file
            $data =  Product::find($id);
            $file_path = $data['prod_file'];

            $complete_path = storage_path('app/public/'.$file_path);
            
            if (!file_exists($complete_path)) {
                //return response()->json(['error' => 'File not found.'], Response::HTTP_NOT_FOUND);
                return response('Error: Document not found');
            }

            $file = File::get($complete_path);
            $response = Response::make($file, 200);
            $response->header('Content-Type', 'application/pdf');
            return $response;

        }else{
            return response ('Error: No record found or download link has expired');
        }

    }

    public function showPdfFile($id){
        $data =  Product::find($id);
        $file_path = $data['prod_file'];

        $complete_path = storage_path('app/public'.$file_path);
        
        
        // if (!Auth::check()) {
        //     return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        // }
        if (!file_exists($complete_path)) {
            //return response()->json(['error' => 'File not found.'], Response::HTTP_NOT_FOUND);
            return response('Error: Document not found');
        }
        //dd($complete_path);

        $file = File::get($complete_path);
        $response = Response::make($file, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }
}
