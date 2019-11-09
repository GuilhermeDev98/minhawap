@extends('layouts.app', [
    'namePage' => 'Ver Oferta',
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
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.offer.index') }}"><i class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">{{ __('Ofertas') }}</h4>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
