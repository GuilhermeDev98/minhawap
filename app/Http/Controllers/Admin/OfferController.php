<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Offer;

class OfferController extends Controller
{
    public function index(){
        $offers = Offer::paginate(20);
        return view('admin.offer.index')->with('offers', $offers);
    }

    public function create(){
        return view('admin.offer.create');
    }

    public function store(Request $request){
        $offer = Offer::create($request->except('_token'));
        return redirect()->route('admin.offer.index');
    }

    public function edit(Offer $offer){
        return view('admin.offer.edit')->with('offer', $offer);
    }

    public function update(Offer $offer, Request $request){
        $offer->update($request->except('_token'));
        return redirect()->route('admin.offer.index');
    }

    public function destroy(Offer $offer){
        $offer->delete();
        return redirect()->route('admin.offer.index');
    }
}
