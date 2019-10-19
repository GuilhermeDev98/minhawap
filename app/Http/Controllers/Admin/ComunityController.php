<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comunity;

class ComunityController extends Controller
{
    public function index(){
        $comunities = Comunity::paginate('20');
        return view('admin.comunity.index')->with('comunities', $comunities);
    }

    public function show(Comunity $comunity){
        return view('comunity.show')->with('comunity', $comunity);
    }
}
