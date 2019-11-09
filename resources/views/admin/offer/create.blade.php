@extends('layouts.app', [
    'namePage' => 'Nova Oferta',
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
            <form action="{{route('admin.offer.create')}}" method="POST">
                {{@csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="value">Valor</label>
                            <input type="number" name="value" step="any" id="value" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="expiration_date">Data de Expiração</label>
                            <input type="date" name="expiration_date" id="expiration_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="discount">Desconto</label>
                            <select name="discount" id="discount" class="form-control" required>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="percent">Porcetagem</label>
                            <select name="percent" id="percent" class="form-control" required>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
