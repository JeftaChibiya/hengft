@extends('layouts.main')

@section('title', 'HengFT: Get Straight To The Tips. No Ad Pop-ups')
@section('description', 'Clutter-free And Easy To Digest Football Tips To Get You Straight To The Win')
@section('robottext', 'index')
@section('keywords', 'Bettings Tips, Football Bettings Tips, Inplay Tips, Bookie Offers')

<!-- fb meta tags -->
@section('fb_title', 'HengFT: Get Straight To The Tips. No Ad Pop-ups')
@section('fb_description', 'Clutter-free And Easy To Digest Tips To Get You Straight To The Win')
@section('fb_image', 'https://www.dropbox.com/s/rbplqq3sjfzpqqx/heng_social.png?raw=1')

@section('twitter_site', '@hengft')
@section('twitter_title', 'Get straight to the tips, no popup ads')
@section('twitter_desc', 'Get straight to the tips, no popup ads')
@section('twitter_img', 'https://www.dropbox.com/s/rbplqq3sjfzpqqx/heng_social.png?raw=1')


@section('content')
    <div class="container mx-auto sm:px-5 px-5 mb-20 lg:px-24">
        @guest 
        <div class="flex flex-col mt-16 mb-20 text-center"> 
            <p class="text-center text-2xl sm:text-4xl font-bold text-gray-400"> 
                Get 3 - 5 days free
            </p>             
            
            <div class="w-full mx-auto mt-8 mb-10 sm:w-3/5">
                <p class="w-3/4 mx-auto mb-6 tracking-normal leading-normal text-center text-lg sm:text-xl font-light text-gray-300"> 
                    Sign up to our Monthly plan today, and enjoy HengFT Tips <b>Free</b> until 
                    <b><span v-text="trialDuration.lastDayString"></span></b>
                </p> 

                <div class="mb-10">
                    <div class="flex items-stretch text-gray-300 pt-16">
                        <div class="h-3 flex-1 relative">             
                        </div>
                        <div class="h-3 flex-1 relative text-gray-400">   
                            <span class="top-left" v-text="trialDuration.tomorrow"></span>                                                                                      
                        </div>
                        <div class="h-3 flex-1 relative text-gray-400">
                            <span class="top-left" v-text="trialDuration.plusOne"></span> 
                            <span class="top-right-higher text-sm text-gray-500">FIRST BILL</span>
                            <span class="top-right" v-text="trialDuration.lastDay"></span>                                             
                        </div>
                    </div>
                    <div class="flex items-stretch rounded-full w-full text-xl text-gray-800 font-bold green_to_yellow">
                        <div class="h-10 flex-1 flex text-center justify-center items-center relative">
                            Day 1
                            <div class="hidden sm:block  middle-div h-3 w-3 rounded-full bg-gray-800"></div>                            
                        </div>
                        <div class="h-10 flex-1 flex text-center justify-center items-center relative">
                            Day 2
                            <div class="hidden sm:block middle-div h-3 w-3 rounded-full bg-gray-800"></div>
                        </div>
                        <div class="h-10 flex-1 flex text-center justify-center items-center relative">
                            Day 3
                            <div class="hidden sm:block absolute right-0 mr-2 h-3 w-3 rounded-full bg-gray-800"></div>                            
                        </div>            
                    </div>             
                </div>                
            
            </div>  
                       
        <a href="{{ route('register') }}">
            <button class="bg-yellow-300 hover:bg-yellow-400 text-gray-800 font-bold py-3 px-4 rounded-full w-1/2 sm:w-1/4 mx-auto focus:outline-none" style="transition: .5s">
                GET STARTED
            </button>   
        </a>  

        </div>
        @endguest        

        <div class="flex flex-col mt-10">
            <p class="text-center text-2xl sm:text-4xl font-bold mt-4 mb-8 text-gray-400"> 
                Frequently Asked Questions
            </p> 
            
            <div class="wrapper mt-6 mx-auto sm:w-4/6 w-full">
                <ul class="accordion w-full" id="accordion">
                    @foreach($faqs as $faq)
                    <li class="accordion-item mb-2">
                        <div class="accordion-link pl-3 sm:pl-6 p-6 mb-1 text-xl tracking-wide font-medium text-gray-200 js-accordion-link">{{ $faq->title }} </div>
                        <ul class="accordion-submenu js-accordion-submenu" style="display: none;">
                            <li class="accordion-submenu-item pl-3 sm:pl-6 px-6 py-6 text-lg text-gray-200 font-light tracking-normal leading-normal">
                                {{ $faq->body }}
                            </li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>  

        </div>    
    </div>
@endsection