<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Console\Command;


/**
 *  04.08.2019
 *  JC
 *  Delete user or subscriber and correspondiing subscription containing 'ends_at' date on scheduled cancellation date
 * 
 */
class DeleteCancelledSubscriber extends Command
{
    
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:cancelled-subscriber';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user and subscription containing ends_at on scheduled date';


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
        
        $users = DB::table('users')->join('subscriptions', function ($join) {
        
                $join->on('users.id', '=', 'subscriptions.user_id')               
                     ->whereDate('subscriptions.ends_at', Carbon::now());        

        })->delete();        
        
    }
}
