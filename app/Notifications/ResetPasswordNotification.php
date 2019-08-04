<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

// an email notification for password resetting
class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        
        $this->token = $token;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('info@hengft.com')
            ->subject('HengFT Password Reset')        
            ->greeting('Want to reset your password?')
            ->line('Hey ' . ucfirst($notifiable->name) . ',')      
            ->line('Click the link below to proceed')                  
            ->action('Reset Password', url(route('password.reset', [$this->token, $notifiable->email], false)))
            ->line('If you did not intend to reset your password, no further action is required.');
    }

}