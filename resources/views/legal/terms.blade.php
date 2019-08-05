@extends('layouts.app')

@section('title', 'HengFT - Terms of Use')
@section('description', 'HengFT terms of use')
@section('robottext', '')
@section('keywords', 'HengFT Terms, Terms of Use')

<!-- fb meta tags -->
@section('fb_title', 'HengFT - Terms of Use')
@section('fb_description', 'HengFT Terms, Terms of Use')


@section('content')

@section('page_intro')
    <div style="background: linear-gradient(180deg, rgb(38, 69, 137), rgb(38, 76, 137))" class="mb-16">
            @include('partials.navbar_white')    
        <div class="pt-2 sm:pt-10 pb-10 flex flex-col items-center">
            <div class="mb-4">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 24 24"><path fill="#2D5597" d="M21.698 10.658l2.302 1.342-12.002 7-11.998-7 2.301-1.342 9.697 5.658 9.7-5.658zm-9.7 10.657l-9.697-5.658-2.301 1.343 11.998 7 12.002-7-2.302-1.342-9.7 5.657zm12.002-14.315l-12.002-7-11.998 7 11.998 7 12.002-7z"/></svg> -->
            </div>      
            <p class="text-2xl lg:text-3xl font-medium mb-2 text-gray-400">
                Terms of Use
            </p>
        </div>
    </div>
@stop

<div class="container mx-auto px-5 sm:px-24 pb-10"> 
    <div class="mx-auto w-full sm:w-11/12">
        <!-- overview -->
        <p class="text-2xl font-light text-gray-700 mb-4">Overview</p>             
        <p class="text-lg font-light leading-normal tracking-normal text-gray-700 mb-8">
            HengFT provides a personalized subscription service that allows our members to access Tips for Football competitions around 
            the world.
            These Terms of Use govern your use of our service. As used in these Terms of Use, "HengFT service", "our service" or 
            "the service" means the personalized service provided by HengFT for accessing Football Tips, 
            the functions provided through the website, and the user interfaces, as well as all content and associated with our service.                    
        </p>     

        <!-- free membership -->
        <p class="text-2xl font-light text-gray-700 mb-4">1. Membership</p>                
        <p class="text-lg font-light leading-normal tracking-normal text-gray-700 mb-6">
            1.1 Your HengFT membership will continue until cancelled. To access HengFT Football Tips, 
            you must have Internet access, and provide us with a Payment Method. "Payment Method" is a valid and accepted
            method of payment. Unless you cancel your membership before your billing date, 
            you authorize us to charge the membership fee for the next billing cycle to your Payment Method (read more on "# Cancellation").                     
        </p> 
        
        <!-- free trials  -->
        <p class="text-2xl font-light text-gray-700 mb-8">2. Free Trials</p>
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            2.1.  Your HengFT membership will start with a free trial. The duration of the free trial period of your membership will be specified 
            during sign-up and is intended to allow new members 
            and certain former members to try the service. 
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            2.2. <span class="underline">Eligibility.</span> Free trial eligibility is determined by HengFT, and we may limit eligibility to prevent free trial abuse. We reserve the right to revoke the free trial and put your account on hold in the event that we determine that you are not eligible. 
            Members with an existing or recent HengFT membership are not eligible. We may use information such as device ID, method of payment or an account email address used with an existing or recent HengFT membership to determine eligibility. 
            For combinations with other offers, restrictions may apply.
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            2.3. <span class="underline">First billing charge after free trial.</span> We will charge the membership fee for the next billing cycle to your Payment Method at the end
            of the free trial period unless you cancel your membership before the end of the free trial period. 
            To view the membership charge and end date of your free trial period, visit our website and click the "Subscription" link on the "User Settings" page.
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            2.4. <span class="underline">Cancelling a Free Trial.</span> A free trial may be cancelled at any time before the free trial period ends
            without any charge
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            2.5. <span class="underline">Resuming a Free Trial.</span> A cancelled trial can be resumed given: there is one or more unused days
            on the trial. As per terms of starting a trial, the resumed trial will 
            continue to run without any charge
        </p>                                                              
                        
        <p class="text-2xl font-light text-gray-700 mt-8 mb-8">3. Subscriptions</p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            3.1.  A subscription refers to the type of Billing Cycle (how often a member is billed).
        </p>  
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            3.2.  <span class="underline">Subscriptions.</span> HengFT offers 2 types of subscriptions, including: a Monthly subscription, which means that a member is billed
            after every 30 days, and a Yearly subscription which means that a member is billed every 365 days.
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            3.3.  <span class="underline">Switching Subscriptions.</span> A member may move from one form of subcription to another using the facilities 
            on the 'Susbcription' page within 'User Settings'. The estimate charge for the unused days 
            on the subscription plan a member is currently on is automatically deducted from the charge required for 
            the subscription that is switched to.
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            3.5.  <span class="underline">Unusued days on current subscription.</span> HengFT will only enable deductions from the total charge of a subscription switched to 
            if there are one or more unused days. Further information relating to Subscription Switching is provided 
            throughout the process of moving from one subscription plan to the other.
        </p>                                                                          
            
        <!-- Billing and Cancellations -->
        <p class="text-2xl font-light text-gray-700 mt-8 mb-4">4. Billing and Cancellations</p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            4.1.  <span class="underline">Billing Cycle</span> The membership fee for the HengFT service will be charged to your Payment Method 
            on the specific billing date indicated within the User Settings, on the "Subscriptions" page. How often you are billed will depend on the type of subscription you choose when you sign-up for the service. 
            In some cases your payment date may change, for example if your Payment Method has not successfully settled or if your paid membership began on a day not contained in a given month. 
            Visit the "Subscription" link on the "Settings" page to see your next payment date.
        </p>
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            4.2.  <span class="underline">Payment Methods</span>  To use the HengFT service you must provide a Payment Method. 
            By doing so, you authorize us to charge the Payment Method associated with your account. If a payment is not successfully settled, 
            due to payment method expiration, insufficient funds, or otherwise, and you do not cancel your account, we may suspend your access to the service until 
            we have successfully charged a valid Payment Method. Local tax charges may vary depending on the Payment Method used. 
            Check with your Payment Method service provider for details.
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            4.3.  <span class="underline">Updating Payment Methods.</span>  You can update your Payment Methods by going to the "Payment Method" link within the user "Settings".  
            Following any update, you authorize us to continue to charge the applicable Payment Method(s).
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            4.4.  <span class="underline">Cancellation.</span> You can cancel your HengFT membership at any time, 
            and you will continue to have access to the HengFT service through to the end of your billing period. 
            Payments are non-refundable and we do not provide refunds. To cancel, go to the "Cancel" link within user "Settings" page and follow the instructions for cancellation. 
            If you cancel your membership, your account will automatically close at the end of your current billing period. 
            To see when your account will close, click the "Subscription" link within the "Settings" page.
        </p>
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            4.5.  <span class="underline">Changed to Price and Susbcription Plans.</span> We may change our subscription plans and the price of our service from time to time; however, 
            any price changes or changes to your subscription plans will only apply to the following billing cycles after you have been informed of the changes.
        </p>                                                 
        
        <!-- HengFT Service -->
        <p class="text-2xl font-light text-gray-700 mt-8 mb-4">5. HengFT Service</p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            4.1. The HengFT Tips and any other content found through the HengFT service are for your personal 
            and non-commercial use only. You agree not to use the service for public use.                
        </p>
        <!-- Passwords and Account Access -->
        <p class="text-2xl font-light text-gray-700 mt-8 mb-4">6. Passwords and Account Access</p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            6.1. The member who created the HengFT account and whose Payment Method is charged (the "Account Owner") has access and 
            control over the HengFT account and is responsible for any activity that occurs through the HengFT account.               
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            6.2. To maintain control over the account and to prevent anyone from accessing the account 
            the Account Owner should maintain control over the HengFT Account and
            not reveal the password or details of the Payment Method associated with the account to anyone. 
            You are responsible for updating and maintaining the accuracy of the information you provide to us relating to your account. 
            We can terminate your account or place your account on hold in order to protect you, 
            HengFT or third-party services from identity theft or other fraudulent activity.               
        </p> 
        <!-- Miscellaneous -->
        <p class="text-2xl font-light text-gray-700 mt-8 mb-4">7. Miscellaneous</p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            7.1. <span class="underline">Governing Law relating to HengFT Terms.</span> These Terms of Use shall be in effect in accordance with the Data Protection laws of the 
            European Economic Area (EEA)                
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            7.2. <span class="underline">Customer Support.</span> To find more information about our service and its features or if you need assistance with your account, 
            please visit the HengFT Help Center on our website.               
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            7.3. <span class="underline">Changes to Terms of Use.</span> HengFT may, from time to time, change these Terms of Use. 
            We will notify you at least 30 days before such changes apply to you.      
        </p> 
        <p class="text-lg font-light leading-normal text-gray-700 mb-6">
            7.4. <span class="underline">Electronic Communications.</span> We will send you information relating to your account 
            (e.g. payment authorizations, invoices, changes in password or Payment Method, confirmation messages, notices) in electronic form only, 
            for example via emails to your email address provided during registration.        
        </p>     
        
        <!-- end of doc -->
        <p class="text-lg font-bold text-gray-700 mt-3">
            Last Updated: <span class="font-light">July 7, 2019</span>         
        </p>             

    </div>                
</div>                           

@endsection