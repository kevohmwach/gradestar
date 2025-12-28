@extends('layouts.site')

@section('title'){{$data['prod_meta_title']}}@empty($data['prod_meta_title']){{$data['prod_title']}}@endempty @endsection

@section('meta_title'){{$data['prod_meta_title']}}@empty($data['prod_meta_title']){{$data['prod_title']}}@endempty @endsection
@section('meta_description'){{$data['prod_meta_description']}}@empty($data['prod_meta_description']){{$data['prod_description']}}@endempty @endsection

@section('canonical_url'){{$canonical_url}} @endsection
@section('keywords'){{$data['prod_keywords']}} @endsection
@section('image_url')storage/{{$data->prod_image}}  @endsection



@section('content')
    <div class="Navigation_seo" >
        <p><a class="link_tag breadcrumbs" href="{{route('shop')}}">Home</a> / {{$data->prod_title}}</p>
    </div>

<div class="containerr">
    <div class="main-content">
        {{-- <div class="Navigation_seo" >
            <p><a class="link_tag breadcrumbs" href="{{route('shop')}}">Home</a> / {{$keywords[0]}}</p>
        </div> --}}
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

                {{-- <div class="bk-cart">
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
                </div> --}}

                
            </div>
            <div class="product_info">
                <div class="prod_title">
                    <h1 class="seo_h1">{{$data->prod_title}}</h1>
                </div>
                {{-- <div class="prod_description">
                    <div >{!! htmlspecialchars_decode($data->prod_description) !!}</div>
                </div> --}}
                
                {{-- <div>
                    <ul class="other_titles">
                        <li>Note: This is the Digital Test Bank (Questions & Answers), not the physical textbook.</li>
                    </ul>
                </div> --}}
                

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
                <div>
                    {{-- <h2 class="seo_h2">Main Features: </h2> --}}
                    <p> Main Features: </p>
                    <ul class="other_titles">
                        <li><strong>All chapters covered</strong></li>
                        <li><strong>This is a Digital Test Bank (Questions & Answers), NOT the physical textbook.</strong></li>
                    </ul>
                </div>
                
                
                <div class="prod_more">
                    <div class="seo_image">
                        {{-- <img src="../storage/{{$data->prod_image}}"  alt="{{$data->prod_title}}" width="100px" height="100px"> --}}
                        {{-- @php
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
                        </picture> --}}
                    </div>
                    <p class="text-info">{{$pages}}</p>
                </div>
               
            </div>

        </div>
        <div class="preview_alert">
            <div>
                <p class="seo_h2" >This is a preview <strong>PDF</strong>: <strong>{{$keywords[0]}}</strong>.
                <span class="instant_downlink_link" ><strong>An instant download link</strong></span> to the <strong> Verified test bank</strong> will be sent via email immediately after purchase.</p>
            </div>
                    

        </div>

        <div class="seo-optimizer">
            {{-- <div class="seo-optimizer-1">
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
            </div> --}}

            {{-- <div class="seo-optimizer-2">
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
            </div> --}}

        </div>
        
        <div class="product_content">
            {{-- <div class="sample_content_heading">
               
            </div> --}}
            {!! htmlspecialchars_decode($data['prod_extraContent']) !!}
          
        </div>
    </div>

    {{-- Pass the $promotions variable (which should be available in your view) --}}
    <x-promotion-section :promotions="$promotions" />

    
</div>
@isset($schema)
    {!! $schema->toScript() !!}
@endisset

@endsection
