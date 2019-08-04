<?php

namespace App\Mail;

use App\User;
use Carbon\Carbon;
use App\LocalStripePlan;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/***  30.07.2019 ***/
class SubscriptionPlanChanged extends Mailable
{

    use Queueable, SerializesModels;


    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $user;

    public $previousPlan;


    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct(User $user, $previousPlan)
    {
        
        $this->user = $user;
        $this->previousPlan = $previousPlan;

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
        
        // real version of subscription on stripe.com
        $subscriptionOnStripe = $currentSubscription->asStripeSubscription();

        // get subscription end date
        $date = Carbon::createFromTimeStamp($subscriptionOnStripe->current_period_end);   
         
        $nextChargeDate = $date->format('F jS, Y'); 
        
        
        return $this->from('message@hengft.com', 'HengFT Tips')
                    ->subject('Your HengFT subscription has been updated')
                    ->markdown('email.subscription.change')
                    ->with([
                        'previousPlan' => $this->previousPlan,
                        'currentPlan' => $currentPlan,
                        'nextChargeDate' => $nextChargeDate,                                                           
        ]); 

    }
}
