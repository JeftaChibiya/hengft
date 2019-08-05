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
            Why can I not see any Inplay Tips?
        </p>
    </div>    
@stop

<div class="container mx-auto px-5 sm:px-24 pb-10 font-light leading-normal">
    <div class="mb-10 text-lg text-gray-700">
        May be the case due to any but not limited to the following reasons
    </div> 
    <p class="text-gray-700 font-medium text-xl mb-2">It is off-season, or no live matches are occurring</p> 
    <div class="mb-10 text-lg text-gray-700 w-1/2">
        HengFT mainly covers Football, and provides tips for games around the world. As football tips and related content
        is what we mostly cover, there is a possibility that we do encounter some off-season periods where 
        there are no upcoming games in the foreseeable future to cover.
    </div>       
    <p class="text-gray-700 font-medium text-xl mb-2">No games have been covered for that given week</p> 
    <div class="mb-10 text-lg text-gray-700 w-1/2">
        We may occasionally have weeks where unexpected circumstances develop and we not able to post 
        any tips on the site for a given week.
    </div>

    <p class="text-gray-700 font-medium text-xl mb-2">Certain games have not been covered</p> 
    <div class="mb-10 text-lg text-gray-700 w-1/2">
        We always want to ensure we only cover games which will increase your chances of winning.
        Depending on the odds and probability of a given game, we may choose not to cover that particular 
        game.   
    </div> 

    <p class="text-gray-700 font-medium text-xl mb-2">Account has been restricted</p>     
    <p class="mb-6 text-gray-700 text-lg w-1/2">
        Your Account may be restricted due to an unsettled monthly or yearly payment.
        If this happens, your access to all our tips and other content will be restricted.
    </p>    
</div>


@endsection