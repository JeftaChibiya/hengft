<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

/*** Mail classes ***/ 

use App\Mail\PaymentMethodUpdate;



/*** 30.07.2019 ***/ 
class WebhookController extends Controller
{


    
    
    /*** Handle invoice payment method updated ***/
    /*** Stripe event type: payment_method.updated ***/    

    public function handlePaymentMethodUpdated(Request $request,$payload)
    {
        
        $payload = request()->all();       

        if($payload['type'] == 'payment_method.updated'){

            $user = User::where('stripe_id', $payload['data']['object']['customer']); 

            Mail::to($request->user())->send(new PaymentMethodUpdate($user));                        

            // call payment succeed              
            return 'This is ' . $payload['type'];              
            
        }                 

    }     

            // ....
        //     dispatch(function () {

        //         // Db notification
        //         $user->notify(new PaymentMethodUpdated($user));     
                          
    
        //     })->delay(Carbon::now()->addMinutes(3));      
}
