<?php

namespace App\Console\Commands;

use Stripe\Plan;
use Stripe\Stripe;
use App\LocalStripePlan;
use Illuminate\Console\Command;

/***  30.07.2019  ***/

class StripeSyncLocalPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:stripe-sync-local-plans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync local billing plans with Stripe';

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
        Stripe::setApiKey(config('services.stripe.secret'));

        // Get plans from Stripe
        $stripePlans = $plans = Plan::all();
 
        // Iterate through the plans while populating our table with the plan data
        foreach ($stripePlans as $stripePlan) {
             LocalStripePlan::create([
                 'plan_id' => $stripePlan->id,
                 'nickname' => $stripePlan->nickname,
                 'amount' => $stripePlan->amount,
                 'trial_period_days' => $stripePlan->trial_period_days,                
             ]);
        }        
    }
}
