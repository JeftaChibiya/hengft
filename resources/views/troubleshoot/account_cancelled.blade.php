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
            Has my account really been cancelled?
        </p>
    </div>    
@stop

<div class="container mx-auto px-5 sm:px-24 pb-10 font-light leading-normal">
    <div class="mb-10 text-lg text-gray-700 w-1/2">
        This is a common concern after cancelling a free trial, and a paid subscription (which are both considered HengFT Accounts)
    </div>    
    <p class="text-gray-700 font-medium text-xl mb-2">I've selected the <b>Cancel</b> option</p> 
    <div class="mb-10 text-lg text-gray-700 w-1/2">
        If you have selected the <b>Cancel</b> option, and there is still one or more days left before the 
        end of your Free Trial or Paid Subscription, then your account will be automatically discontinued at 
        the end of the Free Trial or Paid Subscription.
    </div>

    <p class="text-gray-700 font-medium text-xl mb-2">I've selected the <b>Cancel Now</b> option</p> 
    <div class="mb-10 text-lg text-gray-700 w-1/2">    
        If you have selected the <b>Cancel Now</b> option, then your Free Trial or Paid Subscription, along with your 
        personal information are immediately and permanently deleted from 
        our system. Any days remaining on the Free Trial or Paid Subscription will not be considered.
    </div> 
</div>


@endsection