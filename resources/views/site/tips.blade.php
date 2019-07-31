@extends('layouts.app')

@section('title', 'HengFT | Pre-match Tips')
@section('description', 'Build your own accumulator with a mix of betting tips sport competitions around the world')
@section('robottext', 'all')
@section('keywords', 'Bettings Tips, Accumulator')

<!-- fb meta tags -->
@section('fb_title', 'Pre-match Tips')
@section('fb_description', 'Get daily tips')
@section('fb_image', 'https://hengft.com/images/heng_fb_tips.png')

@section('content')

@section('page_intro')
    <div style="background: linear-gradient(180deg, rgb(38, 69, 137), rgb(38, 76, 137))">
            @include('partials.navbar_white')    
        <div class="pt-2 sm:pt-10 pb-10 flex flex-col items-center">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24"><path fill="#224482" d="M21.698 10.658l2.302 1.342-12.002 7-11.998-7 2.301-1.342 9.697 5.658 9.7-5.658zm-9.7 10.657l-9.697-5.658-2.301 1.343 11.998 7 12.002-7-2.302-1.342-9.7 5.657zm12.002-14.315l-12.002-7-11.998 7 11.998 7 12.002-7z"/></svg>
            </div>      
            <p class="text-center text-2xl lg:text-3xl font-bold mb-2 text-blue-100">
                Build Your Own Accumulator
            </p>
            <p class="text-center text-lg font-light font-light mt-2 text-blue-100"> 
                Make Your Own Single, Double or Triple
            </p>
        </div>
    </div>
@stop

<tips inline-template v-cloak>
    <div class="container mx-auto px-5 sm:px-16 pb-8"> 

        <!-- only div: if no tips exist -->
        <div v-if="!todaysTips.length" class="pt-20 pb-20 lg:text-xl text-center font-bold text-gray-600">
            <scale-loader></scale-loader>
            <p class="text-2xl sm:text-3xl font-light text-gray-800 mb-8 text-center">Pre-game tips on the way. Stay Tuned</p>                

            <p class="text-lg sm:text-lg font-light text-gray-600 leading-normal mb-3 mt-6">
                In the meantime - stay in touch with us on Twitter
            </p>  

            <div class="flex items-stretch w-1/2 mx-auto text-gray-500 text-center py-2">
                <div class="flex-1">
                    <a href="https://mobile.twitter.com/HengFT" target="_blank">
                        <i class="fab fa-twitter-square fa-2x hover:text-gray-400" style="transition: .5s"></i>
                    </a>       
                </div>
            </div>                          
        </div>

        <!-- parent flex -->
        <div v-else class="flex flex-col mb-20">                                     
            <!-- top / first child to flex-col above -->
            <div class="sm:items-center sm:flex-row pt-10">
                <!-- left flex child: today's and recent / older ones -->
                <div class="w-full  overflow-hidden sm:mr-10 mb-8 sm:mb-0 pt-8">                                                         
                    <p class="lg:text-xl font-bold mb-8 text-gray-700">
                        TODAY'S MENU
                    </p>                                  
                    <!-- content -->
                    <transition name="fade">                                       
                        <table style="border-collapse: collapse; width: 100%; " class="mb-8 table-auto text-left" v-if="!loading && todaysTips.length">            
                            <tr class="text-gray-200 py-6" style="background-color: rgb(52, 80, 130)">
                                <th class="text-lg">At</th>                            
                                <th class="text-lg" colspan="1">Match</th>
                                <th class="text-lg" colspan="3">Tip</th>                           
                            </tr>
                            <tr v-for="(tip, key) in todaysTips" :key="key">
                                <td v-text="tip.start_time"></td>                                
                                <td v-text="tip.match"></td>
                                <td>
                                @if(! Auth::user())
                                    <a href="{{ route('register') }}" class="no-underline text-blue-500">Sign up to view</a>
                                @else
                                @{{ tip.tip }} 
                                @endif
                                </td>                                   
                            </tr>
                        </table>

                        <!-- loading -->
                        <vue-simple-spinner size="large" :speed="0.9" v-if="loading"></vue-simple-spinner>                    
                    </transition>                                                                                                                                                   
                </div>
            </div>          
        </div>                       
            
                    
        <div class="w-4/5 text-center sm:text-left sm:w-full mx-auto sm:mx-0 mt-12 sm:mt-24">
            <p class="text-xl font-bold text-gray-700 mb-4">More about our Pre-game Tips</p>
            <p class="text-lg sm:text-lg font-light text-gray-600 leading-normal mb-3">
                Our pre-match tips are uploaded by <b>2pm on weekdays</b> and <b>12pm on weekends</b>
            </p>                
        </div> 

    </div>                
</tips>

@endsection