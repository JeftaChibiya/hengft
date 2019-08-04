<?php

namespace App\Mail;

use App\User;
use Carbon\Carbon;
use App\LocalStripePlan;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/** 
 *  A new customer + + payment intent + subscription started, charge made successfully
 *  02.08.2019
 */
class SubscriptionStarted extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $user;


    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
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
        
        // get card object esp last 4 digits
        $card = $this->user->defaultCard()->last4;

        // get plan for the subscription
        $currentPlan = LocalStripePlan::where('plan_id', '=', $this->user->subscription('main')->stripe_plan)
                                      ->get();        
        // trial end date
        $freeTrialEnds = $currentSubscription->trial_ends_at->format('F jS, Y'); 

        return $this->from('message@hengft.com', 'HengFT Tips')
                    ->subject('Welcome to HengFT, ' . ucfirst($this->user->name))
                    ->markdown('email.subscription.started')
                    ->with([
                        'card' => $card,                        
                        'freeTrialEnds' => $freeTrialEnds,
                        'currentPlan' => $currentPlan,
        ]);

    }
}
