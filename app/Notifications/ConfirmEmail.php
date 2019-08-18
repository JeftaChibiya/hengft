<?php

namespace App\Notifications;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/** Base template for confirm-email */

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;


/** 
 *  
 *  Email Notification
 *  First email notification to go out to the user after signing up to remind user to verify email address
 *  JC, 11/07/2019
 * 
 */
class ConfirmEmail extends VerifyEmailBase
{
    use Queueable;

    
    
    /**
     *  Delivered by email only 
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }


    /**
     *  Get the mail representation of the notification.
     *  This is custom notification of Laravel VerifyEmail Notification
     *  Sun 30.June.2019
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->from('accounts@hengft.com', 'HengFT Tips')       
            ->subject(Lang::getFromJson('Confirm your HengFT email address'))
            ->line('Thanks for signing up')
            ->line('We just need your to verify your email address.' )            
            ->line(Lang::getFromJson('Please click the button below to activate your HengFT account'))
            ->action(
                Lang::getFromJson('ACTIVATE ACCOUNT'),
                $this->verificationUrl($notifiable)
            )
            ->line(Lang::getFromJson('If you did not create an account, no further action is required.'));

    }
}
