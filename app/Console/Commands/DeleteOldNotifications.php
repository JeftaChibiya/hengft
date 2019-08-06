<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Console\Command;


/** 
 *  06.08.2019
 *  JC
 *  Trim out notifications older than 7 days
 */
class DeleteOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trim out notifications older than 7 days';

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
        
        // remove pre-match tips older than today
        DB::table('notifications')->where('created_at', '<', Carbon::today()->subDays(7))->delete();
        
    }
}
