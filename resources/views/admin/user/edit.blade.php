@extends('layouts.app', [
    'namePage' => 'Usuários',
    'class' => 'sidebar-mini',
    'activePage' => 'user',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.user.index') }}"><i class="fa fa-arrow-left"></i></a>
                        <h4 class="card-title">Editar {{$user->name}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.user.edit', $user->id)}}" method="POST" >
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cpf">cpf</label>
                                        <input type="number" id="cpf" name="cpf" class="form-control" value="{{$user->cpf}}" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cel">Celular</label>
                                        <input type="number" id="cel" name="cel" class="form-control" value="{{$user->cel}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email">E-Mail</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email_secondary">E-Mail Secundário</label>
                                        <input type="email" id="email_secondary" name="email_secondary" class="form-control" value="{{$user->email_secondary}}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="address">Endereço</label>
                                        <input type="text" id="address" name="address" class="form-control" value="{{$user->address}}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Editar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Alterar Status - {{$user->status}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.user.edit.status', $user->id)}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <select name="status" id="status" class="form-control">
                                    <option value="user">Cliente</option>
                                    <option value="collaborator">Colaborador</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-block btn-warning">Alterar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Alterar Senha</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <strong>Clicando no botão abaixo, será gerada uma nova senha para o cliente e a mesma será enviada para o email primário e secundário do cliente, confira sempre se o cliente tem acesso ao email cadastrado</strong>
                        </div>
                        <a href="{{route('admin.user.resetPassword', $user)}}" class="btn btn-danger btn-block">Alterar senha e enviar por email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
