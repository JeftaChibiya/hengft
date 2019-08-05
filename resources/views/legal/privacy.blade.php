@extends('layouts.app')

@section('title', 'Terms of Service')

@section('content')

@section('page_intro')
    <div style="background-color: rgb(46, 58, 77)">
        @include('partials.navbar_white')
    </div>
    <div class="py-10 sm:my-8 flex flex-col items-center">              
        <p class="text-center text-2xl sm:text-5xl font-sans font-medium mb-2 text-gray-700">
            Privacy Statement
        </p>
    </div>    
@stop


<div class="container mx-auto px-5 sm:px-24">
<div class="w-full text-md sm:text-lg leading-normal">
    <!-- overview statement -->
    <p class="text-xl font-bold text-gray-700 mb-5">1. Overview</p>
    <p class="font-light text-gray-700 mb-5">                
        This privacy Statement tells you how we manage your privacy on the HengFT website, <span class="underline">www.hengft.com</span>. 
        The HengFT website adheres to the Principles of the Data Protection Act and General Data Protection Regulation (GDPR).        
    </p>  

    <!-- what information we collect -->
    <p class="text-xl font-bold text-gray-700 mb-1">2. What information do we collect?</p>                            
    <p class="sm:text-md font-light text-gray-700 mb-3">        
        2.1 When new members sign up to the HengFT website we collect:                             
    </p>   
    <ul class="list-disc font-light text-gray-700 mb-4 pl-6 sm:pl-10">        
        <li>Full name or custom username</li>
        <li>Email address</li>
        <li>Custom Password</li>
        <li>Bank card number, expiry date & CVC number</li>                            
    </ul>
    <p class="sm:text-md font-light text-gray-700 mb-3">        
        2.2 When members fill in the contact form on the HengFT website we collect:                             
    </p>    
    <ul class="list-disc font-light text-gray-700 mb-6 pl-6 sm:pl-10">        
        <li>Full name or custom username</li>
        <li>Email address</li>
        <li>Any information about your  needs</li>                             
    </ul>    

    <!-- How we use the info.. -->
    <p class="text-xl font-bold text-gray-700 mb-1">3. How do we use your information?</p>                         
    <p class="sm:text-md font-light text-gray-700 mb-5">        
        3.1 Your information as a member enables us to provide personalised service to you                             
    </p>   
    <p class="sm:text-md font-light text-gray-700 mb-5">        
        3.2 To access your payments for our services, which support the running and improving of our services.                            
    </p>    
    <p class="sm:text-md font-light text-gray-700 mb-5">        
        3.3 To enable contact with you as a HengFT member                             
    </p>   
    <p class="sm:text-md font-light text-gray-700 mb-6">        
        3.4 Your information is not used for any other purpose besides what is disclosed                              
    </p> 
    
    <!-- How long do we hold information for? -->
    <p class="text-xl font-bold text-gray-700 mb-1">4. How long do we hold your information for?</p>
    <p class="sm:text-md font-light text-gray-700 mb-3">        
        4.1 We will hold the information for as long as we are providing you service, and for as long as you remain a HengFT member                              
    </p> 
    <p class="sm:text-md font-light text-gray-700 mb-6">        
        4.2 We will remove all of the information we hold about you should you ask for this or cancel your account
    </p> 
    
    <!-- Data Accuracy -->
    <p class="text-xl font-bold text-gray-700 mb-1">5. Data Accuracy</p>
    <p class="sm:text-md font-light text-gray-700 mb-6">        
        5.1 Personal data will be accurate and kept up to date. Any error will be corrected as soon as possible after the we become aware of it.        
    </p>      
    
    <!-- Do we share info -->
    <p class="text-xl font-bold text-gray-700 mb-1">6. Do we share your information with other organisations?</p>                         
    <p class="sm:text-md font-light text-gray-700 mb-3">        
        6.1 We do not share data with other organisations. 
        The HengFT website is strictly an internal administrative service.                             
    </p>   
    <p class="sm:text-md font-light text-gray-700 mb-6">        
        6.2 Your data is kept under secure conditions hosted on the DigitalOcean platform, a cloud-based website-hosting platform which provides 
        website and data hosting service across its servers located within the USA, and the European Economic Area (EEA)                             
    </p> 
    
    <!-- Your Rights -->
    <p class="text-xl font-bold text-gray-700 mb-1">7. Your Rights</p>                         
    <p class="sm:text-md font-light text-gray-700 mb-3">        
        7.1 By creating an account on the HengFT website, or taking any action that involves providing personal data, 
        you consent to this Privacy Policy; the storage of data on servers; the collection, processing, transfer, 
        and storage of your personal data by HengFT as needed to process your requested action. 
        What data is collected will vary depending on the nature of your interaction with the website                           
    </p>   
    <p class="sm:text-md font-light text-gray-700 mb-3">        
        7.2 If you fail to provide the required personal data to create an account, or any other action involving personal data,
        we will be unable to fulfill your request.                           
    </p> 
    <p class="sm:text-md font-light text-gray-700 mb-3">        
        7.3 If it ever proves necessary to make any changes to our Privacy and Cookies Policy, 
        we will post those changes on this page so that you are always aware of what information we collect and how we use it.                          
    </p> 
    <p class="sm:text-md font-light text-gray-700 mb-6">        
        7.4 To the extent required by law, you may have additional rights (such as those stated under the General Data Protection Regulation) in relation to your personal data. 
        This could include the right to access, correct or delete the personal data you have provided to us through this website. 
        You can request to see the personal information we store and also request its deletion at any time by contacting <span class="undeline">admin@hengft.com</span>                              
    </p>             

    <!-- Unlawful processing and/or accidental loss of information -->
    <p class="text-xl font-bold text-gray-700 mb-1">8. Unlawful processing and/or accidental loss of information</p>
    <p class="sm:text-md font-light text-gray-700 mb-6">        
        8.1 None of the data relating to HengFT members will leave the EEA.                              
    </p>
    
    <!-- Enqueries -->
    <p class="text-xl font-bold text-gray-700 mb-1">9. Enqueries</p>
    <p class="sm:text-md font-light text-gray-700 mb-6">        
        9.1 All enquiries relating to your personal data should be directed to the HengFT administration at 
        <span class="underline">admin@hengft.com</span>                              
    </p>    
    
    <!-- Cookie Policy -->
    <p class="text-xl font-bold text-gray-700 mb-1">10. Cookie Policy</p>                             
    <p class="font-light text-gray-700 mb-3">        
        10.1 Cookies are small information files placed on your device, which are used to improve services for you by, for example:                            
    </p> 
    <p class="font-light text-gray-700 mb-3">        
        10.2 Enabling the website to recognise the device being used
        in order to resize website content to fit the size of the screen of the device                           
    </p>
    <p class="font-light text-gray-700 mb-3">        
        10.3 Recognising when you have already provided an email address and password, so that you
        do not need to provide the same details for every page you visit on <span class="underline">hengft.com</span>                          
    </p> 
    <p class="font-light text-gray-700 mb-3">        
        10.4 Cookies cannot be used to identify you personally                          
    </p>
    <p class="font-light text-gray-700 mb-3">        
        10.5 All Cookies are encrypted and
        signed so that they can't be modified or read after being a human after being created                          
    </p>                                                                                                                         
</div>
 <p class="font-medium text-xl text-gray-700 mt-6 text-center">[End of Document]</p>
</div>
<!-- Take our daily poll -->
<!-- Who will win -->

@endsection