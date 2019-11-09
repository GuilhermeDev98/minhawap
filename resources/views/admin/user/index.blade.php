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
                        <h4 class="card-title">{{ __('Usuários') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead class="text-primary">
                                <th>
                                    Nome
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Celular
                                </th>
                                <th>
                                    <i class="fa fa-cogs"></i>
                                </th>
                                </thead>
                                <tbody>
                                @forelse ($users as $user)
                                    <tr @if($user->deleted_at) class="text-muted" @endif>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            <a href="mailto:{{$user->email}}" >{{$user->email}}</a>
                                        </td>
                                        <td>
                                            <a href="tel:{{$user->cel}}">{{$user->cel}}</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-sm text-white" href="{{ route('admin.user.show', $user->id) }}"><i class="fa fa-eye"></i></a>
                                            @if(!$user->deleted_at)
                                                <a class="btn btn-warning btn-sm text-white" href="{{ route('admin.user.edit', $user->id) }}"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm text-white" href="{{ route('admin.user.delete', $user->id) }}"><i class="fa fa-trash"></i></a>
                                            @else
                                                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.user.restore', $user->id) }}"><i class="fa fa-sync"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <p class="text-center">Nenhum Usuário Criada</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @empty(!$users)
                        <div class="card-footer d-flex justify-content-center">
                            {{$users->links()}}
                        </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
@endsection
