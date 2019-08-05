@extends('layouts.login_layout')
@section('title', 'HengFT | Login')

@section('content')

<login inline-template>
    <div class="container mx-auto px-10 sm:px-24 pt-8 sm:pt-12">

        <div class="flex flex-col justify-center items-center text-gray-300">
            <p class="self-center sm:text-3xl text-3xl lg:text-4xl font-sans leading-normal font-medium mb-8">Welcome Back!</p>                
            <!-- login form -->
            <form class="sm:w-1/4 w-full md:w-1/3 mb-4 sm:mb-8" @submit.prevent="login" @keydown="deactivate = false">

                <!-- error -->
                <div v-if="error" class="py-6" style="transition: .5s">
                    <ul class="text-lg font-medium text-red-300">
                        <li v-text="error"></li>
                    </ul>
                </div>            

                <!-- email -->
                <div class="flex items-center border-b border-b-2 border-blue-700 p-0 py-2 mb-4">
                    <input id="email" type="text" v-model="form.email" class="appearance-none bg-transparent border-none w-full text-xl font-light py-1 leading-tight focus:outline-none"  placeholder="Email"  autocomplete="email" aria-label="Full name" required>
                </div>
                <!-- password -->
                <div class="flex items-center border-b border-b-2 border-blue-700 p-0 py-2 mb-8">
                    <input id="password" type="text" v-model="form.password" class="appearance-none bg-transparent border-none w-full text-xl font-light py-1 leading-tight focus:outline-none"  placeholder="Password"  aria-label="password" required>
                </div>
                
                <button class="w-full bg-gray-600 text-gray-100 text-sm font-bold mt-2 focus:outline-none p-4 px-3 rounded-lg" :class="[deactivate ? 'bg-gray-600 cursor-not-allowed': 'bg-blue-600 hover:bg-blue-700']" style="transition: background 0.5s" :disabled="deactivate">
                    LOG IN
                </button>

                <div class="flex mt-10 justify-between items-stretch w-full">
                    <div>
                        <a class="text-gray-400 hover:text-gray-300 font-light text-lg no-underline" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>    
                    </div>   
                <div>
                    <div>
                        <a class="text-gray-400 hover:text-gray-300 font-light text-lg no-underline" href="register">
                            Sign Up
                        </a>    
                    </div>    
                </div>
                </div>                                 
            </form>  

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="200" height="200">
                <path fill="rgb(45, 85, 151)" 
                      d="M24 3c-.372 4.105-2.808 8.091-6.873 9.438.297-.552.596-1.145.882-1.783 2.915-1.521 4.037-4.25 4.464-6.251h-2.688c.059-.45.103-.922.139-1.405h4.076zm-24 0c.372 4.105 2.808 8.091 6.873 9.438-.297-.552-.596-1.145-.882-1.783-2.915-1.521-4.037-4.25-4.464-6.251h2.688c-.058-.449-.102-.922-.138-1.404h-4.077zm19-2c0 9.803-5.094 13.053-5.592 17h-2.805c-.498-3.947-5.603-7.197-5.603-17h14zm-7.305 13.053c-1.886-3.26-2.635-7.432-2.646-11.053h-1.699c.205 4.648 1.99 8.333 4.345 11.053zm1.743 4.947h-2.866c-.202 1.187-.63 2.619-2.571 2.619v1.381h8v-1.381c-1.999 0-2.371-1.432-2.563-2.619z"/>
            </svg>                             
        </div>  

    </div>
</login>
@endsection