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
            How a HengFT Free Trial works?
        </p>
    </div>    
@stop

<div class="container mx-auto px-5 sm:px-24 pb-10 font-light leading-normal">
    <div class="mb-10 text-lg text-gray-700">
        HengFT offers a new member a number of days free before the start of their 
        paid membership and the billing of the payment method provided. The number of days a new member is offered
        is determined by the type of subscription selected on signing up. A new member will have 3 days free</b> for a Monthly 
        subscription, and 5 days for a Yearly subscription.
    </div>    
    <p class="text-gray-700 font-medium text-xl mb-2">When does it start and end?</p> 
    <div class="mb-10 text-lg text-gray-700">
        <p class="mb-6">
            The length of a given free trial is worked out in terms of hours from the day and time a new member signed up.
            Each day in a given free trial is 24 hours long. 
        </p>
        <p class="mb-8">
           <span class="underline">3-day trial</span>. Lets say a new member signs up today: {{ date('F d') }}.
           Their first ever billing from HengFT will be in 3 days on: {{ date('F d') }}. Heres how the time between the 2 dates is 
           pans out.
        </p>    
        
        <!-- <div class="flex flex-col w-full sm:w-1/2 mx-auto text-gray-300">
            <div class="flex bg-green-400 h-10 mb-8 px-1 items-center rounded-full">
                <div class="flex-1">
                    <span v-text="trialDuration.today"></span>
                </div>
                <div class="flex-1 text-center font-bold self-center">
                    DAY 1
                </div>
                <div class="flex-1 text-right">
                    <span v-text="trialDuration.tomorrow"></span>
                </div>                 
            </div>
            <div class="flex bg-green-500 h-10 mb-8 px-1 items-center rounded-full">
                <div class="flex-1">
                    <span v-text="trialDuration.tomorrow"></span>
                </div>
                <div class="flex-1 text-center font-bold self-center">
                    DAY 2
                </div>
                <div class="flex-1 text-right">
                    <span v-text="trialDuration.lastDayWithTime"></span>
                </div>                 
            </div> 
            <div class="flex bg-orange-500 h-10 mb-8 px-1 items-center rounded-full">
                <div class="flex-1">
                    <span v-text="trialDuration.lastDayWithTime"></span>
                </div>
                <div class="flex-1 text-center font-bold self-center">
                    DAY 3
                </div>
                <div class="flex-1 text-right">
                    <span v-text="trialDuration.lastDayNoTime"></span>, <span v-text="trialDuration.billingTime"></span>
                </div>                 
            </div>                                              
        </div> -->

        <p class="mb-2"><span class="underline">Email Reminder</span>. An email reminder is then sent at the end of <b>DAY 2</b> of the Free trial.</p>

        <p class=""><span class="underline">First Billing Date</span>. The first charge on the payment method provided is made on the end of <b>DAY 3</b> of the Free trial.</p>        
    </div> 

    <p class="text-gray-700 font-medium text-xl mb-2">Why do I need a payment method to start a free trial?</p>     
    <p class="mb-6 text-gray-700 text-lg">
        As stated on our <a href="/register" class="underline">Join</a>
        page, submitting a payment method along when you join increases the chance of only interested members 
        signining to our service. At the same time, this also helps us prevent spammers from signing up, 
        which means better and secure service for you and everyone else. You are not charged until the end of your free trial  
    </p>    
</div>


@endsection