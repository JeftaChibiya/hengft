<?php

namespace App\Jobs;

use App\User;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 *  Sun 04.08.2019
 *  Send new subscriber a welcoming email
 *  JC
 */
class WelcomeSubscriber implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        Mail::to($this->user)->send(new SubscriptionStarted($this->user));        

    }
}
