@extends('layouts.site')

@section('title') {{'Gradestar - Return & Refund Policy'}} @endsection
@section('meta_title') {{'Gradestar - Return & Refund Policy'}} @endsection
@section('meta_description') {{'Gradestar - Return & Refund Policy'}} @endsection
@section('canonical_url') {{$canonical_url}} @endsection

@section('content')

{{-- <div class="Navigation_seo" >
    <h1 class="seo_h2"><a class="link_tag" href="{{route('shop')}}">Home</a> / Complete Test Banks - Questions and Answers</h2>
</div> --}}

<div class="containerr">
    
    <div class="main-content main-content-cart">

        <h1 class="about-h1" >Return & Refund Policy</h1>

        <h2 class="refund-h2"> 1. Digital Product Nature (No Returns)</h2>
        <p>
            Due to the nature of digital products (PDFs, downloads, and electronic files), all sales are considered 
            final. Unlike physical goods, digital materials cannot be "returned" once they have been delivered or 
            downloaded. By completing your purchase, you acknowledge that you will not be able to return the product 
            for a refund once the download link has been accessed.
        </p>

        <h2 class="refund-h2">2. Exceptions & Refund Eligibility</h2>
        <p>
            While we maintain a "No Refund" policy for change-of-mind or accidental purchases, we are committed to your satisfaction. 
            Refunds or exchanges may be granted only under the following specific circumstances:
        </p>
        <ul>
            <li>
                <strong>Duplicate Purchase:</strong> If you accidentally purchased the same product twice in a single 
                transaction or within 24 hours, we will gladly refund the duplicate charge.
            </li>
             <li>
                <strong>Technical Defects:</strong> If the file is corrupted or technically defective and our support team 
                cannot provide a working version within 48 hours of being notified.
            </li>
            <li>
                <strong>Product Misrepresentation:</strong> If the product delivered is fundamentally different from 
                the one described (e.g., wrong edition, wrong author, or missing promised chapters).
                <ul>
                    <li>Note: Subjective opinions on content quality or "difficulty" of questions do not qualify 
                        as misrepresentation.
                    </li>
                </ul>
            </li>
        </ul>

        <h2 class="refund-h2"> 3. How to Request Assistance</h2>

       <p>
        If you encounter an issue, please contact us at sales@gradestarsolutions.com within 7 days of your purchase. 
        Please include:

        <ol>
            <li>Your Order Number.</li>
            <li>The email address used for the purchase.</li>
            <li>A detailed description of the issue (including screenshots if there is a technical error).</li>
        </ol>
       </p>

        <h2 class="refund-h2">4. Chargebacks and Disputes</h2>
        <p>
            We encourage you to contact our support team first to resolve any issues. Please note that filing a "fraudulent" 
            chargeback for a product that was successfully delivered and downloaded is a violation of our terms. We reserve the right to provide 
            evidence of the download (IP address and time stamps) to your financial institution to contest such claims.
        </p>


    </div>

</div>

@endsection