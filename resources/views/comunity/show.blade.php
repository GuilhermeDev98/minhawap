@extends('layouts.app', [
    'namePage' => 'Comunidades',
    'class' => 'sidebar-mini',
    'activePage' => 'comunity',
  ])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('comunity.index') }}"><i class="fa fa-arrow-left"></i></a>
                    @if($comunity->active)
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('comunity.edit', $comunity->id) }}"><i class="fa fa-edit"></i></a>
                    @endif
                    <h4 class="card-title">{{$comunity->name}} <a href="{{$comunity->link}}" target="__blank"><i class="fa fa-share"></i></a> </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informações da Comunidade</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-primary">
                            <th>Nome</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Plano</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {{$comunity->name}}
                                </td>
                                <td>
                                    <a href="{{$comunity->link}}" target="__blank">
                                        {{$comunity->link}}
                                    </a>
                                </td>
                                <td>
                                    @switch($comunity->active)
                                        @case(1)
                                        Ativa
                                        @break

                                        @case(0)
                                        Inativa
                                        @break
                                        @default
                                        Erro

                                    @endswitch
                                    -
                                    @switch($comunity->status)
                                        @case('WA')
                                        Aguardando Aprovação
                                        @break

                                        @case('AF')
                                        Ativação Reprovada
                                        @break

                                        @case('AP')
                                        Aguardando Pagamento
                                        @break

                                        @case('RD')
                                        Registrando Domínio
                                        @break

                                        @case('SS')
                                        Enviando Para o Servidor
                                        @break

                                        @case('OA')
                                        No Ar
                                        @break

                                        @case('SP')
                                        Suspensa
                                        @break

                                        @case('CC')
                                        Cancelada
                                        @break

                                        @default
                                        Erro
                                    @endswitch
                                </td>
                                <td>
                                    {{$comunity->plan->name_descriptive}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if($comunity->active)
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.comunity.offer.create', $comunity->id) }}"><i class="fa fa-plus"></i></a>
                    @endif
                    <h4 class="card-title">Ofertas Avulsas</h4>
                </div>
                <table class="table text-center">
                    <thead class="text-primary">
                    <th>
                        Descrição
                    </th>
                    <th>
                        Valor
                    </th>
                    @if($comunity->active)
                        <th>
                            <i class="fa fa-cogs"></i>
                        </th>
                    @endif
                    </thead>
                    <tbody>
                    @forelse($comunity->offers as $offer)
                        <tr>
                            <td>{{$offer->description}}</td>
                            <td>
                                @if($offer->discount) - @endif
                                @if($offer->percent)
                                    {{$offer->value}}%
                                @else
                                    R$ {{$offer->value}}
                                @endif
                            </td>
                            @if($comunity->active)
                                <td>
                                    <a class="btn btn-warning btn-sm text-white" href="{{ route('admin.offer.edit', $offer->id) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm text-white" href="{{ route('admin.comunity.offer.destroy', [$comunity->plan->id, $offer->id]) }}"><i class="fa fa-trash"></i></a>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <p class="text-center">Nenhuma Oferta Avulsa</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('user.create') }}"><i class="fa fa-plus"></i></a>
                    <h4 class="card-title">Pagamentos</h4>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
@endpush
