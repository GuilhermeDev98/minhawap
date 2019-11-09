<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'reference', 'value', 'status', 'description', 'due_date', 'comunity_id', 'payments_details'
    ];

    public function comunity(){
        return $this->belongsTo('App\Comunity');
    }
}
