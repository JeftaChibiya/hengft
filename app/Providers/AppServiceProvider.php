<?php

namespace App\Providers;

use Laravel\Cashier\Cashier;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // share local_stripe_plans
        \View::composer(['auth.register', 'user.show'], function ($view) {
            $view->with('plans', \App\LocalStripePlan::all());           
        });

        Cashier::useCurrency('gbp', '£');

    }
}
