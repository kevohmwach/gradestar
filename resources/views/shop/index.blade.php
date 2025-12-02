@extends('layouts.site')
@section('title') {{'Nursing Test Banks – Verified & Instant Download | GradeStar Solutions'}} @endsection
@section('meta_title') {{'Nursing Test Banks – Verified & Instant Download | GradeStar Solutions'}} @endsection
@section('meta_description') Explore verified nursing test banks with instant PDF downloads. Trusted by nursing students and educators worldwide. @endsection
@section('canonical_url') {{$canonical_url}} @endsection
@section('keywords') nursing test banks PDF, nursing exam questions, buy nursing test banks online, nursing test bank with answers, nursing study materials, nursing textbook test banks @endsection
{{-- @section('img_url')  @endsection --}}
@section('content')
<div class="containerr">
    <div class="main-content">
        {{-- <div>
            <div class="site-title">
                <p>GRADESTAR</p>
            </div>
            <div>
                <input type="text" name="search" id="search">
                <input type="button" value="search">
            </div>
        </div>
         --}}
        <div class="Navigation_seo" >
            <h1 class="seo_h2"><a class="link_tag" href="{{route('shop')}}">Home</a> / Complete Test Banks - Questions and Answers</h1>
        </div>
        <div class="index-row">
            @foreach($products as $product)
            <div class="column">
                <a href="{{url('/shop', $product->slug)}}" >
                <div class="bk-image">
                    {{-- <img src="storage/{{$product->prod_image}}" alt="{{$product->prod_title}}"> --}}
                    {{-- @php
                            // 1. Define the dynamic variables from your parent view/loop
                            // We assume these are available where this snippet is included.
                            $dynamicImagePath = $product->prod_image ?? 'images/placeholder-product.jpg';
                            $imageTitle = $product->prod_title ?? 'Product Placeholder Image';

                            // 2. Determine the parts of the path for WebP generation
                            $parts = pathinfo($dynamicImagePath);

                            // Reconstruct the directory path, ensuring it ends with a slash if non-empty
                            $directory = $parts['dirname'] === '.' ? '' : $parts['dirname'] . '/';

                            // Construct the WebP path (same directory, same filename, new .webp extension)
                            $webpPath = $directory . $parts['filename'] . '.webp';

                            // 3. Generate the public URLs using Laravel's asset helper
                            // Assuming the files are publicly accessible via the 'storage' symlink.
                            $originalUrl = asset('storage/' . $dynamicImagePath);
                            $webpUrl = asset('storage/' . $webpPath);
                    @endphp
                    <picture>
                        <source srcset="{{ $webpUrl }}" type="image/webp">
                        <img
                            src="{{ $originalUrl }}"
                            alt="{{ $imageTitle }}"
                            class="webP-image"
                        >
                    </picture> --}}
                    @php
                        // 1. Define the dynamic variables from your parent view/loop
                        $dynamicImagePath = $product->prod_image ?? 'images/placeholder-product.jpg';
                        $imageTitle = $product->prod_title ?? 'Product Placeholder Image';

                        // 2. Determine the parts of the path
                        $parts = pathinfo($dynamicImagePath);
                        $directory = $parts['dirname'] === '.' ? '' : $parts['dirname'] . '/';
                        $filename = $parts['filename'];
                        $extension = $parts['extension'] ?? 'jpg'; // Default to jpg if extension is missing

                        $sizes = [
                            // 300w is ideal for your current display size (223px)
                            300 => [
                                'original' => asset("storage/{$directory}{$filename}-300w.{$extension}"),
                                'webp' => asset("storage/{$directory}{$filename}-300w.webp")
                            ],
                            // 600w is for larger contexts or high-DPI (2x) displays
                            600 => [
                                'original' => asset("storage/{$directory}{$filename}-600w.{$extension}"),
                                'webp' => asset("storage/{$directory}{$filename}-600w.webp")
                            ],
                            // 900w is the original max size from your PHP script (1000px max width)
                            900 => [
                                'original' => asset("storage/{$directory}{$filename}.{$extension}"),
                                'webp' => asset("storage/{$directory}{$filename}.webp")
                            ],
                        ];

                        // Build the srcset strings using the generated URLs and width descriptors (w)
                        $webpSrcset = collect($sizes)->map(function ($urls, $width) {
                            return "{$urls['webp']} {$width}w";
                        })->implode(', ');

                        $originalSrcset = collect($sizes)->map(function ($urls, $width) {
                            return "{$urls['original']} {$width}w";
                        })->implode(', ');

                        // Fallback URL for img tag (must be the lowest-res image for best performance)
                        $fallbackUrl = $sizes[300]['original'];
                    @endphp

                    <picture>
                        <!-- 1. WebP Source: Allows the browser to pick the best size WebP file -->
                        <source
                            srcset="{{ $webpSrcset }}"
                            sizes="(max-width: 400px) 300px, 100vw"
                            type="image/webp"
                        >

                        <!-- 2. Original Format Source: Allows the browser to pick the best size JPG/PNG file -->
                        <source
                            srcset="{{ $originalSrcset }}"
                            sizes="(max-width: 400px) 300px, 100vw"
                        >

                        <!-- 3. Fallback Img: Used by all browsers to display the selected image. The smallest image is the src fallback. -->
                        <img
                            src="{{ $fallbackUrl }}"
                            alt="{{ $imageTitle }}"
                            class="webP-image"
                        >
                    </picture>
                </div>
                <div class="bk-title">
                    <h2 class="seo_h2">{{$product->prod_title}}</h2>
                </div>
                </a>
                {{-- <div class="prod_course_shop">
                    <h2 class="seo_h2" > {{$product->prod_course}} course</h2>
                </div> --}}

                {{-- <div class="bk-tags">
                    <p>{{$product->prod_category}}</p>
                </div> --}}
                

                <div class="bk-price">
                    @if ($product->prod_Percent_discount > 0)
                        <div class="discount">
                            <p class="actual-price actual-price-discounted"><s>${{$product->prod_actualPrice}}</s></p>
                            <p class="discounted-price">${{round($product->prod_actualPrice* (1-($product->prod_Percent_discount*0.01)),2) }}</p>
                        </div>
                    @else
                        <div class="non-discount">
                            <p class="actual-price">${{round($product->prod_actualPrice,2)}}</p>
                        </div>
                    @endif

                    <div>
                        @isset(Auth::user()->priveledge)
                            @if(Auth::user()->priveledge>1)
                                <a class="link_tag" href="{{route('productEdit',['id'=>$product->id])}}">Edit</a>
                             @endif
                        @endisset
                        
                    </div>
                    

                    {{-- <div class="non-discount">
                        <p class="actual-price">${{$product->prod_actualPrice}}</p>
                    </div>
                    <div class="discount">
                        <p class="actual-price"><s>${{$product->prod_actualPrice}}</s></p>
                        <p class="discounted-price">${{$product->prod_disctPrice}}</p>
                    </div> --}}
                    
                </div>
                
                <div class="bk-cart">
                    <a href="/addcart/{{$product->id}}">
                        <button>
                            Add to cart
                        </button>
                    </a>
                </div>

            </div>
            <!-- <div class="column"></div>
            <div class="column"></div>
            <div class="column"></div> -->
            @endforeach

            {{-- <div class="pagination-div">
            {{$products->links('pagination::bootstrap-4')}}
            </div> --}}
        </div>
       
    </div>
    <x-promotion-section :promotions="$promotions" />
    
</div>

<div class="pagination-div">
    {{$products->links('pagination::bootstrap-4')}}
</div>

@endsection
