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
                        <h4 class="card-title">{{$user->name}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.user.edit', $user->id)}}" method="POST" >
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cpf">cpf</label>
                                        <input type="number" id="cpf" name="cpf" class="form-control" value="{{$user->cpf}}" disabled>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cel">Celular</label>
                                        <input type="number" id="cel" name="cel" class="form-control" value="{{$user->cel}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email">E-Mail</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email_secondary">E-Mail Secundário</label>
                                        <input type="email" id="email_secondary" name="email_secondary" class="form-control" value="{{$user->email_secondary}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address">Endereço</label>
                                        <input type="text" id="address" name="address" class="form-control" value="{{$user->address}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="Status">Status</label>
                                        <input type="text" id="Status" name="Status" class="form-control" value="{{$user->status}}" disabled>
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
