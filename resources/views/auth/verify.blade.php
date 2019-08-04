@extends('layouts.app')

@section('content')

@section('page_intro')
    @include('partials.navbar_white')   
@stop

<div class="flex flex-col items-center mt-10 mb-14">
    <div class="flex flex-col items-center mb-10">
        <p class="sm:text-xl md:text-2xl lg:text-2xl font-bold mt-8 mb-8 text-gray-700">
            Confirm your email address to continue
        </p> 

        <p class="text-xl lg:font-light mb-10 text-grey-darkest">
            Once you verify your email address, you can get started with HengFT. 
            Please check your email inbox for a verification link.
        </p> 

        <div class="w-1/2 flex flex-row">
            <div>
                Open Gmail
            </div>
            <div>
                Open Outlook            
            </div>
            <div>
                Open Yahoo            
            </div>
        </div>

        <p class="text-xl lg:font-light mb-10 text-grey-darkest">
            Didn’t receive an email? Click the link to resend a new verification link            
        </p>         

        <a href="{{ route('verification.resend') }}">
            <button class="focus:outline-none rounded-full bg-transparent text-gray-700 hover:text-black font-semibold py-2 px-4 border border-gray-600 hover:border-gray-700 hover:border-transparent">RE-SEND LINK</button>
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