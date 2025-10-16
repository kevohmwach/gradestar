<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('product.create');
    }

    public function edit($id){
        $product = Product::find($id);

        return view('product.edit', compact('product'));
    }

    public function store(){

        $data= request()->validate([
            'prod_title' => 'required',
            'prod_description' => 'required',
            'prod_category' => 'required',
            'prod_isbn' => '',
            'prod_Percent_discount' => '',
            'prod_course' => 'required',
            'prod_actualPrice' => 'required',
            'prod_extraContent' => 'required',
            //'prod_preview' => 'required',
            'prod_keywords' => 'required',
            'prod_file' => ['required','mimes:pdf'],
            'prod_image' => ['required','image','mimes:jpeg,jpg,png,gif,svg'],
            'prod_preview' => ['required','mimes:pdf'],
            'prod_meta_title' => 'required',
            'prod_meta_description' => 'required',
            'prod_overview1_h2' => '',
            'prod_overview1_descriprion' => '',
            'prod_overview2_h2' => '',
            'prod_overview2_descriprion' => '',
            'prod_overview3_h2' => '',
            'prod_overview3_descriprion' => '',
            'prod_overview4_h2' => '',
            'prod_overview4_descriprion' => '',
            'prod_overview5_h2' => '',
            'prod_overview5_descriprion' => '',
            'prod_overview6_h2' => '',
            'prod_overview6_descriprion' => '',
            'prod_overview7_h2' => '',
            'prod_overview7_descriprion' => '',
        ]);
        $prod_file_path = request('prod_file')->store('uploads/docs','public');
        $prod_image_path = request('prod_image')->store('uploads/images','public');
        $prod_preview_path = request('prod_preview')->store('uploads/docs','public');

        
        auth()->user()->products()->create([
            'prod_title' => $data['prod_title'],
            'prod_description' => $data['prod_description'],
            'prod_category' => $data['prod_category'],
            'prod_isbn' => $data['prod_isbn'],
            'prod_course' => $data['prod_course'],
            'prod_actualPrice' => $data['prod_actualPrice'],
            'prod_Percent_discount' => $data['prod_Percent_discount'],
            'prod_keywords' => $data['prod_keywords'],
            //'prod_preview' => $data['prod_preview'],
            'prod_extraContent' => $data['prod_extraContent'],
            'prod_file' => $prod_file_path,
            'prod_image' => $prod_image_path,
            'prod_preview' => $prod_preview_path,
            'prod_meta_title' => $data['prod_meta_title'],
            'prod_meta_description' => $data['prod_meta_description'],
            'prod_overview1_h2' => $data['prod_overview1_h2'],
            'prod_overview1_descriprion' => $data['prod_overview1_descriprion'],
            'prod_overview2_h2' => $data['prod_overview2_h2'],
            'prod_overview2_descriprion' => $data['prod_overview2_descriprion'],
            'prod_overview3_h2' => $data['prod_overview3_h2'],
            'prod_overview3_descriprion' => $data['prod_overview3_descriprion'],
            'prod_overview4_h2' => $data['prod_overview4_h2'],
            'prod_overview4_descriprion' => $data['prod_overview4_descriprion'],
            'prod_overview5_h2' => $data['prod_overview5_h2'],
            'prod_overview5_descriprion' => $data['prod_overview5_descriprion'],
            'prod_overview6_h2' => $data['prod_overview6_h2'],
            'prod_overview6_descriprion' => $data['prod_overview6_descriprion'],
            'prod_overview7_h2' => $data['prod_overview7_h2'],
            'prod_overview7_descriprion' => $data['prod_overview7_descriprion'],

        ]);

        //dd( $data);

        return redirect('/');
    }
    public function update($id){
        $product = Product::find($id);
        //if(Auth::user()->role>1){
            $data= request()->validate([
                'prod_title' => 'required',
                'prod_description' => 'required',
                'prod_category' => 'required',
                'prod_isbn' => '',
                'prod_Percent_discount' => '',
                'prod_course' => 'required',
                'prod_actualPrice' => 'required',
                'prod_extraContent' => 'required',
                'prod_keywords' => 'required',
                'prod_file' =>'',
                'prod_image' => '',
                'prod_preview' => '',
                'prod_meta_title' => 'required',
                'prod_meta_description' => 'required',
                'prod_overview1_h2' => '',
                'prod_overview1_descriprion' => '',
                'prod_overview2_h2' => '',
                'prod_overview2_descriprion' => '',
                'prod_overview3_h2' => '',
                'prod_overview3_descriprion' => '',
                'prod_overview4_h2' => '',
                'prod_overview4_descriprion' => '',
                'prod_overview5_h2' => '',
                'prod_overview5_descriprion' => '',
                'prod_overview6_h2' => '',
                'prod_overview6_descriprion' => '',
                'prod_overview7_h2' => '',
                'prod_overview7_descriprion' => '',
            ]);
            

            //check whether attachments are present
            if(isset($data['prod_file'])){
                $prod_file_path = request('prod_file')->store('uploads/docs','public');

            }else{
                $prod_file_path = $product->prod_file;
            }
            

            if(isset($data['prod_image'])){
                $prod_image_path = request('prod_image')->store('uploads/images','public');

            }else{
                $prod_image_path = $product->prod_image;
            }


            if(isset($data['prod_preview'])){
                $prod_preview_path = request('prod_preview')->store('uploads/docs','public');

            }else{
                $prod_preview_path = $product->prod_preview;
            }
            //dd($data['prod_meta_title']);

            $product->prod_title = $data['prod_title'];
            $product->prod_description = $data['prod_description'];
            $product->prod_category = $data['prod_category'];
            $product->prod_isbn = $data['prod_isbn'];
            $product->prod_course = $data['prod_course'];
            $product->prod_actualPrice = $data['prod_actualPrice'];
            $product->prod_Percent_discount = $data['prod_Percent_discount'];
            $product->prod_keywords = $data['prod_keywords'];
            $product->prod_extraContent = $data['prod_extraContent'];
            $product->prod_file = $prod_file_path;
            $product->prod_image = $prod_image_path;
            $product->prod_preview = $prod_preview_path;
            $product->prod_meta_title = $data['prod_meta_title'];
            $product->prod_meta_description = $data['prod_meta_description'];
            $product->prod_overview1_h2 = $data['prod_overview1_h2'];
            $product->prod_overview1_descriprion = $data['prod_overview1_descriprion'];
            $product->prod_overview2_h2 = $data['prod_overview2_h2'];
            $product->prod_overview2_descriprion = $data['prod_overview2_descriprion'];
            $product->prod_overview3_h2 = $data['prod_overview3_h2'];
            $product->prod_overview3_descriprion = $data['prod_overview3_descriprion'];
            $product->prod_overview4_h2 = $data['prod_overview4_h2'];
            $product->prod_overview4_descriprion = $data['prod_overview4_descriprion'];
            $product->prod_overview5_h2 = $data['prod_overview5_h2'];
            $product->prod_overview5_descriprion = $data['prod_overview5_descriprion'];
            $product->prod_overview6_h2 = $data['prod_overview6_h2'];
            $product->prod_overview6_descriprion = $data['prod_overview6_descriprion'];
            $product->prod_overview7_h2 = $data['prod_overview7_h2'];
            $product->prod_overview7_descriprion = $data['prod_overview7_descriprion'];

            $product->save();

            // if($product->save()){
            //     dd("Saved");
            // }else{dd("Failed to save");}

      
            return redirect(route('shop'));
        // }else{
        //     dd('Authorization failed');
        //     return redirect(route('shop'));
        // }
       
    }
}
