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
  
    //
    public function tips()
    {   

        $todaysTips = DB::table('tips')->whereDate('created_at', Carbon::today())->get();

        return ['todaysTips' => $todaysTips];

    }


    // 
    public function inplayTips()
    {   
        $inplaytips = Inplaytip::whereDate('created_at', Carbon::today())->get();

        return ['inplaytips' => $inplaytips];

    }    


    //
    public function SubscriptionLog()
    {   
        $user = auth()->user();

        $nots = $user->notifications;

        $currentSubscribtion = $user->subscription('main');

        $currentPlan = LocalStripePlan::where('plan_id', '=', $currentSubscribtion->stripe_plan)->get();

        $stripeSubSync = $currentSubscribtion->asStripeSubscription();                

        $date = Carbon::createFromTimeStamp($stripeSubSync->current_period_end); // subscription has started  
         
        $nextChargeDate = $date->format('F jS, Y');

        // calculate difference between the 2 dates with Carbon
        $periodEnd = Carbon::parse($date);
        $now = Carbon::now();        
        $timeLeft  = $periodEnd->diffInDays($now);                

        return [
                'nots' => $nots,
                'user' =>  $user, 
                'timeLeft' => $timeLeft,
                'plans' => LocalStripePlan::all(), 
                'currentPlan' => $currentPlan,
                'nextChargeDate' => $nextChargeDate
        ];

    }


    public function user()
    { 
        
        return ['user' => Auth::user()];

    }    


    // invoices
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