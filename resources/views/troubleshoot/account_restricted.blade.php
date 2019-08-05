@extends('layouts.app')

@section('title', 'HengFT - Contact')
@section('description', 'Contact us by form, email and more methods to come')
@section('robottext', '')
@section('keywords', 'HengFT contact, contact form, email')

<!-- fb meta tags -->
@section('fb_title', 'HengFT Contact')
@section('fb_description', 'Contact us by form, email and more methods to come')


@section('content')

@section('page_intro')
    <div style="background: linear-gradient(180deg, rgb(38, 69, 137), rgb(38, 76, 137))">
            @include('partials.navbar_white')    
    </div>
    <div class="pt-3 pl-5 sm:pl-16 sm:pt-10 mb-6">
        <div class="mb-8 mt-3 font-light">
            <a href="/help" class="text-blue-400 text-sm mb-10">Back to Help Center</a>
        </div>        
        <p class="text-2xl lg:text-3xl font-bold text-gray-700 mb-10">
            My Account seems restricted
        </p>
    </div>    
@stop

<div class="container mx-auto px-5 sm:px-24 pb-10 font-light leading-normal">  
    <div class="mb-10 text-lg text-gray-700 w-1/2">
        A restriction to your account implies access to pre-match and inplay tips, and including other 
        HengFT content is limited or replaced with a form of message to inform you of the restriction.
    </div>      
    <p class="text-gray-700 font-medium text-xl mb-2">Update your <b>Payment Method</b></p>     
    <div class="mb-10 text-lg text-gray-700 w-1/2">
        This will likely occur if up to 3 attempts to charge the payment method provided have failed.
        In addition to informative message within our website, you will receive a number of emails to 
        provide you more information about the casuse of the restriction, and the action you need to take. 
    </div> 
</div>


@endsection