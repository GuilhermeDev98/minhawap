<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunity extends Model
{
    protected $fillable = [
        'name', 'link', 'active', 'status', 'user_id', 'plan_id', 'due_date'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
    }

    public function offers(){
        return $this->belongsToMany('App\Offer', 'comunity_offers');
    }
}
