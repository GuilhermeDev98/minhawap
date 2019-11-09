@extends('layouts.app', [
'namePage' => 'Faturas',
'class' => 'sidebar-mini',
'activePage' => 'invoice',
])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-info btn-round text-white pull-right" id="sendInvoiceBySms"><i class="fa fa-sms"></i></a>
                        <a class="btn btn-info btn-round text-white pull-right" id="sendInvoiceByEmail" ><i class="fa  fa-at"></i></a>
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.invoice.index') }}"><i class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">{{ __('Fatura') }} {{$invoice->reference}}</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Comunidade</label>
                                        <input type="text" value="{{$invoice->comunity->name}}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Valor</label>
                                        <input type="text" value="R$ {{$invoice->value}}" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" value="{{$invoice->status}}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Data de Vencimento</label>
                                        <input type="text" value="{{ date('d/m/Y', strtotime($invoice->due_date)) }}" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            @empty(!$invoice->payments_details)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Código de Barras</label>
                                            <input type="text" value="{{json_decode($invoice->payments_details, true)['data']['charges'][0]['payNumber']}}" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            @endempty
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Descrição</label>
                                        <textarea class="form-control" disabled>
                                            {{trim($invoice->description)}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if($invoice->payments_details AND $invoice->status == 'CONFIRMED')
                            <h4 class="card-title">{{ __('Informações do Pagamento') }} - {{json_decode($invoice->payments_details, true)['data']['charges'][0]['payments'][0]['status']}}</h4>
                            <form>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Data do Pagamento</label>
                                            <input type="text" class="form-control" value="{{json_decode($invoice->payments_details, true)['data']['charges'][0]['payments'][0]['date']}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Valor Pago</label>
                                            <input type="text" class="form-control" value="{{json_decode($invoice->payments_details, true)['data']['charges'][0]['payments'][0]['amount']}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#sendInvoiceBySms').click(function () {
            $.post('{{route('api.invoices.send.sms', $invoice->id)}}', function (data) {
                $.notify({
                    icon: "now-ui-icons ui-1_bell-53",
                    message: data.message

                },{
                    type: (data.success) ? 'info' : 'danger',
                    timer: 300,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
            })
        })

        $('#sendInvoiceByEmail').click(function () {
            $.post('{{route('api.invoices.send.email', $invoice->id)}}', function (data) {
                $.notify({
                    icon: "now-ui-icons ui-1_bell-53",
                    message: data.message

                },{
                    type: (data.success) ? 'info' : 'danger',
                    timer: 300,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
            })
        })
    </script>
@endpush
