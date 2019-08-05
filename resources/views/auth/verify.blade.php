@extends('layouts.app')

@section('content')

@section('page_intro')
    <div style="background-color: rgb(46, 58, 77)">
        @include('partials.navbar_white')
    </div>   
@stop

<div class="container px-5 flex flex-col items-center mx-auto mt-10 sm: mb-14">
    <div class="flex flex-col items-center mb-10">
        <p class="text-xl sm:text-2xl font-bold mt-8 mb-8 text-gray-700">
            Confirm your email address to continue
        </p> 

        <p class="text-xl font-light mb-10 text-gray-900">
            Please check your email inbox for a verification link.
        </p> 

        <div class="w-full flex items-stretch mx-auto mb-20 sm:mb-16">
            <a href="https://accounts.google.com/signin/v2/identifier?continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&service=mail&sacu=1&rip=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin" 
              class="flex-1 p-2 rounded-lg border text-lg text-center text-gray-700 mr-2 hover:border-gray-400 hover:text-gray-800">
                Open Gmail
            </a>
            <a href="https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=13&ct=1564960615&rver=7.0.6737.0&wp=MBI_SSL&wreply=https%3a%2f%2foutlook.live.com%2fowa%2f%3fnlp%3d1%26RpsCsrfState%3d42f3a1ad-aa24-94e7-f18d-c9ba48a7dd54&id=292841&aadredir=1&CBCXT=out&lw=1&fl=dob%2cflname%2cwld&cobrandid=90015" 
              class="flex-1 p-2 rounded-lg border text-lg text-center text-gray-700 mr-2 hover:border-gray-400 hover:text-gray-800">
                Open Outlook            
            </a>
            <a href="https://login.yahoo.com/?.src=ym&.partner=none&.lang=en-GB&.intl=uk&.done=https%3A%2F%2Fmail.yahoo.com%2Fd%3F.intl%3Duk%26.lang%3Den-GB%26.partner%3Dnone%26.src%3Dfp" 
              class="flex-1 p-2 rounded-lg border text-lg text-center text-gray-700 mr-2 hover:border-gray-400 hover:text-gray-800">
                Open Yahoo            
            </a>
        </div>

        <p class="text-lg sm:text-xl text-center font-light mb-10 text-gray-800">
            Didn’t receive an email? Click the link to resend a new verification link            
        </p>         

        <a href="{{ route('verification.resend') }}">
            <button class="focus:outline-none rounded-full bg-transparent text-gray-700 hover:text-black font-semibold py-2 px-6 border border-gray-600 hover:border-gray-700 hover:border-transparent">RE-SEND LINK</button>
        </a>

        @if (session('resent'))
            <div class="mt-8 mb-10" role="alert">
                <div class="max-w-sm not rounded overflow-hidden shadow-md bg-blue-200" style="position: relative">        
                    <div class="px-6 py-4">
                        <span class="delete-btn text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times fa-2x"></i>                
                        </span>            
                        <p class="text-center text-gray-300">
                            <i class="fas fa-shipping-fast fa-3x mb-2"></i>
                        </p>
                        <p class="text-gray-800 text-lg">
                            A fresh verification link has been sent to your email address
                        </p>
                    </div>
                </div>    
            </div>
        @endif
    </div>
</div>

@endsection