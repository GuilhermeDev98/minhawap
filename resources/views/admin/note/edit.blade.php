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
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.note.index') }}"><i class="fa fa-arrow-left"></i></a>
            <h4 class="card-title">{{ __('Notas') }}</h4>
          </div>
          <div class="card-body">
            <form action="{{route('admin.note.edit', $note->id)}}" method="POST">
                {{@csrf_field()}}
                <div class="form-group">
                    <label for="text">Texto</label>
                    <textarea name="text" id="text" class="form-control">
                        {{$note->text}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="comunity_id">Comunidade</label>
                    <select name="comunity_id" class="form-control" id="comunity_id">
                        @foreach($comunities as $comunity)
                            <option value="{{$comunity->id}}">{{$comunity->name}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Editar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection