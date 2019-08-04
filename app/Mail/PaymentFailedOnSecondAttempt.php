<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentFailedOnSecondAttempt extends Mailable
{
    use Queueable, SerializesModels;

    
    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $user;

    public $nextPaymentAttemptDate;    


    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct(User $user, $nextPaymentAttemptDate)
    {
        
        $this->user = $user;
        // date of next attempt to collect payment
        $this->nextPaymentAttemptDate = $nextPaymentAttemptDate;        

    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $date = $this->nextPaymentAttemptDate->format('F jS, Y');        

        // get current subscription
        $currentSubscription = $this->user->subscription('main');

        // get plan for the user's subscription
        $currentPlan = LocalStripePlan::where('plan_id', '=', $currentSubscription->stripe_plan)->get();

        return $this->from('message@hengft.com', 'HengFT Tips')
                    ->subject('HengFT: Second attempt to make ' . $currentPlan[0]['nickname'] . ' charge failed')        
                    ->markdown('email.payment.failed-second-attempt')
                    ->with([
                        'date' => $date
                    ]);                    
    }
}
