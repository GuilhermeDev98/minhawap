<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name', 'name_descriptive', 'value', 'sold', 'type'
    ];

    public function offers(){
        return $this->belongsToMany('App\Offer', 'offer_plans');
    }
}
