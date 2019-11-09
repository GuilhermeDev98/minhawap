<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function show(Comunity $comunity){
        return view('comunity.show')->with('comunity', $comunity);
    }
}
