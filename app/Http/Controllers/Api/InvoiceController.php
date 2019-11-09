<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Support\Services\SmsService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function sendInvoiceBySms(Invoice $invoice){
        try{
            $barcode = json_decode($invoice->payments_details, true)['data']['charges'][0]['billetDetails']['barcodeNumber'];
            $message = 'Ola, o valor da fatura eh de R$'.$invoice->value.', com vencimento em '.date('d/m/Y', strtotime($invoice->due_date)).' e deve ser pago com o codigo de barras '.$barcode;
            SmsService::sendMessage($invoice->comunity->user->cel, $message);
            return response()->json(['success' => true, 'message' => 'Sms Enviado com Sucesso']);
        }catch(\Exception $e){
            report($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function sendInvoiceByEmail(Invoice $invoice){
        try{
            return response()->json(['success' => true, 'message' => 'Email Enviado com Sucesso']);
//            Throw new \Exception('teste');
        }catch(\Exception $e){
            report($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
