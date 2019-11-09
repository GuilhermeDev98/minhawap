@extends('layouts.app', [
    'namePage' => 'Novo Plano',
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
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.plan.index') }}"><i class="fa fa-arrow-left"></i></a>
            <h4 class="card-title">{{ __('Planos') }}</h4>
          </div>
          <div class="card-body">
            <form action="{{route('admin.plan.create')}}" method="POST">
                {{@csrf_field()}}
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">Nome Descritivo</label>
                    <input type="text" name="name_descriptive" id="name_descriptive" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="value">Valor</label>
                    <input type="number" name="value" id="value" class="form-control" step="any" required>
                </div>
                <div class="form-group">
                    <label for="type">Gratis</label>
                    <select name="type" id="type" class="form-control">
                        <option value="free">Sim</option>
                        <option value="paid">Não</option>
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
