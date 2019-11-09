<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Plan;
use App\Offer;

class PlanController extends Controller
{
    public function index(){
        $plans = Plan::paginate(20);
        return view('admin.plan.index')->with('plans', $plans);
    }

    public function show(Plan $plan){
        return view('admin.plan.show')->with('plan', $plan);
    }

    public function create(){
        return view('admin.plan.create');
    }

    public function store(Request $request){
        $plan = plan::create($request->except('_token'));
        return redirect()->route('admin.plan.index');
    }

    public function edit(Plan $plan){
        return view('admin.plan.edit')->with('plan', $plan);
    }

    public function update(Plan $plan, Request $request){
        $plan->update($request->except('_token'));
        return redirect()->route('admin.plan.index');
    }

    public function destroy(Plan $plan){
        $plan->delete();
        return redirect()->route('admin.plan.index');
    }

    public function addOffer(Plan $plan){
        $offers = Offer::all();
        return view('admin.plan.offer.create')->with([
            'offers' => $offers,
            'plan' => $plan
        ]);
    }

    public function attachOffer(Plan $plan, Request $request){
        $plan->offers()->attach($request->offers);
        return redirect()->route('admin.plan.show', $plan->id);
    }

    public function detachOffer(Plan $plan, Offer $offer){
        $plan->offers()->detach($offer->id);
        return redirect()->route('admin.plan.show', $plan->id);
    }
}
