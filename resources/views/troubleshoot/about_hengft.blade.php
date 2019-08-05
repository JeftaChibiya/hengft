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
            <a href="/help" class="text-blue-400 mb-10">Back to Help Center</a>
        </div>        
        <p class="text-2xl lg:text-3xl font-bold text-gray-700 mb-10">
            What is HengFT?
        </p>
    </div>    
@stop

<div class="container mx-auto px-5 sm:px-24 pb-10">
    <p class="text-gray-700 font-medium mb-4 text-xl">HengFT Football Tips</p> 
    <p class="mb-6 text-gray-700 font-light text-lg leading-normal">
       HengFT provides a personalized subscription service that provides members with
       betting Tips for Football competitions around the world.        
       Find our Pre-match Tips here: <a href="/tips" class="underline">Tips</a>, Inplay Tips here: <a href="/inplay" class="underline">Inplay Tips</a>.
    </p>         

    <p class="text-gray-700 font-medium mb-4 text-xl">Free Trial</p>
    <p class="mb-8 text-gray-700 font-light text-lg">
       We've covered this in-depth here: <a href="/help/trial" class="underline">How a HengFT Free Trial works?</a> 
    </p>     

    <p class="text-gray-700 font-medium mb-4 text-xl">Membership</p> 
    <p class="mb-6 text-gray-700 font-light text-lg leading-normal">
       A long-term HengFT membership begins after the end of the Free Trial. A valid payment method must be 
       provided and charged in order for the membership to continue. The billing date will vary depending 
       on when a HengFT account and subscription is created. As a membership is not based on contract, 
       it may be necessary to discontinue a membership given the payment method provided could not 
       be charged after 3 attempts to make the charge.
    </p> 
    <p class="mb-6 text-gray-700 font-light text-lg leading-normal">
        <span class="underline">Failed payments</span>. If a payment cannot be collected from a given payment 
        method of the first time, an email will be sent shortly after the failed charge. The email will remind a 
        member to update their payment method if need be. If the situation remains, HengFT will attempt to 
        collect the payment 2 more times. All together, HengFT attempts to collect a payment up to 3 times over
        a timespan of 3 weeks before cancelling the membership associated with the payment method.
    </p>             
</div>


@endsection