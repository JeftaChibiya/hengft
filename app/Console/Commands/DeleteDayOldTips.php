<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


/** 
 *  04.08.2019
 *  JC
 *  Trim out tips yesterday's tips & inplay tips
 */
class DeleteDayOldTips extends Command
{
 
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tips:delete-old-tips';

 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete any tips older than today';

 
 
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
        $yesterday = Carbon::yesterday();        
        
        $this->info('Tips published ' . $yesterday . ' now deleted');

        // remove pre-match tips older than today
        DB::table('tips')->where('created_at', '<', Carbon::today())->delete();

        // remove inplay tips older than today
        DB::table('inplaytips')->where('created_at', '<', Carbon::today())->delete();        
    }

}