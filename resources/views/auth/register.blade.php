@extends('layouts.auth')

@section('title', 'HengFT | Get Started')
@section('description', 'Create an account with HengFT, and get 3 to 5 days free')
@section('keywords', 'create hengft account, signup, register, create account')


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
            <div class="flex flex-col sm:flex-row pl-3"> 
                <div class="w-full sm:w-1/2 mr-10">
                    <form id="payment-form" @submit.prevent="register" @keydown="submitted = false">

                        <div class="mb-1">
                            <input type="hidden" id="2k1e09y" value="{{ config('services.stripe.key') }}">
                        </div>                
                        
                        <!-- subscription -->
                        <p class="text-sm font-bold mb-8 text-gray-700">PICK A SUBSCRIPTION</p>
                        <div class="mb-10">
                            <div class="flex flex-row mb-4">
                                <selectable-plan v-for="plan in plans" :plan="plan" :deactivate="deactivate" v-model="customer.activePlan" :key="plan.id"></selectable-plan>                                                                       
                            </div>  
                        </div>    
                        
                        <!-- Card details -->
                        <div class="mb-10">
                            <p class="text-sm font-bold mb-4 text-gray-700">ADD A DEBIT/CREDIT CARD</p>                
                            <div class="card-details mb-1 w-full">
                                <div class="flex flex-col py-2">
                                    <div class="flex-no-shrink w-full mb-4">
                                        <div ref="card"></div>
                                    </div>
                                </div>       
                            </div>    
                            <div v-text="cardFormError"></div>           

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
                                    <input id="name" type="text" placeholder="Full Name" @keydown="delete errors.name" class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none" :class="[submitted ? 'opacity-50': '']" v-model="customer.name" aria-label="name"  :disabled="submitted" required/>                                                                                    
                                </div>
                                <span v-if="errors.name" class="text-red-500" v-text="errors.name[0]"></span>                            
                            </div>                             

                            <!-- email -->        
                            <div class="mb-4">
                                <div class="flex border-b border-b-2 py-2 w-full mb-2" :class="[errors.email ? 'border-red-500': 'border-gray-300']">
                                    <input id="email" type="email" placeholder="Email Address" @keydown="delete errors.email"  class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none"  :class="[submitted ? 'opacity-50': '']" v-model="customer.email" aria-label="email" :disabled="submitted" required />                       
                                </div>
                                <span v-if="errors.email" class="text-red-500" v-text="errors.email"></span>                            
                            </div>

                            <!-- password -->
                            <div class="mb-4">
                                <div class="flex items-center border-b border-b-2 py-2 w-full mb-2" :class="[errors.password ? 'border-red-500': 'border-gray-300']">
                                    <input id="password" type="password" @keydown="delete errors.password"  class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none" placeholder="Password" :class="[submitted ? 'opacity-50': '']" v-model="customer.password" aria-label="password" :disabled="submitted" required/>  
                                </div>
                                <span v-if="errors.password" class="text-red-500" v-text="errors.password[0]"></span>                            
                            </div>
                            
                            <!-- password confirmation -->
                            <div class="mb-3">
                                <div class="flex items-center border-b border-b-2 py-2 w-full mb-1">
                                    <input id="password-confirm" type="password" class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none" placeholder="Confirm Password" :class="[submitted ? 'opacity-50': '']" v-model="customer.password_confirmation" aria-label="password-confirm" :disabled="submitted" required>
                                </div>
                                <span class="text-red-500"></span>                             
                            </div>                           
                        </div>
                          

                        <button class="tracking-wide flex justify-center items-center font-bold text-md mt-6 bg-gray-600 rounded-full p-4 w-full text-white focus:outline-none" 
                                :class="[loading ? 'loader': '', submitted || !isDeactive ? 'bg-gray-600 opacity-50 cursor-not-allowed': 'bg-blue-500']" style="transition: .5s" type="submit" id="payment-btn" 
                                :disabled="!isDeactive"> 
                            CREATE ACCOUNT 
                        </button>                                                                                                                        
                    </form>   
                </div> 
                <div class="w-full pt-16">
                    <transition name="fade">
                        <div class="flex items-center pl-3 bg-gray-200 border border-gray-200" v-if="customer.activePlan.trial_period_days">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="#cccccc" d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5.848 12.459c.202.038.202.333.001.372-1.907.361-6.045 1.111-6.547 1.111-.719 0-1.301-.582-1.301-1.301 0-.512.77-5.447 1.125-7.445.034-.192.312-.181.343.014l.985 6.238 5.394 1.011z"/></svg>                                
                            </div>
                            <div class="p-4 text-gray-600">                        
                                <p class="sm:text-md text-lg font-light leading-normal mb-2">
                                    <span v-html="DateMessage"></span> <span v-text="plusTrialDays" class="font-medium text-gray-700"></span>
                                </p> 
                                <p class="sm:text-md text-lg font-light leading-normal">
                                        <span v-html="EmailMessage"></span> <span v-text="trialDaysMinusOne" class="font-medium text-gray-700"></span>                            
                                </p>                                               
                            </div>                        
                        </div>
                    </transition>
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