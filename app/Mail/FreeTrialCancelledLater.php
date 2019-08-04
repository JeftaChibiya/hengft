<?php

namespace App\Mail;

use App\User;
use Carbon\Carbon;
use App\LocalStripePlan;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class FreeTrialCancelledLater extends Mailable
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
        
        // trial end date
        $freeTrialEnds = $currentSubscription->trial_ends_at;  
        $freeTrialEndsDateAsString = $trialEnds->format('F jS, Y');

        $now = Carbon::now();        
        $timeLeftOnTrial  = $trialEnds->diffInDays($now); 

        return $this->from('message@hengft.com', 'HengFT Tips')
                    ->subject('HengFT: Your free trial will be cancelled on ' . $freeTrialEnds)
                    ->markdown('email.subscription.trial_cancelled_later');
    }
}
