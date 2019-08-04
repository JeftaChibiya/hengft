<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class PaymentSucceeded extends Mailable
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


        return $this->from('message@hengft.com', 'HengFT Tips')
                    ->subject('HengFT: Problem solved')
                    ->markdown('email.payment.succeeded')
                    ->with([
                        'currentPlan' => $currentPlan                        
                    ]);       
    }
}
