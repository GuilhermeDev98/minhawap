<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comunity;

class ComunityController extends Controller
{
    public function show(Comunity $comunity){
        return view('comunity.show')->with('comunity', $comunity);
    }
}
