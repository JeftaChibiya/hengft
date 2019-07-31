<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/***  30.07.2019  ***/

class LocalStripePlan extends Model
{
    protected $fillable = ['plan_id', 'nickname', 'amount', 'trial_period_days'];    
}
