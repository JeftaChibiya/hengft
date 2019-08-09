<?php

namespace App\Http\Controllers;


use DB;
use Auth;
use App\User;
use App\Tip;
use Stripe\Stripe;
use App\Inplaytip;
use Carbon\Carbon;
use App\LocalStripePlan;
use Illuminate\Http\Request;
use Stripe\Invoice as StripeInvoice;


class SettingsAPIController extends Controller
{             


    /**
     * 
     *  A data payload for user settings
     * 
     */
    public function settingsPayload()
    {   
        // logged in user
        $user = auth()->user();

        // current subscription
        $currentSubscribtion = $user->subscription('main');

        // current subscription plan
        $currentPlan = LocalStripePlan::where('plan_id', '=', $currentSubscribtion->stripe_plan)->get();              

        // end of ACTIVE / paid-for subscription
        $item = Carbon::createFromTimeStamp($currentSubscribtion->asStripeSubscription()->current_period_end);  
         
        // date of next charge
        $nextChargeDate = $item->format('F jS, Y');

        // the difference between today and the next charge date
        $periodEnd = Carbon::parse($date);
        $now = Carbon::now();        
        $timeLeft  = $periodEnd->diffInDays($now);                

        $all_plans = LocalStripePlan::all();        

        return [
                'user' =>  $user, 
                'plans' => $all_plans,                 
                'timeLeft' => $timeLeft,
                'currentPlan' => $currentPlan,
                'nextChargeDate' => $nextChargeDate,
                'currentSubscribtion' => $currentSubscribtion
        ];

    }

    /**
     * 
     *  User invoices
     * 
     */
    public function invoices()
    {
        $user = auth()->user();

        // upcoming 
        $upcomingInvoice = StripeInvoice::upcoming(['customer' => $user->stripe_id], ['api_key' => config('services.stripe.secret')]); 

        if($user->hasStripeId()) {
            
            // paid invoices...            
            $paidInvoices = $user->invoices()->map(function($invoice) {
                return [
                    'id' => $invoice->id,
                    'date' => $invoice->date()->toFormattedDateString(),
                    'total' => $invoice->total,
                    'status' => $invoice->status,
                    'download' => '/user/download/invoice/' . $invoice->id,
                ];
            });
        } else {         
            $paidInvoices = [];
        }        

        return ['paidInvoices' => $paidInvoices, 'upcomingInvoice' => $upcomingInvoice];

    }    
}