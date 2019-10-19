<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'text', 'comunity_id', 'user_id'
    ];

    public function comunity(){
        return $this->belongsTo('App\Comunity');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
