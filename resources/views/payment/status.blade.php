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
        <x-promotion-section :promotions="$promotions" />
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