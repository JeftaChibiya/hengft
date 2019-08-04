<?php

namespace App\Mail;

use App\User; 

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/** 
 *  
 *  04.08.2019
 *  JC
 * 
 */
class AccountAboutToBeDeleted extends Mailable
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
        $endByDate = $this->user->subscriptions[0]['ends_at'];

        return $this->subject('HengFT: A quick reminder')
                    ->markdown('email.account.deletion_notice')
                    ->with([
                        'endByDate' => $endByDate
                    ]);
    }
}
