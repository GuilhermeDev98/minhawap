@extends('layouts.app', [
    'namePage' => 'Nova Oferta',
    'class' => 'sidebar-mini',
    'activePage' => 'plan',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.plan.show', $plan->id) }}"><i class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">{{ __('Adicionar Ofertas') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.plan.offer.create', $plan->id) }}" method="POST">
                            {{@csrf_field()}}
                            <div class="form-group d-flex justify-content-center">

                                <select id='offers' name="offers[]" multiple>
                                    @forelse($offers as $offer)
                                        <option
                                            value="{{$offer->id}}"
                                            @if($plan->offers->contains($offer)) disabled @endif
                                        >{{$offer->name}}</option>
                                    @empty
                                        Nenhuma Oferta
                                    @endforelse
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link href="{{ asset('css/multi-select.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('/js/jquery.multi-select.js') }}"></script>
    <script>
        $('#offers').multiSelect();
    </script>
@endpush
