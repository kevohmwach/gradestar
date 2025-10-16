@extends('layouts.site')

@section('title') {{'Gradestar - Cart'}} @endsection
@section('canonical_url') {{$canonical_url}} @endsection

@section('content')



    <div class="Navigation_seo" >
                <h1 class="seo_h2"><a class="link_tag" href="{{route('shop')}}">Home</a> / Complete Test Banks - Questions and Answers</h1>
            </div>
    <div class="containerr">
    
    <div class="main-content main-content-cart">
        @if($dataArray)
        
            @foreach($dataArray as $data)
            <div class="cart">
                
                <div class="cart_image">
                    <img height="150px" width="100%" src="storage/{{$data['prod_image']}}" alt="{{$data['prod_title']}}">
                </div>
                
                <div class="cart_info">
                    <div class="bk-title">
                        <p>{{$data['prod_title']}}</p>
                    </div>
                    <div class="bk-tags">
                        <h2 class="seo_h2">{{$data['prod_category']}}</h2>
                    </div>
                    {{-- <div class="bk-price">
                        <p>${{$data['prod_disctPrice']}}</p>
                    </div> --}}
                    <div class="removecart">
                        <a href="/removecart/{{$data['id']}}">
                            <button class="removecart_button" title="Remove item from Cart">
                                X
                            </button>
                        </a>
                    </div>
                </div>
                
            
            </div>
            @endforeach

            <div class="cart-checkout">
                <div class="cart-totals">
                    <p>Cart Totals: <span class="price" >${{$cartTotals}} </span></p>
                    <br>
                </div>
                <div class="checkout-button">
                    <a href="/checkout/">
                        <button class="checkout_button">
                            Proceed to check out
                        </button>
                    </a>
                </div>

            </div>
        @else
            <div class="empty_cart">
                <p>Cart is empty!</p>
            </div>
            
        @endif
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



@endsection