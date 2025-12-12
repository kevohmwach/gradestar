@extends('layouts.site')

@section('title') {{'Gradestar - Checkout'}} @endsection
@section('canonical_url') {{$canonical_url}} @endsection

@section('content')

<div class="Navigation_seo" >
    <h1 class="seo_h2"><a class="link_tag breadcrumbs" href="{{route('shop')}}">Home</a> / Complete Test Banks - Questions and Answers</h1>
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
    <x-promotion-section :promotions="$promotions" />
</div>

@endsection

