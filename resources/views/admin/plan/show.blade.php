@extends('layouts.app', [
    'namePage' => 'Planos',
    'class' => 'sidebar-mini',
    'activePage' => 'plan',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @include('alerts.success')
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.plan.offer.create', $plan->id) }}"><i class="fa fa-plus"></i></a>
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.plan.index') }}"><i class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Ofertas {{$plan->name_descriptive}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead class="text-primary">
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Descrição
                                    </th>
                                    <th>
                                        Preço
                                    </th>
                                    <th>
                                        <i class="fa fa-cogs"></i>
                                    </th>
                                </thead>
                                <tbody>
                                    @forelse ($plan->offers as $offer)
                                        <tr>
                                            <td>
                                                {{$offer->name}}
                                            </td>
                                            <td>
                                                {{$offer->description}}
                                            </td>
                                            <td>
                                                @if($offer->discount) - @endif
                                                @if($offer->percent)
                                                    {{$offer->value}}%
                                                @else
                                                    R$ {{$offer->value}}
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-sm text-white" href="{{ route('admin.plan.offer.destroy', [$plan->id, $offer->id]) }}"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <p class="text-center">Nenhuma Oferta Adicionada</p>
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
