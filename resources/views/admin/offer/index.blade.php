@extends('layouts.app', [
    'namePage' => 'Ofertas',
    'class' => 'sidebar-mini',
    'activePage' => 'offer',
  ])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.offer.create') }}"><i class="fa fa-plus"></i></a>
            <h4 class="card-title">{{ __('Ofertas') }}</h4>
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
                    @forelse ($offers as $offer)
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
                                <a class="btn btn-warning btn-sm text-white" href="{{ route('admin.offer.edit', $offer->id) }}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm text-white" href="{{ route('admin.offer.destroy', $offer->id) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <p class="text-center">Nenhuma Oferta Criada</p>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
          @empty(!$offers)
              <div class="card-footer d-flex justify-content-center">
                {{$offers->links()}}
              </div>
          @endempty
        </div>
      </div>
    </div>
  </div>
@endsection
