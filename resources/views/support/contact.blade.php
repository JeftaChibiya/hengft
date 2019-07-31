@extends('layouts.app')

@section('title', 'HengFT | Contact')
@section('description', 'Contact us by form, email and more methods to come')
@section('robottext', '')
@section('keywords', 'HengFT contact, contact form, email')

<!-- fb meta tags -->
@section('fb_title', 'HengFT | Contact')
@section('fb_description', 'Contact us by form, email and more methods to come')


@section('content')

@section('page_intro')
    <div style="background: linear-gradient(180deg, rgb(38, 69, 137), rgb(38, 76, 137))">
            @include('partials.navbar_white')    
        <div class="pt-2 sm:pt-10 pb-10 flex flex-col items-center">
            <div class="mb-4">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24"><path fill="#2D5597" d="M21.698 10.658l2.302 1.342-12.002 7-11.998-7 2.301-1.342 9.697 5.658 9.7-5.658zm-9.7 10.657l-9.697-5.658-2.301 1.343 11.998 7 12.002-7-2.302-1.342-9.7 5.657zm12.002-14.315l-12.002-7-11.998 7 11.998 7 12.002-7z"/></svg> -->
            </div>      
            <p class="text-center text-2xl lg:text-3xl font-medium mb-6 text-gray-400">
                Contact us
            </p>
            <p class="text-center text-xl sm:text-2xl font-light font-light mt-2 text-gray-300"> 
                Let us know how we can help
            </p>            
        </div>
    </div>
@stop


<div class="container mx-auto px-5 sm:px-16 pb-10"> 
    <!-- parent flex -->
    <div class="flex flex-col sm:flex-row justify-around mt-16">    
        <div class="w-full sm:w-1/3 mb-8 sm:mb-0 border border-gray-400 bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg p-2 h-48 flex flex-col items-center justify-center">            
            <svg xmlns="http://www.w3.org/2000/svg" class="mb-8" width="44" height="44" viewBox="0 0 24 24"><path fill="#008cdd" d="M12 12.713l-11.985-9.713h23.97l-11.985 9.713zm0 2.574l-12-9.725v15.438h24v-15.438l-12 9.725z"/></svg>        
            
            <keep-alive>
                <support-button></support-button>
            </keep-alive>            
        </div>                           

        <a href="help" class="w-full sm:w-1/3 border border-gray-400 bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-lg text-center h-48 flex flex-col items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mb-8" width="44" height="44" viewBox="0 0 24 24"><path fill="#008cdd" d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 18.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25c.691 0 1.25.56 1.25 1.25s-.559 1.25-1.25 1.25zm1.961-5.928c-.904.975-.947 1.514-.935 2.178h-2.005c-.007-1.475.02-2.125 1.431-3.468.573-.544 1.025-.975.962-1.821-.058-.805-.73-1.226-1.365-1.226-.709 0-1.538.527-1.538 2.013h-2.01c0-2.4 1.409-3.95 3.59-3.95 1.036 0 1.942.339 2.55.955.57.578.865 1.372.854 2.298-.016 1.383-.857 2.291-1.534 3.021z"/></svg>        
            <p class="text-xl font-light text-gray-600 mb-8">Check out our Help Center</p>             
        </a>
    </div>                     
</div>                           

@endsection