<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class SubscriptionDeleted extends Mailable
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
        return $this->from('message@hengft.com', 'HengFT Tips')
                    ->subject('Your HengFT account has been deleted')
                    ->markdown('email.subscription.deleted');
    }
}
