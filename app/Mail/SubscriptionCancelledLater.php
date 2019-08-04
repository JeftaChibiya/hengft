<?php

namespace App\Mail;

use App\User;
use Carbon\Carbon;
use App\LocalStripePlan;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class SubscriptionCancelledLater extends Mailable
{
    use Queueable, SerializesModels;


    public $user;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        
        $this->user = $user;

    }
        

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // get current subscription
        $currentSubscription = $this->user->subscription('main');       

        // get plan for the user's subscription
        $currentPlan = LocalStripePlan::where('plan_id', '=', $currentSubscription->stripe_plan)->get();

        // subscription as recorded on stripe
        $subscriptionOnStripe = $currentSubscription->asStripeSubscription();          
        
        $date = Carbon::createFromTimeStamp($subscriptionOnStripe->current_period_end);        
        
        $nextChargeDate = $date->format('F jS, Y'); 

        $periodEnd = Carbon::parse($date);
        $now = Carbon::now();        
        $timeLeft  = $periodEnd->diffInDays($now); 

        return $this->from('message@hengft.com', 'HengFT Tips')
                    ->subject('Your HengFT account will be cancelled on ' . $nextChargeDate)    
                    ->markdown('email.subscription.cancelled_later')
                    ->with([
                        'timeLeft' => $timeLeft,
                        'currentPlan' => $currentPlan,
                        'nextChargeDate' => $nextChargeDate    
        ]); 

    }
}
