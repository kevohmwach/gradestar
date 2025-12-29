@extends('layouts.site')

@section('title') {{'Gradestar - Terms of Use & Intellectual Property'}} @endsection
@section('meta_title') {{'Gradestar - Terms of Use & Intellectual Property'}} @endsection
@section('meta_description') {{'Gradestar - Terms of Use & Intellectual Property'}} @endsection
@section('canonical_url') {{$canonical_url}} @endsection

@section('content')

{{-- <div class="Navigation_seo" >
    <h1 class="seo_h2"><a class="link_tag" href="{{route('shop')}}">Home</a> / Complete Test Banks - Questions and Answers</h2>
</div> --}}

<div class="containerr">
    
    <div class="main-content main-content-cart">

        <h1 class="about-h1" >Terms of Use & Intellectual Property</h1>


        <h2 class="terms-h2"> 1. Personal Use License</h2>
        <p>
            Upon purchase, GradeStar Solutions grants you a single-user, non-exclusive, and 
            non-transferable license to use the provided study materials for your own personal, educational purposes.
        </p>

        <h2 class="terms-h2"> 2. Prohibited Actions</h2>

        <p>
            To protect the integrity of our resources and authors, the following actions are strictly prohibited:
        </p>
        <ul>
            <li>
                <strong>Unauthorized Distribution:</strong> You may not share, email, or upload these files to public or private cloud drives 
                (e.g., Google Drive, Dropbox), social media groups, or discord servers.
            </li>
             <li>
                <strong>Reselling:</strong> You are strictly forbidden from reselling or "renting out" these materials to other students 
                or third-party platforms.
            </li>
             <li>
                <strong>Public Posting:</strong> You may not post our content on study-sharing websites such as CourseHero among others.
            </li>
        </ul>

        <h2 class="terms-h2"> 3. Violation of Terms</h2>
        <p>
            We utilize digital tracking (including IP logging and unique document identifiers) to monitor for unauthorized distribution. 
            If a leak is traced back to your account, your access will be permanently revoked without a refund, 
            and we reserve the right to pursue further action to protect our intellectual property.
        </p>

    </div>

</div>

@endsection