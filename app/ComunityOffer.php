<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\Pivot;


class ComunityOffer extends Pivot
{
    protected $fillable = [
        'comunity_id', 'offer_id'
    ];

    protected $table = 'comunity_offers';
}
