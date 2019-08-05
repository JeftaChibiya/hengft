@extends('layouts.auth')

@section('title', 'HengFT | Get Started')
@section('description', 'Create an account with HengFT, and get 3 to 5 days free')
@section('keywords', 'create account, hengft subscription, hengft account, hengft signup, register')


@section('content')

@section('page_intro')
<!-- register title -->
<div style="background-color: #1644ad" class="mb-4">
    @include('partials.navbar_white')    
    <div class="pt-2 sm:pt-10 pb-8 flex flex-col items-center">
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60" height="60">
                <path fill="rgb(18, 63, 163)" 
                      d="M24 3c-.372 4.105-2.808 8.091-6.873 9.438.297-.552.596-1.145.882-1.783 2.915-1.521 4.037-4.25 4.464-6.251h-2.688c.059-.45.103-.922.139-1.405h4.076zm-24 0c.372 4.105 2.808 8.091 6.873 9.438-.297-.552-.596-1.145-.882-1.783-2.915-1.521-4.037-4.25-4.464-6.251h2.688c-.058-.449-.102-.922-.138-1.404h-4.077zm19-2c0 9.803-5.094 13.053-5.592 17h-2.805c-.498-3.947-5.603-7.197-5.603-17h14zm-7.305 13.053c-1.886-3.26-2.635-7.432-2.646-11.053h-1.699c.205 4.648 1.99 8.333 4.345 11.053zm1.743 4.947h-2.866c-.202 1.187-.63 2.619-2.571 2.619v1.381h8v-1.381c-1.999 0-2.371-1.432-2.563-2.619z"/>
            </svg>
        </div>      
        <p class="w-4/5 sm:w-1/3 mb-4 text-center text-lg tracking-normal leading-normal lg:text-xl font-light mb-2 text-gray-400">
            We're sorry, but if you're not signed up to HengFT for your tips. What are you doing? 
        </p> 
        <p class="text-gray-400">
            <span class="mt-1 text-xs font-bold">HengFT Team</span>        
        </p>
    </div>
</div>
@stop

<register-with-stripe :plans="{{ json_encode($plans) }}" v-cloak inline-template>
    <div>     
        <!-- container and register form -->
        <div class="container mx-auto px-5 p-8 sm:px-48 sm:p-10 mb-12">        
            <div class="flex flex-col pl-3"> 
                <div class="w-full sm:w-1/2 mr-10">
                    <form id="payment-form" @submit.prevent="register" @keydown="deactivate = false">

                        <div class="mb-1">
                            <input type="hidden" id="2k1e09y" value="{{ config('services.stripe.key') }}">
                        </div>                
                        
                        <!-- subscription -->
                        <p class="text-sm font-bold mb-8 text-gray-700">PICK A SUBSCRIPTION</p>
                        <div class="mb-10">
                            <div class="flex flex-row">
                                <!-- loop through avaiable plans + update selected plan + delete error when plan actually selected -->
                                <selectable-plan v-for="plan in plans" :plan="plan" v-model="activePlan" :key="plan.id" @keydown="delete planError"></selectable-plan>                                                                       
                            </div> 
                            <span v-if="showPlanError" class="text-red-500" v-text="planError"></span>                              
                        </div>    
                        
                        <!-- Card details -->
                        <div class="mb-10">
                            <p class="text-sm font-bold mb-4 text-gray-700">ADD A DEBIT/CREDIT CARD</p>                
                            <div class="card-details mb-2 w-full">
                                <div class="flex flex-col py-2">
                                    <div class="flex-no-shrink w-full mb-1">
                                        <div ref="card"></div>
                                    </div>
                                </div>
                                <span v-if="cardErrorOnSubmit" class="text-red-500" v-text="cardErrorOnSubmit"></span>                                        
                            </div>                                

                            <div class="flex flex-row">
                                <div>
                                    
                                </div>
                                <div class="text-sm text-gray-800">
                                    <p class="font-bold text-sm text-gray-700 leading-normal">Why do we need card information for a trial?</p>
                                    <p class="font-light text-sm text-gray-600 leading-normal">
                                        It helps us prevent spammers from signing up, which means better and secure service for you and everyone else. 
                                        You won’t be charged until the end of your trial                                    
                                    </p>
                                </div>
                            </div>                            
                        </div>                         

                        <!-- Account details -->
                        <div class="mb-10 sm:mb-8">
                            <!-- credentials -->
                            <p class="text-sm sm:text-sm font-bold mb-6 text-gray-700">ADD YOUR ACCOUNT DETAILS </p>

                            <!-- username -->
                            <div class="mb-4">
                                <div class="flex items-center border-b border-b-2 py-2 w-full mb-2" :class="[errors.name ? 'border-red-500': 'border-gray-300']">               
                                    <input id="name" type="text" placeholder="Full Name" @keydown="delete errors.name" class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none" :class="[submit ? 'opacity-50': '']" v-model="customer.name" aria-label="name"  :disabled="submit" required/>                                                                                    
                                </div>
                                <span v-if="errors.name" class="text-red-500" v-text="errors.name[0]"></span>                            
                            </div>                             

                            <!-- email -->        
                            <div class="mb-4">
                                <div class="flex border-b border-b-2 py-2 w-full mb-2" :class="[errors.email ? 'border-red-500': 'border-gray-300']">
                                    <input id="email" type="email" placeholder="Email Address" @keydown="delete errors.email"  class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none"  :class="[submit ? 'opacity-50': '']" v-model="customer.email" aria-label="email" :disabled="submit" required />                       
                                </div>
                                <span v-if="errors.email" class="text-red-500" v-text="errors.email[0]"></span>                            
                            </div>

                            <!-- password -->
                            <div class="mb-4">
                                <div class="flex items-center border-b border-b-2 py-2 w-full mb-2" :class="[errors.password ? 'border-red-500': 'border-gray-300']">
                                    <input id="password" type="password" @keydown="delete errors.password"  class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none" placeholder="Password" :class="[submit ? 'opacity-50': '']" v-model="customer.password" aria-label="password" :disabled="submit" required/>  
                                </div>
                                <span v-if="errors.password" class="text-red-500" v-text="errors.password[0]"></span>                            
                            </div>
                            
                            <!-- password confirmation -->
                            <div class="mb-3">
                                <div class="flex items-center border-b border-b-2 py-2 w-full mb-1">
                                    <input id="password-confirm" type="password" class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none" placeholder="Confirm Password" :class="[submit ? 'opacity-50': '']" v-model="customer.password_confirmation" aria-label="password-confirm" :disabled="submit" required>
                                </div>
                                <span class="text-red-500"></span>                             
                            </div>                           
                        </div>
                        
                        <!-- submit button: deactivate until all fields filled in + show loading spinner + deactivate on submit -->
                        <button class="flex justify-center items-center tracking-wide font-bold text-md mt-6 bg-gray-600 rounded-full p-4 w-full text-white focus:outline-none" 
                                :class="[loading ? 'loader': '', submit || !isDeactive ? 'bg-gray-600 opacity-50 cursor-not-allowed': 'bg-blue-500']" style="transition: .5s" type="submit" id="payment-btn" 
                                :disabled="!isDeactive"> 
                            CREATE ACCOUNT 
                        </button>                                                                                                                        
                    </form>   
                </div>          
            </div>
        </div>


        <!-- FAQs -->
        <div style="background: #2e4469" class="mt-3 py-10">
            <div class="container mx-auto px-10 sm:px-24">            
                <div class="flex flex-col">
                    <p class="text-2xl sm:text-3xl text-gray-400 font-medium sm:font-bold sm:mb-10 mb-8 md:text-center lg:text-center">Common 'Plan' Questions</p>

                    <div class="flex flex-col lg:flex-row lg:flex-wrap">
                        <div class="lg:w-1/3 mb-4 lg:border-r border-dashed border-gray-700 text-gray-300 p-2 pl-0">
                            <p class="text-xl font-bold">Can I cancel at any time?</p>
                            
                            <p class="sm:text-md text-lg mt-4 font-light leading-normal">
                            Of course you can. Visit your account page, click "Cancel," and done. 
                            Tears will be shed on this end, but that's not your concern.                
                            </p>
                        </div>

                        <div class="lg:w-1/3 mb-4 lg:border-r border-dashed border-gray-700 text-gray-300 sm:p-2 sm:pl-6">
                            <p class="text-xl font-bold">If I sign up, what do I gain access to?</p>
                            
                            <ul class="sm:text-md text-lg mt-4 font-light list-reset">
                                <li class="mb-1">View your tips, track ones you've read</li>
                                <li class="mb-1">Take part in our giveaways</li>
                                <li class="mb-1">And more</li>
                                <li></li>        
                            </ul>
                        </div>  

                        <div class="lg:w-1/3 mb-4 sm:pl-6 sm:pl-0 text-gray-300">
                            <p class="text-xl font-bold">Is cereal soup?</p>
                            
                            <p class="sm:text-md text-lg mt-4 font-light leading-normal">
                            Look, we've had this conversation over and over. Our bet is that 
                            its somewhere in-between. Put in the microwave for 5-10 minutes, we're sure 
                            it will get there. Now, please, back on track. Are we doing this or not?
                            </p>
                        </div>              
                    </div>

                </div>            
            </div>
        </div>
    
    </div>
 </register-with-stripe>

@endsection