<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

/*** Custom mail classes ***/ 
use App\Mail\SubscriptionStarted;
use App\Mail\SubscriptionPlanChanged;
use App\Mail\PaymentMethodUpdated;
use App\Mail\FreeTrialCancelledLater;
use App\Mail\SubscriptionCancelledLater;
use App\Mail\SubscriptionDeleted;
use App\Mail\SubscriptionResumed;
use App\Mail\PaymentFailedOnFirstAttempt;
use App\Mail\PaymentFailedOnSecondAttempt;
use App\Mail\PaymentFailedOnThirdAttempt;
use App\Mail\PaymentSucceeded;


/*** 30.07.2019 ***/ 
/*** 6 user invoked events ***/ 
/*** 2 stripe invoked events ***/ 
class WebhookController extends CashierController
{
    
    /*** 
     * 
     *  A new customer and subscription successfully created on free trial
     * 
     *  Stripe event type: 
     *  Tested:
     */
    public function handleCustomerSubscriptionCreated($payload){

        
        $user = User::where('stripe_id', $payload['data']['object']['customer'])->get();

        // send email confirmation as Job, delay: 3 mins
        Mail::to($user[0])->send(new SubscriptionStarted($user[0]));

        return 'New Subscription Created';    

    }        

     

     
    /*** 
     * 
     *  Payment method updated 
     * 
     *  Stripe event type: customer.updated
     * 
     *  event: customer.updated is fired for several actions, has been narrowed down
     *  Tested: 02/08/2019, works
     * 
     */  
    public function handleCustomerUpdated($payload)
    {        

        $user = User::where('stripe_id', $payload['data']['object']['id'])->get(); 

        // total count of payment sources has gone up
        if($payload['data']['object']['sources']['total_count'] > 1){

            // send email confirmation
            Mail::to($user[0])->send(new PaymentMethodUpdated($user[0])); 

        }       

    }   



    /*** 
     * 
     *  1. Subscription has been swapped
     *  2. Subscription requested to be cancelled at end of grade period 
     *  3. Subscription resumed
     * 
     *  Stripe event type: payment_method.updated
     *  Tested: 01/08/2019, works
     */  
    public function handleCustomerSubscriptionUpdated($payload)
    {        

        $user = User::where('stripe_id', $payload['data']['object']['customer'])->get();

        /** name of old / previous plan */ 
        $previousPlan = $payload['data']['object']
                ['previous_attributes']
                ['items']['data']['plan']['nickname'];        

        /** 1. object for event is a customer's subscription */ 
        if($payload['data']['object']['object'] == 'subscription'){
            
            Mail::to($user[0])->send(new SubscriptionPlanChanged($user[0], $previousPlan));

            return 'Subscription Switched';
        }          

        /** 2. timestamp for future cancellation has been set */
        if($payload['data']['object']['cancel_at_period_end'] == true){
            
            // if subscription trialing? 
            Mail::to($user[0])->send(new FreeTrialCancelledLater($user[0]));            

            // if subscription active?            
            Mail::to($user[0])->send(new SubscriptionCancelledLater($user[0]));

            return 'Subscription Cancelled';
        }        

        /** 3. no cancelled_at timestamp + no timestamp for future cancellation */
        else if($payload['data']['object']['canceled_at'] == null && $payload['data']['object']['cancel_at_period_end'] == false){

            Mail::to($user[0])->send(new SubscriptionResumed($user[0]));     
            
            return 'Subscription Resumed';            

        }                                
    }    
    
    

    /**
     *  Handle: Invoice payment failed
     *  Stripe event type: attempt_count, invoice.created, invoice.payment_failed, invoice.payment_action_required
     *  
     *  Tested: 03/08/2019
     * 
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     */
    public function handleInvoicePaymentFailed($payload)
    {        

        // ensure customer does not have access to subscription only content
        $user  = User::where('stripe_id', $payload['data']['object']['customer'])->get();

        $nextPaymentAttemptDate = $payload['data']['object']['next_payment_attempt'];       


        // failed on 1st attempt
        if($payload['data']['object']['attempt_count'] == 1){    
                
            // send email confirmation
            Mail::to($user[0])->send(new PaymentFailedOnFirstAttempt($user[0], $nextPaymentAttemptDate));                
            
        }        
        // failed on 2nd attempt        
        else if($payload['data']['object']['attempt_count'] == 2){    
                
            // send email confirmation
            Mail::to($user[0])->send(new PaymentFailedOnSecondAttempt($user[0], $nextPaymentAttemptDate));                
            
        }         
        // failed on 3rd attempt        
        else if($payload['data']['object']['attempt_count'] == 3){    
                
            // send email confirmation
            Mail::to($user[0])->send(new PaymentFailedOnThirdAttempt($user[0], $nextPaymentAttemptDate));                
            
        }         

        return 'Invoice payment failed';

    }    
    
    
    /**
     *  Handle: Invoice payment Successfull
     *  Stripe event type: attempt_count, invoice.created, invoice.payment_failed, invoice.payment_action_required
     *  
     *  Tested: 03/08/2019
     * 
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     */
    public function handleInvoicePaymentSucceeded($payload)
    {        

        // ensure customer does not have access to subscription only content
        $user  = User::where('stripe_id', $payload['data']['object']['customer']);
                
        // send email confirmation
        Mail::to($user[0])->send(new PaymentSucceeded($user[0])); 

        return 'Invoice payment succeeded!';


    }     


    /*** 
     * 
     *  1. Handle: Customer Subscription Deleted
     *  Stripe event type: customer.subscription.deleted
     *  Tested: 01/08/2019, works
     */  
    public function handleCustomerSubscriptionDeleted($payload)
    {        
        
        $user = User::where('stripe_id', $payload['data']['object']['customer'])->get(); 

        // send email confirmation
        Mail::to($user[0])->send(new SubscriptionDeleted($user[0]));  

        Auth::logout(); // logout

        return redirect()->route('what-now'); // redirect user to farewell page         
            
        $user[0]->subscriptions[0]->delete(); // delete user's subscription
        
        $user[0]->asStripeCustomer()->delete(); // delete customer on stripe's end

        $user[0]->delete(); // delete user in Db        

    }    
    
      
}
