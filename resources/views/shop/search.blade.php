@extends('layouts.site')

@section('content')

@section('title') Search - Gradestar @endsection
@section('meta_title') Search - Gradestar @endsection
@section('meta_description') Complete Test banks" Questions and answers @endsection
@section('keywords') Complete Test banks" Questions and answers @endsection

<div class="containerr">
    <div class="main-content">

         <div class="search-wrap">
            <div class="searchmessage">
                <p>You searched for <span class="searchTerm">{{$searchTerm}}</span> </p>
            </div>
            <div class="index-row">

                @if ($searchResults!=null)
                @foreach($searchResults as $searchResult)
                <div class="column">
                    <a href="{{url('/shop', $searchResult['slug'])}}" >
                    <div class="bk-image">
                        <img src="../storage/{{$searchResult['prod_image']}}" alt="{{$searchResult['prod_title']}}">
                    </div>
                    <div class="bk-title">
                        <h2 class="seo_h2">{{$searchResult['prod_title']}}</h2>
                    </div>
                    </a>

                    <div class="bk-tags">
                        <h2 class="seo_h2">{{$searchResult['prod_category']}}</h2>
                    </div>

                    <div class="bk-price">

                        @if ($searchResult['prod_Percent_discount'] > 0)
                             <div class="discount">
                                <p class="actual-price"><s>${{$searchResult['prod_actualPrice']}}</s></p>
                                {{-- <p class="discounted-price">${{$searchResult['prod_disctPrice']}}</p> --}}
                                <p class="discounted-price">${{ round($searchResult['prod_actualPrice']* (1-($searchResult['prod_Percent_discount']*0.01)),2) }}</p>
                            </div>
                        @else
                             <div class="non-discount">
                                <p class="actual-price">${{$searchResult['prod_actualPrice']}}</p>
                            </div>
                        @endif

                        
                    </div>
                    
                    <div class="bk-cart">
                        <a href="/addcart/{{$searchResult['id']}}">
                            <button>
                                Add to cart
                            </button>
                        </a>
                    </div>

                </div>
                @endforeach
                    
                @else 
                    <div class="searchmessage">
                        <p>Sorry, We couldn't find match for search term at this time</p>
                    </div>
                
                @endif
            </div>
        </div>
       
    </div>

    <x-promotion-section :promotions="$promotions" />

    
 
</div>

<div class="pagination-div">
    @if ($searchResults!=null)
        {{$searchResults->links('pagination::bootstrap-4')}}
    @endif
</div>

@endsection
