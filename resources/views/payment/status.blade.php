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
                        Click on the link below (Sent yo your email as well) to View the testbank
                    </p>
                    {{-- {{dd($purchaseLists)}} --}}
                    @foreach($purchaseLists as $purchaseList)
                    <div class="pay-status">
                        {{-- <p>{{$purchaseList['title']}}</p> --}}
                        <a href="{{route('download', [
                            'orderRef' => session()->get('orderId'),
                            'id' => $purchaseList['id'],
                            //'slug' => $purchaseList['title'],
                            'slug' => Str::slug($purchaseList['title']),

                        ])}}" target="_blank" class="download-link" >
                            {{$purchaseList['title']}}
                            {{-- <button class="pay-status_button"> --}}
                                {{-- Download --}}
                            {{-- </button> --}}
                        </a>
                        {{-- @if(Auth::user()!==null && Auth::user()->priveledge > 2 ) --}}
                        <br><br><br>
                        <p>
                            <a href="{{ route('auto_download', [
                                'orderRef' => session()->get('orderId'),
                                'id' => $purchaseList['id'],
                                'slug' => Str::slug($purchaseList['title']),
                                //'slug' => Str::limit(Str::slug($purchaseList['title']), 50, ''),

                            ]) }}" target="_blank" class="btn btn-primary">
                                Download Testbank (PDF)
                            </a>
                        </p>
                        {{-- @endif --}}
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