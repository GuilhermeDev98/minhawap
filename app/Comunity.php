<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunity extends Model
{
    protected $fillable = [
        'name', 'link', 'active', 'status', 'user_id', 'disk_space', 'sms'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }
}
