<?php

namespace App\Mail;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class PaymentMethodUpdated extends Mailable
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
                    ->subject('HengFT: Your payment method has been updated')
                    ->markdown('email.payment.method_updated');
    }
}
