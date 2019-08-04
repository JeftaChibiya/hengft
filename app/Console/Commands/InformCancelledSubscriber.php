<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Mail\AccountAboutToBeDeleted;

use Illuminate\Console\Command;


/** 
 *  04.08.2019
 *  JC
 *  Email user with a subscription that contains an 'ends_at' 3 days before the recorded date
 *  "Your data will be removed by 11:59 pm the end of cancellation date. 
 *  if you wish to continue your subscription..."
 */
class InformCancelledSubscriber extends Command
{
 
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriber:deletion-notification';

 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscription scheduled for cancellation removed by 11:59 on cancellation date';

 
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        /**
         *  get 'users' with active subscriptions 
         *  where today is past free trial_ends_at date
         *  where ends_at date exists and is 3 days from now
         * 
         */ 
        $users = DB::table('users')->join('subscriptions', function ($join) {
        
                $join->on('users.id', '=', 'subscriptions.user_id')
                        ->whereDate('subscriptions.trial_ends_at', '<', Carbon::now())                 
                        ->whereDate('subscriptions.ends_at', Carbon::now()->addDays(3));        

        })->get();                 

        foreach($users as $user){
            // send email to each
            Mail::to($user)->send(new AccountAboutToBeDeleted($user));            

        }                 
                 
    }
}
