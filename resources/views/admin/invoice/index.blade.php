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
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.plan.create') }}"><i class="fa fa-plus"></i></a>
                        <h4 class="card-title">{{ __('Faturas') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead class="text-primary">
                                <th>
                                    Valor
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Vencimento
                                </th>
                                <th>
                                    Informações
                                </th>
                                <th>
                                    <i class="fa fa-cogs"></i>
                                </th>
                                </thead>
                                <tbody>
                                @forelse ($invoices->reverse() as $invoice)
                                    <tr>
                                        <td>
                                            R${{$invoice->value}}
                                        </td>
                                        <td>
                                            {{$invoice->status}}
                                        </td>
                                        <td>
                                            {{ date('d/m/Y', strtotime($invoice->due_date)) }}
                                        </td>
                                        <td>
                                            <a href="#" title="{{$invoice->description}}"><i class="fa fa-info"></i></a>
                                        </td>
                                        <td>
                                            @empty(!$invoice->payments_details)
                                                <a class="btn btn-success btn-sm text-white" href="
                                                @foreach(json_decode($invoice->payments_details, true)['data'] as $detail)
                                                {{$detail[0]['installmentLink']}}
                                                @endforeach
                                                    " target="_blank"><i class="fa fa-file-download"></i>
                                                </a>
                                            @endempty
                                            <a class="btn btn-info btn-sm text-white" href="{{ route('admin.invoice.show', $invoice->id) }}"><i class="fa fa-eye"></i></a>
                                            @if($invoice->status != 'CANCELED' && $invoice->status != 'CONFIRMED')
                                                    <a class="btn btn-danger btn-sm text-white" href="{{ route('admin.invoice.cancel', $invoice->id) }}" title="Cancelar Cobrança"><i class="fa fa-times"></i></a>
                                            @endif
{{--                                            @if($invoice->status == 'CONFIRMED')--}}
{{--                                                    <a class="btn btn-warning btn-sm text-white" href="{{ route('admin.invoice.cancel', $invoice->id) }}" title="Revogar Cobrança"><i class="fa fa-gavel"></i></a>--}}
{{--                                            @endif--}}
                                        </td>
                                    </tr>
                                @empty
                                    <p class="text-center">Nenhuma Fatura Criada</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @empty(!$invoices)
                        <div class="card-footer d-flex justify-content-center">
                            {{$invoices->links()}}
                        </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
@endsection
