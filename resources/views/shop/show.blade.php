@extends('layouts.site')

@section('title'){{$data['prod_meta_title']}}@empty($data['prod_meta_title']){{$data['prod_title']}}@endempty @endsection

@section('meta_title'){{$data['prod_meta_title']}}@empty($data['prod_meta_title']){{$data['prod_title']}}@endempty @endsection
@section('meta_description'){{$data['prod_meta_description']}}@empty($data['prod_meta_description']){{$data['prod_description']}}@endempty @endsection

@section('canonical_url'){{$canonical_url}} @endsection
@section('keywords'){{$data['prod_keywords']}} @endsection
@section('image_url')storage/{{$data->prod_image}}  @endsection



@section('content')
    <div class="Navigation_seo" >
        <p><a class="link_tag" href="{{route('shop')}}">Home</a> / {{$keywords[0]}}</p>
    </div>

<div class="containerr">
    <div class="main-content">
        <div class="show_content">
            <div class="product_preview">
                <iframe 
                    class = "preview_file" 
                    src="/preview/{{$data->id}}" 
                    frameborder="0" 
                    scrolling="auto"
                    loading="lazy"
                    title="{{$data->prod_title}}" >
                    <!DOCTYPE html>
                    <html lang="en">
                </iframe>

                <div class="bk-cart">
                    <br>
                        @if ($data->prod_Percent_discount > 0)
                            <div class="discount">
                                <p class="actual-price actual-price-discounted"><s>${{round($data->prod_actualPrice,2)}}</s></p>
                                <p class="discounted-price">${{round($data->prod_actualPrice* (1-($data->prod_Percent_discount*0.01)),2) }}</p>
                            </div>
                        @else
                            <div class="non-discount">
                                <p class="actual-price">${{$data->prod_actualPrice}}</p>
                            </div>
                        @endif
                    <button>
                        <a href="/addcart/{{$data->id}}">
                            Add to cart
                        </a> 
                    </button>
                </div>

                
            </div>
            <div class="product_info">
                <div class="prod_title">
                    <h1 class="seo_h1">{{$data->prod_title}}</h1>
                </div>
                <div class="prod_description">
                    <div >{!! htmlspecialchars_decode($data->prod_description) !!}</div>
                </div>
                
                {{-- <div>
                    <ul class="other_titles">
                        
                    </ul>
                </div> --}}
                
                <div class="prod_more">
                    <div class="seo_image">
                        {{-- <img src="../storage/{{$data->prod_image}}"  alt="{{$data->prod_title}}" width="100px" height="100px"> --}}
                        @php
                            // 1. Define the dynamic variables from your parent view/loop
                            // We assume these are available where this snippet is included.
                            $dynamicImagePath = $data->prod_image ?? 'images/placeholder-product.jpg';
                            $imageTitle = $data->prod_title ?? 'Product Placeholder Image';

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
                                class="webP_seo_image"
                            >
                        </picture>
                    </div>
                    <p class="text-info">{{$pages}}</p>
                </div>
               
            </div>

        </div>
        <div class="preview_alert">
            <div>
                <p class="seo_h2" >You are viewing a  preview pdf for <strong>{{$data['prod_title']}}</strong>.
                <span class="instant_downlink_link" >An instant downlink link</span> to the <strong> complete test bank</strong> will be sent via email immediately after purchase.</p>
            </div>
                    

        </div>

        <div class="seo-optimizer">
            <div class="seo-optimizer-1">
                <div class="optimizer-heading">
                    @isset($data['prod_overview1_h2'])
                        <h2>{{ $data['prod_overview1_h2'] }}</h2>
                    @endisset
                </div>
                <div class="optimizer-text">
                    @isset($data['prod_overview1_descriprion'])
                        {!! htmlspecialchars_decode($data['prod_overview1_descriprion']) !!}
                    @endisset
                </div>
            </div>

            <div class="seo-optimizer-2">
                <div class="optimizer-heading">
                    @isset($data['prod_overview2_h2'])
                        <h2> {{ $data['prod_overview2_h2'] }} </h2>
                    @endisset
                </div>
                <div class="optimizer-text">
                    @isset($data['prod_overview2_descriprion'])
                        {!! htmlspecialchars_decode($data['prod_overview2_descriprion']) !!}
                    @endisset
                </div>
            </div>

            <div class="seo-optimizer-3">
                <div class="optimizer-heading">
                    @isset($data['prod_overview3_h2'])
                        <h2> {{ $data['prod_overview3_h2'] }} </h2>
                    @endisset
                </div>
                <div class="optimizer-text">
                    @isset($data['prod_overview3_descriprion'])
                        {!! htmlspecialchars_decode($data['prod_overview3_descriprion']) !!}
                    @endisset
                </div>
            </div>

            <div class="seo-optimizer-4">
                <div class="optimizer-heading">
                    @isset($data['prod_overview4_h2'])
                        <h2> {{ $data['prod_overview4_h2'] }} </h2>
                    @endisset
                </div>
                <div class="optimizer-text">
                    @isset($data['prod_overview4_descriprion'])
                        {!! htmlspecialchars_decode($data['prod_overview4_descriprion']) !!}
                    @endisset
                </div>
            </div>

            <div class="seo-optimizer-5">
                <div class="optimizer-heading">
                    @isset($data['prod_overview5_h2'])
                        <h2> {{ $data['prod_overview5_h2'] }} </h2>
                    @endisset
                </div>
                <div class="optimizer-text">
                    @isset($data['prod_overview5_descriprion'])
                        {!! htmlspecialchars_decode($data['prod_overview5_descriprion']) !!}
                    @endisset
                </div>
            </div>

            <div class="seo-optimizer-6">
                <div class="optimizer-heading">
                    @isset($data['prod_overview6_h2'])
                        <h2> {{ $data['prod_overview6_h2'] }} </h2>
                    @endisset
                </div>
                <div class="optimizer-text">
                    @isset($data['prod_overview6_descriprion'])
                        {!! htmlspecialchars_decode($data['prod_overview6_descriprion']) !!}
                    @endisset
                </div>
            </div>


            <div class="seo-optimizer-7">
                <div class="optimizer-heading">
                    @isset($data['prod_overview7_h2'])
                        <h2> {{ $data['prod_overview7_h2'] }} </h2>
                    @endisset
                </div>
                <div class="optimizer-text">
                    @isset($data['prod_overview7_descriprion'])
                        {!! htmlspecialchars_decode($data['prod_overview7_descriprion']) !!}
                    @endisset
                </div>
            </div>

        </div>
        
        <div class="product_content">
            {{-- <div class="sample_content_heading">
               
            </div> --}}
            {!! htmlspecialchars_decode($data['prod_extraContent']) !!}
          
        </div>
    </div>
    <div class="promotion-content">
        <p class="hot-deals">Grab limited Hot deals now </p>
        @if (!empty($promotions))
            @foreach($promotions as $promotion)
                <div class="promotion-column">
                    <a href="{{url('/shop', $promotion['slug'])}}" >
                    <div class="bk-image bk-image-promo">
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

                    <div class="bk-price">
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
@isset($schema)
    {!! $schema->toScript() !!}
@endisset

@endsection
