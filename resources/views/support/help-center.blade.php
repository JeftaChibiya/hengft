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
    <div class="pt-8 pl-5 sm:pl-16 sm:pt-10 mb-6">
        <p class="text-2xl lg:text-3xl font-bold text-gray-700">
            Help Center
        </p>
    </div>    
@stop

<tips inline-template v-cloak>
    <div class="container mx-auto sm:px-16 pb-10"> 
        <!-- parent flex -->
        <div class="flex flex-col sm:flex-row mt-16 mb-10"> 
            <!-- getting started with HengFT -->
            <div class="w-full sm:w-1/3 mb-2 sm:mb-0 mr-4 px-5 sm:px-0 relative">
                <p class="text-xl font-bold text-gray-600 mb-6">New To HengFT</p>                
                <ul class="text-gray-600 no-underline text-lg font-light mb-10">
                    <li class="mb-5 hover:text-blue-500 hover:underline">
                        <a href="/help/hengft">What is HengFT?</a>
                    </li>
                    <li class="mb-5 hover:text-blue-500 hover:underline">
                        <a href="/help/trial">How does your free trial work?</a>                         
                    </li>
                    <li class="mb-5 hover:text-blue-500 hover:underline">
                        <a href="help/cannot-see-pre-match-tips">Why can I not see any Pre-game Tips?</a>                        
                    </li>
                    <li class="hover:text-blue-500 hover:underline">
                        <a href="help/cannot-see-inplay-tips">Why can I not see any Inplay Tips?</a>                        
                    </li>                                                            
                </ul>                         
            </div>

            <!-- divider div -->
            <div class="mb-8 block sm:hidden bg-gray-200 z-10 h-2 w-full"></div>                           
                     
            <!-- managing account -->
            <div class="w-full sm:w-auto mr-10 px-5 sm:px-0 mb-10 sm:mb-0">
                <p class="text-xl font-bold text-gray-600 mb-6">Managing My Account</p>  
                <ul class="text-gray-600 no-underline text-lg font-light">
                    <li class="mb-5 hover:text-blue-500 hover:underline">
                        <a href="/help/account-restricted">
                            My account seems restricted
                        </a>    
                    </li>                   
                    <li class="mb-5 hover:text-blue-500 hover:underline">
                        <a href="/help/not-receiving-hengft-emails">
                            I can't see emails from HengFT
                        </a>    
                    </li>                                     
                    <li class="hover:text-blue-500 hover:underline">
                        <a href="/help/account-cancelled">Has my account really been cancelled?</a>    
                    </li>                     
                </ul>              
            </div>   
            
            <!-- divider div -->
            <div class="block sm:hidden bg-gray-200 mb-8 z-10 h-2 w-full"></div>          
                                       
            <!-- contact us info link-->
            <div class="w-full sm:w-1/3 pr-4 px-5 sm:px-0">
                <p class="text-xl font-bold text-gray-600 mb-6">Contact Us Directly</p>                

                <a href="/contact">
                    <p class="text-gray-600 underline text-lg">Visit our Contact us page</p>
                </a>
            </div>                              
        </div>    
    </div>                           
</tips>

@endsection