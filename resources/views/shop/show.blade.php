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
                    {{-- src="{{storage_path('app/public'.$data->prod_preview)}}" --}}
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
                    {{-- <h1 class="seo_h1">{{$keywords[0]}}</h1> --}}
                </div>
                <div class="prod_description">
                    {{-- <h2 class="seo_h2">{{$data->prod_description}} course</h2> --}}
                    {{-- <h2 class="seo_h2">{!! htmlspecialchars_decode($data->prod_description) !!}</h2> --}}
                    <div >{!! htmlspecialchars_decode($data->prod_description) !!}</div>
                </div>
                
                <div>
                    
                    {{-- <p class="text-secondary"><strong> {{$keywords[0]}},</strong></p> --}}
                    <ul class="other_titles">
                        {{-- <li class="text-primary">Other similar search names</li>
                            <li class="text-secondary"><strong> {{$keywords[0]}},</strong></li> --}}
                        {{-- @foreach($keywords as $keyword)
                            <li class="text-secondary"><strong> {{$keyword}},</strong></li>
                        @endforeach --}}
                    </ul>
                </div>
                {{-- <div class="prod_category">
                    <h2 class="seo_h2">{{$data->prod_category}}</h2>
                </div> --}}
                {{-- <div class="prod_course">
                    <h2 class="seo_h2" >Written for {{$data->prod_course}} </h2>
                    <p>Written for <strong> {{$data->prod_course}}.</strong> </p>
                </div> --}}
                    {{-- @if ($data->prod_Percent_discount > 0)
                        <div class="discount">
                            <p class="actual-price actual-price-discounted"><s>${{round($data->prod_actualPrice,2)}}</s></p>
                            <p class="discounted-price">${{round($data->prod_actualPrice* (1-($data->prod_Percent_discount*0.01)),2) }}</p>
                        </div>
                    @else
                        <div class="non-discount">
                            <p class="actual-price">${{$data->prod_actualPrice}}</p>
                        </div>
                    @endif --}}
                {{-- <div class="prod_price">
                    <p>Price: ${{$data->prod_actualPrice}}</p>
                </div> --}}
                <div class="prod_more">
                    <div class="seo_image">
                        <img src="../storage/{{$data->prod_image}}"  alt="{{$data->prod_title}}" width="100px" height="100px">
                    </div>
                    <p class="text-info">{{$pages}}</p>
                </div>
                {{-- <div class="bk-cart">
                    <button>
                        <a href="/addcart/{{$data->id}}">
                            Add to cart
                        </a> 
                    </button>
                </div> --}}
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
            <div class="sample_content_heading">
                {{-- <p>preview</p> --}}
            </div>
            {!! htmlspecialchars_decode($data['prod_extraContent']) !!}
            {{-- @foreach($extra_info as $info)
                <p>{{$info}} </p>
            @endforeach --}}
        </div>

        {{-- <p>{{$data->prod_title}}</p> --}}
    </div>
    <div class="promotion-content">
        <p class="hot-deals">Grab limited Hot deals now </p>
        @if (!empty($promotions))
            @foreach($promotions as $promotion)
                <div class="promotion-column">
                    <a href="{{url('/shop', $promotion['slug'])}}" >
                    <div class="bk-image bk-image-promo">
                        <img src="../storage/{{$promotion['prod_image']}}" alt="{{$promotion['prod_title']}}">
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
@isset($schema)
    {!! $schema->toScript() !!}
@endisset

@endsection
