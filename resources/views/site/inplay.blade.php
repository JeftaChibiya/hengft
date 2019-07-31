@extends('layouts.app')

@section('title', 'HengFT | Inplay Tips')
@section('description', 'Analyse the game with HengFT and increase your chances of winning')
@section('robottext', 'all')
@section('keywords', 'Inplay Tips, Accumulator')

@section('content')

@section('page_intro')
    <div style="background: linear-gradient(rgb(24, 121, 120), rgb(33, 131, 127))">
            @include('partials.navbar_white')    
        <div class="pt-2 sm:pt-10 pb-10 flex flex-col items-center">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24"><path fill="#1c7375" d="M16 16c0 1.104-.896 2-2 2h-12c-1.104 0-2-.896-2-2v-8c0-1.104.896-2 2-2h12c1.104 0 2 .896 2 2v8zm8-10l-6 4.223v3.554l6 4.223v-12z"/></svg>                
            </div>      
            <p class="text-center text-2xl sm:text-3xl font-bold mb-2 text-gray-300">
                Analyse The Game with Us
            </p>
            <p class="text-center text-lg font-light font-light text-gray-300"> 
                Build Your Accumulator Live
            </p>
        </div>
    </div>
@stop

<inplay inline-template v-cloak>
    <div class="container mx-auto sm:px-16 px-5 pb-10">
        
        <!-- only div: if no tips exist -->
        <div v-if="!inplaytips.length" class="pt-20 pb-20 lg:text-xl text-center font-bold text-gray-600">
            <scale-loader></scale-loader>
            
            <p class="text-2xl sm:text-3xl font-light text-gray-800 mb-8 text-center">Inplay tips on the way. Stay Tuned</p>                       

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

        <!-- if inplay tips exist -->
        <div v-else class="flex flex-col sm:items-center lg:flex-row mb-10">
            <!-- left-hand flex child -->
            <div class="w-full rounded-lg overflow-hidden mb-8 lg:mb-0">       
                <div class="pt-10">
                        <p class="lg:text-xl font-bold mb-8 text-gray-700">
                            {{ strtoupper(date('F d')) }}
                        </p>    

                        <!-- loading -->
                        <vue-simple-spinner size="large" :speed="0.9" v-if="loading"></vue-simple-spinner> 

                        <transition name="fade"> 
                            <table style="border-collapse: collapse; width: 100%;" class="table-auto text-left" v-show="!loading && inplaytips.length">            
                                <tr class="text-gray-200 py-6" style="background-color: rgb(57, 165, 155)">
                                    <th class="text-lg">Match</th>                            
                                    <th class="text-lg">Our Take</th>         
                                    <th class="text-lg">Time Stamp</th>   
                                    <!-- colspan="3"                                                                                                 -->
                                </tr>
                                <tr v-for="(inplaytip, key) in inplaytips" :key="key">
                                    <td v-text="inplaytip.match"></td>                            
                                    <td>
                                    @if(! Auth::user())
                                        <a href="{{ route('register') }}" class="no-underline text-blue-500 hover:text-blue-600">Sign Up to View</a>
                                    @else
                                    @{{ inplaytip.content }} 
                                    @endif
                                    </td>    
                                    <td v-text="inplaytip.minute"></td>                                                                            
                                </tr>
                            </table>
                        </transition>                        
                        
                        <p class="sm:text-sm md:text-sm lg:text-md font-light lg:font-medium lg:font-light mt-4 mb-4 lg:mb-2 text-grey-darker sm:text-center">
                        </p>                                         
                </div>
            </div>
            <!-- right-hand flex child -->
            <!-- Take our daily poll -->
        </div>      
        
        <!-- extra info -->
        <div class="w-4/5 text-center sm:text-left sm:w-full mx-auto sm:mx-0 mt-20">
            <p class="text-xl font-bold text-gray-700 mb-4">More about our Inplay Tips</p>
            <p class="text-lg sm:text-lg font-light text-gray-600 leading-normal mb-3">
                Our Inplay tips are uploaded after the start of the first game on our review</b>
            </p>                
        </div>  

    </div>

</inplay>

@endsection