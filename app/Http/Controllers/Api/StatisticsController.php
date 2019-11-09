<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Statistics;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index(){
        $collection = collect(Statistics::all()->toArray());

        $value = $collection->groupBy('created_at')->toArray();

        dd($value);
//        return $stats->toJson();
    }
}
