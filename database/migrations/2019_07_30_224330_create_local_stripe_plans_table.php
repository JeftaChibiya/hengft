<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalStripePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_stripe_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plan_id');              
            $table->string('nickname'); 
            $table->string('trial_period_days');              
            $table->float('amount');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_stripe_plans');
    }
}
