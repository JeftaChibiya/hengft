@extends('layouts.farewell')
@section('title', 'HengFT | What Now?')

@section('content')

<div class="container px-10 sm:px-24 pt-20">

    <div class="flex flex-col justify-center sm:items-center text-gray-400">
        <p class="sm:text-center sm:text-3xl text-3xl lg:text-4xl font-sans leading-normal font-medium mb-10">
            Your HengFT Account Has Been Deleted
        </p> 
        
        <p class="w-full mb-16 sm:w-5/12 sm:text-center text-xl sm:text-xl font-sans leading-relaxed font-light mb-8">
            Please be assured that any of your data given to HengFT upon sign up or through other forms of interaction has been 
            removed from our system. Please check your emails for another one from us. <br/><br/>
            
            We hope to see you again.
        </p>  

        <div class="w-1/2 sm:w-1/4 flex justify-between">
            <a class="navbar-brand-item" href="{{ url('/') }}" data-turbolinks="false">
                RETURN HOME
            </a> 
            <a class="navbar-brand-item" href="{{ route('register') }}" data-turbolinks="false">
                SIGN UP
            </a>             
        </div>                                                 
    </div>  

</div>

@endsection