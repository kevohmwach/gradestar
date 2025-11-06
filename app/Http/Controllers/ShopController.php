<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\Cache;

use Illuminate\Http\Request;
use App\Models\Product;
use File;
use Response;

class ShopController extends Controller
{
      public function checkInput($data) {
    
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES);
        return $data;
      }
      
      //Get Page numbers:
      public function getNumPagesPdf($filepath) {
          if (file_exists($filepath)) {
              $fp = @fopen(preg_replace("/\[(.*?)\]/i", "", $filepath), "r");
              $max = 0;
              if (!$fp) {
                  return "Could not open file: $filepath";
              } else {
                  while (!@feof($fp)) {
                      $line = @fgets($fp, 255);
                      if (preg_match('/\/Count [0-9]+/', $line, $matches)) {
                          preg_match('/[0-9]+/', $matches[0], $matches2);
                          if ($max < $matches2[0]) {
                              $max = trim($matches2[0]);
                              break;
                          }
                      }
                  }
                  @fclose($fp);
              }
      
              return $max;
      
          }else{
              return "Book is missing";
          }
          return $max;
      }
      
    
    public function index(){
        // Define how long to cache (in seconds). 600 seconds = 10 minutes.
        $cacheDuration_promo = 600; 
        $cacheKey_promo = 'product.promotion';

        $promotion = Cache::remember($cacheKey_promo, $cacheDuration_promo, fn()=>Product::where('prod_Percent_discount', '>', 0)->limit(5)->get()->toArray());
        
        // $cacheDuration_products = 600;
        // $cacheKey_products = 'product.promotion';
        // $product = Cache::remember($cacheKey_products, $cacheDuration_products, function (){
        //     return Product::latest()->get();
        // });
        // $product = $product->paginate(16);
        //dd($product);
        //dd(Product::latest()->paginate(16));
        
        //$promotion = Product::latest()->limit(5)->get()->toArray();
        session()->put("promotion", $promotion);

        return view('shop.index', [
            // 'products' => $product,
            'products' => Product::latest()->paginate(16),
            'promotions' => $promotion,
            'canonical_url' => url()->current(),
            //'image_url' => storage_path('app/public/'.$file_path);
        ]);
    }

    public function show($product){
        // Define how long to cache (in seconds). 600 seconds = 10 minutes.
        $cacheDuration_promo = 600; 

        // The cache key
        $cacheKey_promo = 'product.promotion';

        $promotion = Cache::remember($cacheKey_promo, $cacheDuration_promo, fn()=>Product::where('prod_Percent_discount', '>', 0)->limit(5)->get()->toArray());

        $product = $this->checkInput($product);
       
        

        if (filter_var($product, FILTER_SANITIZE_STRING)!== false) {

            $data = Product::where('slug', $product)->first();
            // $extra_info = $data['prod_extraContent'];
            // $extra_info = explode( "<br>", $extra_info);

            $data['prod_overview1_descriprion'] = clean($data['prod_overview1_descriprion']);

            $product_price = $data['prod_actualPrice'];
            if( $data['prod_Percent_discount'] ){
                $product_price = round($data->prod_actualPrice* (1-($data->prod_Percent_discount*0.01)),2);
            }
            
            //Generate Schema.org data
            $schema = Schema::product()
            ->name($data['prod_title'])
            ->image(asset($data['prod_image']))
            // ->sku($product->sku)
            ->description($data['prod_meta_description'])
            ->brand(
                Schema::brand()->name("GradeStar Solutions")
            )
            ->offers(
                Schema::offer()
                    ->url(url()->current())
                    ->priceCurrency('USD')
                    ->price($product_price)
                    ->availability('https://schema.org/InStock')
                    // ->itemCondition('https://schema.org/NewCondition')
            );

            // if ($product->average_rating) {
            //     $schema->aggregateRating(
            //         Schema::aggregateRating()
            //             ->ratingValue($product->average_rating)
            //             ->reviewCount($product->review_count)
            //     );
            // }

            


            $file_path = storage_path('app/public'.$data['prod_file']);
            $no_pages = $this->getNumPagesPdf($file_path);
            $canonical_url = url()->current();
            $keywords = explode( ",", $data['prod_keywords']);
            $keywords = array_shift($keywords);
             
            
            if($no_pages>0 && is_numeric($no_pages) ){
                return view('shop.show', 
                [
                    //compact('data')
                    'data' => $data,
                    // 'extra_info' => $extra_info,
                    'promotions' => $promotion,
                    'pages' => 'Pages '.$no_pages,
                    'canonical_url' => $canonical_url,
                    'keywords' => explode( ",", $data['prod_keywords']),
                    //'keywords' => $keywords,
                    'schema' => $schema,
              
                    
                ]);
            }else{
                return view('shop.show', 
                [
                    'data' => $data,
                    // 'extra_info' => $extra_info,
                    'promotions' => $promotion,
                    'pages' => '',
                    'canonical_url' => $canonical_url,
                    'keywords' => explode( ",", $data['prod_keywords']),
                    'schema' => $schema,
                ]);

            }
        }
    }

    public function preview($id){
        $id = $this->checkInput($id);

        if (filter_var($id, FILTER_VALIDATE_INT)!== false) {
            $data =  Product::find($id);
            $file_path = $data['prod_preview'];

            $complete_path = storage_path('app/public/'.$file_path);
            
            // if (!Auth::check()) {
            //     return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            // }
            if (!file_exists($complete_path)) {
                //return response()->json(['error' => 'File not found.'], Response::HTTP_NOT_FOUND);
                return response('Error: Preview File not found');
            }

            $file = File::get($complete_path);
            $response = Response::make($file, 200);
            $response->header('Content-Type', 'application/pdf');
            return $response;
            //return response()->file($complete_path);
            // return view('shop.preview', [
            //     'complete_path' => $complete_path
            // ]);
        }
        

    }

    public function search(){
        //dd(request()->search);
        //$searchTerm = request()->search;
        //$promotion = Product::where('prod_Percent_discount', '>', 0)->get()->toArray();
        $cacheDuration_promo = 600; 
        $cacheKey_promo = 'product.promotion';

        $promotion = Cache::remember($cacheKey_promo, $cacheDuration_promo, fn()=>Product::where('prod_Percent_discount', '>', 0)->limit(5)->get()->toArray());
        

        $searchTerm = $this->checkInput(request()->p);

        if (filter_var($searchTerm, FILTER_SANITIZE_STRING)!== false) {
            $data_title = Product::where('prod_title', 'LIKE', "%{$searchTerm}%")->get()->toArray();
            $data_keys = Product::where('prod_keywords', 'LIKE', "%{$searchTerm}%")->get()->toArray();
            //$data_key2 = Product::where('prod_keyword2', 'LIKE', "%{$searchTerm}%")->get()->toArray();
            //$data_key3 = Product::where('prod_keyword3', 'LIKE', "%{$searchTerm}%")->get()->toArray();
            //$data_slug = Product::where('slug', 'LIKE', "%{$searchTerm}%")->get()->toArray();

            //$searchResult = array_merge($data_title,$data_key1,$data_key2,$data_key3,$data_slug);
            $searchResult = array_merge($data_title,$data_keys);
            $searchResult = array_unique($searchResult,SORT_REGULAR);

            if(!empty($searchResult)){
                $searchResult = $this->paginate($searchResult);

   

                //return view('paginate', compact('data'));

                //dd($searchResult);
                return view('shop.search', 
                    [
                        'searchResults' => $searchResult,
                        'searchTerm' => $searchTerm,
                        'promotions' => $promotion,
                    ]);
            }else{
                return view('shop.search', 
                    [
                        'searchResults' => null,
                        'searchTerm' => $searchTerm,
                        'promotions' => $promotion,
                    ]);
            }


            
            // $file_path = storage_path('app/public'.$data['prod_file']);
            // $no_pages = $this->getNumPagesPdf($file_path);
            
            // if($no_pages>0 && is_numeric($no_pages) ){
            //     return view('shop.show', 
            //     [
            //         //compact('data')
            //         'data' => $data,
            //         'pages' => 'Pages '.$no_pages
            //     ]);
            // }else{
            //     return view('shop.show', 
            //     [
            //         'data' => $data,
            //         'pages' => ''
            //     ]);

            // }
        }
    }

    public function addcart($id){

        $id = $this->checkInput($id);

        if (filter_var($id, FILTER_VALIDATE_INT)!== false) {
            for ($i=0; $i < 10; $i++) { 
                $session_name = "cart".$i;

                if( session()->missing($session_name) ){
                    if( $this->checkCartEntries($id) ){
                        session()->put($session_name, $id);
                    }
                    break;
                }
            }
            //dd( session()->get('cart0') );
            return redirect()->to('/cart');
           
        }
    }
    public function checkCartEntries($cartValue){
        for ($i=0; $i < 10; $i++) { 
            $session_name = "cart".$i;

            if( session()->get($session_name)==$cartValue ){
                return false;
                break;
            }
        }
        return true;
    }

    public function removecart($id){
        $id = $this->checkInput($id);

        if (filter_var($id, FILTER_VALIDATE_INT)!== false) {
            for ($i=0; $i < 10; $i++) { 
                $session_name = "cart".$i;

                if( session()->get($session_name)==$id ){
                    session()->forget($session_name);
                    break;
                }
            }
            return redirect()->to('/cart');
           
        }
    }
    public function cart(){
        //cacheKey_promo = Product::where('prod_Percent_discount', '>', 0)->get()->toArray();
        $cacheDuration_promo = 600; 
        $cacheKey_promo = 'product.promotion';

        $promotion = Cache::remember($cacheKey_promo, $cacheDuration_promo, fn()=>Product::where('prod_Percent_discount', '>', 0)->limit(5)->get()->toArray());
        
        $dataArray = [];
        $cartTotals = 0;
        for ($i=0; $i < 10; $i++) { 
            $session_name = "cart".$i;

            if( session()->missing($session_name) ){
                //break;
            }
            //$data = array_merge();
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

                
                if($item->prod_Percent_discount > 0){
                    $cartTotals = $cartTotals+ (round($item->prod_actualPrice * (1-($item->prod_Percent_discount*0.01)),2) );
                }else{
                    $cartTotals = $cartTotals+ $item->prod_actualPrice;
                }

            }
        }
        session()->put('cartTotals', $cartTotals);

        return view ('shop.cart', [
            'dataArray' => $dataArray,
            'cartTotals' => $cartTotals,
            'promotions' => $promotion,
            'canonical_url' => url()->current(),
        ]);
    }

    public function about(){
        return view('shop.about',[
            'canonical_url' => url()->current(),
        ]);
    }

    public function paginate($items, $perPage = 12, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }
    
}
