<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Offer;
use App\Plan;
use App\Support\Services\SmsService;
use App\User;
use Carbon\CarbonImmutable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Comunity;
use Illuminate\Support\Str;

class ComunityController extends Controller
{
    public function index(){
        $comunities = Comunity::paginate('20');
        return view('admin.comunity.index')->with([
            'comunities' => $comunities,
        ]);
    }

    public function create(){
        $users = User::all();
        $plans = Plan::all();
        return view('admin.comunity.create')->with([
            'users' => $users,
            'plans' => $plans
        ]);
    }

    public function store(Request $request){
        $request['status'] = 'WA';
        $comunity = Comunity::create($request->except('_token'));
        $comunity->plan()->associate($request->plan_id);
        return view('admin.comunity.show')->with('comunity', $comunity);
    }

    public function edit(Comunity $comunity){
        $users = User::all();
        $plans = Plan::all();
        return view('admin.comunity.edit')->with([
            'users' => $users,
            'plans' => $plans,
            'comunity' => $comunity
        ]);
    }

    public function update(Comunity $comunity, Request $request){
        $comunity->update($request->except('_token'));
        return redirect()->route('admin.comunity.show', $comunity->id);
    }

    public function show(Comunity $comunity){
        return view('admin.comunity.show')->with('comunity', $comunity);
    }

    public function aprove(Comunity $comunity){
        if($comunity->plan->type == 'free'){
            $message = 'Ola '.explode(' ', $comunity->user->name)[0].' sua solicitacao de ativação da comunidade '.$comunity->name.' foi aprovada, para mais informacoes, verifique o email enviado ! Atenciosamente, MinhaWap.tk !';
            SmsService::sendMessage($comunity->user->cel, $message);
            $comunity->update([
                'active' => false,
                'status' => 'RD'
            ]);
            return redirect()->route('admin.comunity.show', $comunity->id)->with('status', 'Comunidade Aprovada Com Sucesso !');
        }else {

            try{

                $invoice = $this->generateFirstInvoice($comunity);

                $this->generateInvoiceInJuno($invoice);

                $comunity->update([
                    'active' => false,
                    'status' => 'WA'
                ]);
                $message = 'Ola '.explode(' ', $comunity->user->name)[0].' sua solicitacao de ativação da comunidade '.$comunity->name.' foi aprovada, para mais informacoes, verifique o email enviado ! Atenciosamente, MinhaWap.tk !';
                SmsService::sendMessage($comunity->user->cel, $message);
                return redirect()->route('admin.comunity.show', $comunity->id)->with('status', 'Comunidade Aprovada Com Sucesso !');

            }catch (\Exception $e){

                if ($e instanceof ClientException) {
                    $invoice->delete();
                    $message = 'Erro ao gerar boleto !';
                }elseif ($e instanceof \QueryException or $e instanceof \PDOException){
                    $message = 'Erro no banco de dados !';
                }else{
                    $message = 'Erro desconhecido !';
                }

                return redirect()->route('admin.comunity.show', $comunity->id)->with('error', $message);
            }
        }
    }

    public function reprove(Comunity $comunity){
        try {
            $comunity->update([
                'status' => 'AF'
            ]);
            $message = 'Ola ' . explode(' ', $comunity->user->name)[0] . ' sua solicitacao de ativacao de comunidade foi reprovada, Em breve entraremos em contato para passar mais informacoes !';
            SmsService::sendMessage($comunity->user->cel, $message);
            return redirect()->route('admin.comunity.index')->with('status', 'Comunidade Reprovada Com Sucesso !');
        }catch (\Exception $e){
            report($e);
            return redirect()->route('admin.comunity.index')->with('error', 'Tente Novamente Mais Tarde !');
        }
    }
    public function cancel(Comunity $comunity){
        $comunity->update([
            'active' => false,
            'status' => 'CC'
        ]);

        return redirect()->route('admin.comunity.index');
    }
    public function restore(Comunity $comunity){
        $comunity->update([
            'active' => true,
            'status' => 'OA'
        ]);

        return redirect()->route('admin.comunity.index');
    }
    public function addOffer(Comunity $comunity){
        $offers = Offer::all();
        return view('admin.comunity.offer.create')->with([
           'offers' => $offers,
           'comunity' => $comunity
        ]);
    }
    public function attachOffer(Comunity $comunity, Request $request){
        $comunity->offers()->attach($request->offers);
        return redirect()->route('comunity.show', $comunity->id);
    }
    public function detachOffer(Comunity $comunity, Offer $offer){
        $comunity->offers()->detach($offer->id);
        return redirect()->route('comunity.show', $comunity->id);
    }

    public function generateFirstInvoice(Comunity $comunity){
        try {

            $today = CarbonImmutable::createFromTimeString('00:00:00', 'America/Sao_Paulo');
            $billingDay = CarbonImmutable::create($today->year, $today->month, $comunity->due_date, 0, 0, 0, 'America/Sao_Paulo');

            if ($today == $billingDay) {
                $totalDays = $today->diffInDays($billingDay->addMonth());
            } else {
                if ($billingDay->isPast()) {
                    $totalDays = $today->diffInDays($billingDay->addMonth());
                }
                if ($billingDay->isFuture()) {
                    $totalDays = $today->diffInDays($billingDay);
                }
            }

            $daysInCurrentMonth = $billingDay->daysInMonth;

            $planPrice = $comunity->plan->value;
            $valueDaily = money_format('%n', ($planPrice / $daysInCurrentMonth));
            $proportionalValue = money_format('%n', $totalDays * $valueDaily);
            $daysOrDay = ($totalDays == 1) ? 'Dia' : 'Dias';

            return Invoice::create([
                'reference' => (string) Str::uuid(),
                'value' => $proportionalValue + 2.30,
                'status' => 'AWAITING_PAYMENT',
                'description' => 'Período Faturado : ' . $today->format('d/m/Y') . ' até ' . $billingDay->format('d/m/Y') . ' Data de Vencimento ' . $today->addDays(3)->format('d/m/Y') . ' Taxa de Ativação R$ 2,30 + valor Propocional de ' . $totalDays . ' ' . $daysOrDay . ' do ' . $comunity->plan->name_descriptive . ' R$' . $comunity->plan->value,
                'due_date' => $today->addDays(3),
                'comunity_id' => $comunity->id
            ]);

        }catch (\Exception $e){
            report($e);
        }
    }

    public function generateInvoiceInJuno(Invoice $invoice){
        try{

            $client = new Client([
                'base_uri' => 'https://sandbox.boletobancario.com/boletofacil/'
            ]);

            $request = $client->request('post', 'integration/api/v1/issue-charge', [
                'form_params' => [
                    'token' => env('JUNO_TOKEN'),
                    'description' => (string) $invoice->description,
                    'reference' => (string) $invoice->reference,
                    'amount' => $invoice->value,
                    'payerName' => $invoice->comunity->user->name,
                    'payerCpfCnpj' => $invoice->comunity->user->cpf,
                    'payerEmail' => $invoice->comunity->user->email,
                ]
            ]);

            $invoice->update(['payments_details' => (string) $request->getBody()]);

        }catch (Exception $e) {
            report($e);
//            $response = $e->getResponse();
//            $message = json_decode($response->getBody()->getContents(), true);
        }

    }
}
