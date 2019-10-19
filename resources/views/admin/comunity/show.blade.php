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
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('user.create') }}"><i class="fa fa-plus"></i></a>
            <h4 class="card-title">{{ __('Comunidades') }}</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table text-center">
                <thead class="text-primary">
                  <th>
                    Nome
                  </th>
                  <th>
                    Status
                  </th>
                  <th>
                    Dono
                  </th>
                  <th>
                    <i class="fa fa-cogs"></i>
                  </th>
                </thead>
                <tbody>
                    @forelse ($comunities as $comunity)
                        <tr>
                            <td>
                                <a href="{{$comunity->link}}" target="__blank">
                                {{$comunity->name}}
                                </a>
                            </td>
                            <td>
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
                                <a href="">
                                    {{$comunity->user->name}}
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-success btn-sm text-white" href="{{ route('user.create') }}"><i class="fa fa-chart-line"></i></a>                      
                                <a class="btn btn-primary btn-sm text-white" href="{{ route('user.create') }}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-warning btn-sm text-white" href="{{ route('user.create') }}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm text-white" href="{{ route('user.create') }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <p>Nenhuma Comunidade Cadastrada</p>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection