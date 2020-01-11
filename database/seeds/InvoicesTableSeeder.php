<?php

use Illuminate\Database\Seeder;
use App\Invoice;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::create([
            'id' => '1',
            'reference' => 'db23c976-92cc-4710-97cc-b855a5f71b53',
            'value' => '25.00',
            'status' => 'CONFIRMED',
            'description' => 'Período Faturado : 05/11/2019 até 10/11/2019 Data de Vencimento 08/11/2019 Taxa de Ativação R$ 2,30 + valor Propocional de 5
Dias do Plano Gold + 2GB de Bônus 12 Meses	 R$25.00',
            'due_date' => '2019-11-10 00:00:00',
            'comunity_id' => 1,
            'payments_details' => '{"data":{"charges":[{"code":40003046,"reference":"db23c976-92cc-4710-97cc-b855a5f71b53","dueDate":"08/11/2019","checkoutUrl":"https://sandbox.boletobancario.com/boletofacil/checkout/66A904D62FAEA3C1A1D98AE79F70C72A66126C4FB9BCC415","link":"https://sandbox.boletobancario.com/boletofacil/charge/boleto.pdf?token=606361:m:522a44deedd355e9a6c5a4d198169555adb1723c73b2bfee18cd2103e849b918","installmentLink":"https://sandbox.boletobancario.com/boletofacil/charge/boleto.pdf?token=40003046:6901165178a369967da99c0bd16c9a2bef5f8ec8a3df58e9403f017ad5cfbbff","payNumber":"BOLETO PAGO","billetDetails":{"bankAccount":"0655/46480-8","ourNumber":"176/40003046-7","barcodeNumber":"34196806700000006451764000304670655464808000","portfolio":"176"},"payments":[{"id":34274,"amount":6.45,"date":"04/11/2019","fee":3.90,"type":"BOLETO","status":"CONFIRMED","creditCardId":null}],"amount":6.45}]},"success":true}'
        ]);
    }
}
