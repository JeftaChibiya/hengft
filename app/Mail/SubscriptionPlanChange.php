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
class SubscriptionPlanChange extends Mailable
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
        return $this->markdown('email.subscription.change');
    }
}
