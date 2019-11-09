<?php

namespace App\Http\Controllers;

use App\CancellationRequest;
use App\Plan;
use Illuminate\Http\Request;
use App\Comunity;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;


class ComunityController extends Controller
{
    public function index(){
        $comunities = Comunity::where('user_id', Auth::user()->id)->paginate(20);
        return view('comunity.index')->with('comunities', $comunities);
    }

    public function create(){
        $plans = Plan::where('sold', true)->get();
        return view('comunity.create')->with([
            'plans' => $plans
        ]);
    }

    public function store(Request $request){

        $request['status'] = 'WA';
        $request['user_id'] = Auth::user()->id;
        $comunity = Comunity::create($request->except('_token'));
        $comunity->plan()->associate($request->plan_id);

        return view('comunity.show')->with('comunity', $comunity);
    }

    public function edit(Comunity $comunity){
        if(Auth::user()->id == $comunity->user_id){
            $plans = Plan::where('sold', true)->get();
            return view('comunity.edit')->with([
                'plans' => $plans,
                'comunity' => $comunity
            ]);
        }
        return abort(403);
    }
    public function update(Comunity $comunity, Request $request){
        if(Auth::user()->id == $comunity->user_id) {
            $comunity->plan_id = $request->plan_id;
            if ($comunity->save()){
                $this->alterPlan($comunity);
                return redirect()->route('comunity.show', $comunity->id)->with('status', 'Plano Editado Com Sucesso !');;
            }
            return redirect()->route('comunity.edit', $comunity->id)->with('error', 'Erro Tente Novamente Mais Tarde !');
        }
        return abort(403);
    }


    public function show(Comunity $comunity){
        return view('comunity.show')->with('comunity', $comunity);
    }

    public function  alterPlan(Comunity $comunity){
        try{
            $comunity->offers()->detach();
            return true;
        }catch (\Exception $e){
            return view('comunity.show')->with([
                'comunity' => $comunity,
                'error' => 'Erro, Tente Novamente Mais Tarde !'
            ]);
        }
    }

    public function cancelForm(Comunity $comunity){
        return view('comunity.cancel')->with('comunity', $comunity);
    }
    public function cancel(Comunity $comunity, Request $request){
        $cancelationRequest = CancellationRequest::create([
            'reason' => $request->reason,
            'note' => $request->note,
            'withheld' => 0,
            'comunity_id' => $comunity->id
        ]);

        if($cancelationRequest){
            return redirect()->route('comunity.index')->with('status', 'Solicitação de Cancelamento Efetuada Com Sucesso !');
        }

        return redirect()->route('comunity.cancel', $comunity->id)->with('errors', ['Erro Desconhecido, Tente Novamente Mais Tarde !']);
    }

}
