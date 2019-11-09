<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'name', 'description', 'value', 'discount', 'percent', 'activation_date', 'expiration_date'
    ];
}
