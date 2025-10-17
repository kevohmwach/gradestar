@extends('layouts.site')
@section('title') {{'Gradestar - Test banks'}} @endsection
@section('meta_title') {{'Gradestar - Test banks'}} @endsection
@section('meta_description') Complete Test Banks with Questions and Answers to help in your exam preparation @endsection
@section('canonical_url') {{$canonical_url}} @endsection
@section('keywords') Test banks @endsection

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
                    {{-- dd({{storage_path('app/public/').$product->prod_image}}) --}}
                    {{-- <img src="{{storage_path('app/public/').$product->prod_image}}" alt="bk-image"> --}}
                    <img src="storage/{{$product->prod_image}}" alt="{{$product->prod_title}}">
                </div>
                <div class="bk-title">
                    <h2 class="seo_h2">{{$product->prod_title}}</h2>
                </div>
                </a>
                {{-- <div class="prod_course_shop">
                    <h2 class="seo_h2" > {{$product->prod_course}} course</h2>
                </div> --}}

                <div class="bk-tags">
                    <p>{{$product->prod_category}}</p>
                </div>

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
    <div class="promotion-content">
        <p class="hot-deals">Grab limited Hot deals now </p>
        @if (!empty($promotions))
            @foreach($promotions as $promotion)
                <div class="promotion-column">
                    <a href="{{url('/shop', $promotion['slug'])}}" >
                    <div class="bk-image">
                        <img src="storage/{{$promotion['prod_image']}}" alt="{{$promotion['prod_title']}}">
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

<div class="pagination-div">
    {{$products->links('pagination::bootstrap-4')}}
</div>

@endsection
