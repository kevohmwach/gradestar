@extends('layouts.site')

@section('title') {{'Gradestar - Payment Status'}} @endsection
@section('canonical_url') {{$canonical_url}} @endsection

@section('content')

@if ($status==="success")
    <div class="containerr">
        <div class="main-content main-content-status">
            <div class="payment_info">
                <div class="pay-success">
                    <div class="payment-success">Payment has been received successfully</div>
                    <p>Your document is ready for download.
                        Click on the link below to download
                    </p>
                    {{-- {{dd($purchaseLists)}} --}}
                    @foreach($purchaseLists as $purchaseList)
                    <div class="pay-status">
                        {{-- <p>{{$purchaseList['title']}}</p> --}}
                        <a href="{{route('download', [
                            'orderRef' => session()->get('orderId'),
                            'id' => $purchaseList['id'],
                            'slug' => $purchaseList['title'],

                        ])}}" target="_blank" class="download-link" >
                            {{$purchaseList['title']}}
                            {{-- <button class="pay-status_button"> --}}
                                {{-- Download --}}
                            {{-- </button> --}}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="payment_extra">
                <div>
                    <p>Thank you for choosing Gradestar as your revision partner<br></p>

                    <div class="pay-status">
                        <a href="/">
                            <button class="pay-status_button">
                                Continue Shopping
                            </button>
                        </a>
                    </div>
                    
                </div>
            </div>
          
            
        </div>
        <div class="promotion-content">
            <p class="hot-deals">Grab limited Hot deals now </p>
        @if (!empty($promotions))
            @foreach($promotions as $promotion)
                <div class="promotion-column">
                    <a href="{{url('/shop', $promotion['slug'])}}" >
                    <div class="bk-image">
                        {{-- <img src="../storage/{{$promotion['prod_image']}}" alt="bk-image"> --}}
                        @php
                            // 1. Define the dynamic variables from your parent view/loop
                            $dynamicImagePath = $promotion['prod_image'] ?? 'images/placeholder-product.jpg';
                            $imageTitle = $promotion['prod_title'] ?? 'Product Placeholder Image';

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
                        <p>{{$promotion['prod_title']}}</p>
                    </div>
                    </a>

                    {{-- <div class="bk-tags">
                        <p>{{$promotion['prod_category']}}</p>
                    </div> --}}

                    <div class="bk-price">
                        {{-- <div class="non-discount">
                            <p class="actual-price">${{$promotion['prod_actualPrice']}}</p>
                        </div> --}}
                        <div class="discount">
                            <p class="actual-price actual-price-discounted"><s>${{$promotion['prod_actualPrice']}}</s></p>
                            <p class="discounted-price">${{ round($promotion['prod_actualPrice']* (1-($promotion['prod_Percent_discount']*0.01)),2) }}</p>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        @endif

        </div>
    </div>
    
@endif



@if ($status==="fail")
<div class="container">
    <div class="main-content main-content-status">
        
        <div class="payment_info">
            <div class="pay-fail">
                <p>Payment processing Failed!</p>
            </div>
            
        </div>
        <div class="payment_extra">
            <p>We are sorry we could not process your payment at this time.</p>
            <div class="pay-retry">
                <a href="/billing/retryPayment">
                    <button class="pay-status_button">
                        Retry payment
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="promotion-content">
    </div>
</div>
    
@endif

@if ($status==="noPayment")
    <div class="container">
        <div class="main-content main-content-status">
            <div class="payment_info">
                <p>No Payment made yet!</p>
            </div>
            <div class="payment_extra"></div>
            
        </div>
        <div class="promotion-content">
        </div>
    </div>
@endif



@endsection