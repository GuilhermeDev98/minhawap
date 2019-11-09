<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancellationRequest extends Model
{
    protected $fillable = [
        'reason', 'note', 'withheld', 'comunity_id'
    ];
}
