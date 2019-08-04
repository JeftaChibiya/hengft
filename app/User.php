<?php

namespace App;

/** custom, 31.07.2019 */
use App\Notifications\ConfirmEmail;
use App\Notifications\ResetPasswordNotification;

/** Laravel */
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    
    use Notifiable, Billable;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /** A custom verify-email notification  */

    public function sendEmailVerificationNotification()
    {   
        
        $this->notify(new ConfirmEmail);              
                                     
     }  
     
     
     
    /**
     *  Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        
        $this->notify(new ResetPasswordNotification($token));

    } 

}
