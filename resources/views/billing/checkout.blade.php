@extends('layouts.site')

@section('title') {{'Gradestar - Checkout'}} @endsection
@section('canonical_url') {{$canonical_url}} @endsection

@section('content')

<div class="Navigation_seo" >
    <h1 class="seo_h2"><a class="link_tag" href="{{route('shop')}}">Home</a> / Complete Test Banks - Questions and Answers</h1>
</div>

<div class="containerr">
    
    <div class="main-content-checout">
        <div class="billing_form_div">
            @if( !session()->get('payment_ready') )
            <form action="/billing/store" method="post" class="bill-form"> 
                @csrf

                <div style="width: 100%">
                    <label  class="label">Full Name</label>
    
                    <input id="bill_name" type="text"  class="form-control @error('bill_name') is-invalid @enderror" name="bill_name" value="{{ old('bill_name') }}" required autocomplete="bill_name" autofocus>
                    @error('bill_name')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label  class="label">Billing Email</label>
    
                    <input id="bill_email" type="text"  class="form-control @error('bill_email') is-invalid @enderror" name="bill_email" value="{{ old('bill_email') }}" required autocomplete="bill_email" autofocus>
                    @error('bill_email')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label  class="label">Billing Address</label>
    
                    <input id="bill_address" type="text"  class="form-control @error('bill_address') is-invalid @enderror" name="bill_address" value="{{ old('bill_address') }}" required autocomplete="bill_address" autofocus>
                    @error('bill_address')
                        <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div >
                    
                    <br>
                </div>
                <div class="bill-create-button">
                    <p class="cart-totals">Order Totals: <span class="price" >${{$cartTotals}} </span></p>
                    <button type="submit" class="btn btn-primary">
                        Confirm Order
                    </button>
                </div>


            </form>
            {{-- @else --}}
            {{-- @if( session()->get('payment_ready') ) --}}
               
       
                {{-- <p>Paypal payment</p> --}}

            @endif
        </div>
        <div class="order_details">
            @if($dataArray)
            <div class="order_listings" >
                <ol>
                    <p><strong>Products details</strong></p>
                    <br>
                    @foreach($dataArray as $data)
                        <li>
                            <div>
                                <h2 class="seo_h2">{{$data['prod_title']}}</h2>
                            </div>
                        </li>
                        <br>
                        <br>
                    @endforeach
                </ol>
            </div>
            {{-- <div class="cart-totals">
                <p>Order Totals: <span class="price" >${{$cartTotals}} </span></p>
                <br>
            </div> --}}
            @if( session()->get('payment_ready') )
                <div id="paypal_button">
                    <form action="/payment/gateway" method="post">
                        @csrf
                        <input type="hidden" value="{{session()->get('cartTotals')}}" name="cartTotals" id="cartTotals">
                        <div class="bill-create-button">
                            <button type="submit" class="btn btn-primary">
                                Pay with paypal
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            @else
            <div class="empty_cart">
                <p>Order is empty!</p>
            </div>
            @endif
        </div>

        

    </div>
    <div class="promotion-content">
        <p class="hot-deals">Grab limited Hot deals now </p>
        @if (!empty($promotions))
            @foreach($promotions as $promotion)
                <div class="promotion-column">
                    <a href="{{url('/shop', $promotion['slug'])}}" >
                    <div class="bk-image">
                        {{-- <img src="../storage/{{$promotion['prod_image']}}" alt="{{$promotion['prod_title']}}"> --}}
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

@endsection

