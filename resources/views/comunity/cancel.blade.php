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
                        <div class="float-right">
                            <a href="{{route('comunity.index')}}" class="btn btn-primary btn-round text-white pull-right"><i class="fa fa-arrow-left"></i></a>
                        </div>
                        <h4 class="card-title">Comunidades</h4>

                    </div>
                    <div class="card-body">
                        <form action="{{route('comunity.cancel', $comunity->id)}}" method="POST">
                            {{@csrf_field()}}
                            <div class="form-group">
                                <label for="reason">Motivo</label>
                                <select name="reason" id="reason" class="form-control">
                                    <option value="Problemas Técnicos">Problemas Técnicos</option>
                                    <option value="Plano Caro">Plano Caro</option>
                                    <option value="Outros">Outros</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="note">Descrição</label>
                                <textarea name="note" id="note" placeholder="Detalhe o motivo do cancelamento ..." class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

