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
                            <a href="{{route('admin.comunity.index')}}" class="btn btn-primary btn-round text-white pull-right"><i class="fa fa-arrow-left"></i></a>
                        </div>
                        <h4 class="card-title">Comunidades</h4>

                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.comunity.create')}}" method="POST">
                            {{@csrf_field()}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" id="name" name="name" placeholder="Nome da Comunidade" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="link">URL</label>
                                        <input type="text" id="link" name="link" placeholder="exemplo.com" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_id">Usuário</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="plan_id">Plano</label>
                                        <select name="plan_id" id="plan_id" class="form-control">
                                            @foreach($plans as $plan)
                                                <option value="{{$plan->id}}">{{$plan->name_descriptive}}</option>
                                            @endforeach
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

