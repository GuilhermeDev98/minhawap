<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Invoice;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class InvoiceController extends Controller
{
    public function index(){
        $invoices = Invoice::paginate(20);
        return view('admin.invoice.index')->with('invoices', $invoices);
    }

    public function show(Request $request){
        try{
            $invoice = Invoice::findOrFail($request->invoice);

            return view('.admin.invoice.show')->with('invoice', $invoice);
        }catch (\Exception $e){
            report($e);
            return redirect()->route('admin.invoice.index')->with('error', 'Boleto não encontrado!');
        }
    }

    public function cancel(Invoice $invoice){

        if ($this->cancelInvoiceInJuno($invoice)){

            try{
                $invoice->update(['status' => 'CANCELED']);
                return redirect()->route('admin.invoice.index')->with('status', 'Cobrança cancelada com suceesso !');
            }catch (\Exception $e){
                report($e);
                return redirect()->route('admin.invoice.index')->with('error', 'Erro ao atualizar cobrança no banco de dados !');
            }

        }

        return redirect()->route('admin.invoice.index')->with('error', 'Erro ao cancelar cobrança!');
    }

    public function cancelInvoiceInJuno(Invoice $invoice){
        try{

            $client = new Client([
                'base_uri' => 'https://sandbox.boletobancario.com/boletofacil/integration/api/v1/'
            ]);

            $client->request('post', 'cancel-charge', [
                'form_params' => [
                    'token' => env('JUNO_TOKEN'),
                    'code' => json_decode($invoice->payments_details, true)['data']['charges'][0]['code'],
                ]
            ]);

            return true;
        }catch (\Exception $e){
            report($e);
            return false;
        }
    }

}
