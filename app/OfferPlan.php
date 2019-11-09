<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OfferPlan extends Pivot
{
    protected $fillable = [
        'offer_id', 'plan_id'
    ];

    protected $table = 'offer_plans';
}
