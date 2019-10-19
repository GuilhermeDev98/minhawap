@extends('layouts.app', [
    'namePage' => 'Notas',
    'class' => 'sidebar-mini',
    'activePage' => 'note',
  ])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.note.create') }}"><i class="fa fa-plus"></i></a>
            <h4 class="card-title">{{ __('Notas') }}</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table text-center">
                <thead class="text-primary">
                  <th>
                    Texto
                  </th>
                  <th>
                    Comunidade
                  </th>
                  <th>
                    Criador
                  </th>
                  <th>
                    <i class="fa fa-cogs"></i>
                  </th>
                </thead>
                <tbody>
                    @forelse ($notes as $note)
                        <tr>
                            <td>
                              {{ Str::limit($note->text, 30) }}
                            </td>
                            <td>
                              <a href="{{route('comunity.show', $note->comunity->id)}}">
                                {{$note->comunity->name}}
                              </a>
                            </td>
                            <td>
                              {{$note->user->name}}
                            </td>
                            <td>                    
                                <a class="btn btn-info btn-sm text-white" href="{{ route('user.create') }}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-warning btn-sm text-white" href="{{ route('admin.note.edit', $note->id) }}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm text-white" href="{{ route('admin.note.destroy', $note->id) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <p>Nenhuma Nota Criada</p>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
          @empty(!$notes)
              <div class="card-footer d-flex justify-content-center">
                {{$notes->links()}}
              </div>
          @endempty
        </div>
      </div>
    </div>
  </div>
@endsection