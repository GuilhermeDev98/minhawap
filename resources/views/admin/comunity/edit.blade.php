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
                            <a href="{{route('admin.comunity.show', $comunity->id)}}" class="btn btn-primary btn-round text-white pull-right"><i class="fa fa-arrow-left"></i></a>
                        </div>
                        <h4 class="card-title">Comunidades</h4>

                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.comunity.edit', $comunity->id)}}" method="POST">
                            {{@csrf_field()}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" id="name" name="name" value="{{$comunity->name}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="link">URL</label>
                                        <input type="text" id="link" name="link" value="{{$comunity->link}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_id">Usuário</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                            <option value="{{$comunity->user_id}}">{{$comunity->user->name}}</option>
                                            @foreach($users->except($comunity->user_id) as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="plan_id">Plano</label>
                                        <select name="plan_id" id="plan_id" class="form-control">
                                            <option value="{{$comunity->plan_id}}">{{$comunity->plan->name_descriptive}}</option>
                                            @foreach($plans->except($comunity->plan_id) as $plan)
                                                <option value="{{$plan->id}}">{{$plan->name_descriptive}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="active">Ativo</label>
                                        <select name="active" id="active" class="form-control">
                                            <option value="{{$comunity->active}}"> @if($comunity->active) Sim @else Não @endif</option>
                                            @if($comunity->active)
                                                <option value="0">Não</option>
                                            @else
                                                <option value="1">Sim</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="WA">Aguardando Aprovação</option>
                                            <option value="AF">Ativação Reprovada</option>
                                            <option value="AP">Aguardando Pagamento</option>
                                            <option value="RD">Registrando Domínio</option>
                                            <option value="SS">Enviando Para o Servidor</option>
                                            <option value="OA">No Ar</option>
                                            <option value="SP">Suspensa</option>
                                            <option value="CC">Cancelada</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

