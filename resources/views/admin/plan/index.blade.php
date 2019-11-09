@extends('layouts.app', [
    'namePage' => 'Planos',
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
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('admin.plan.create') }}"><i class="fa fa-plus"></i></a>
            <h4 class="card-title">{{ __('Planos') }}</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table text-center">
                <thead class="text-primary">
                  <th>
                    Nome
                  </th>
                  <th>
                    Nome Descritivo
                  </th>
                  <th>
                    Preço
                  </th>
                  <th>
                    <i class="fa fa-cogs"></i>
                  </th>
                </thead>
                <tbody>
                    @forelse ($plans as $plan)
                        <tr @if(!$plan->sold) class="text-muted" @endif>
                            <td>
                                {{$plan->name_descriptive}}
                            </td>
                            <td>
                                {{$plan->name}}
                            </td>
                            <td>
                              R$ {{$plan->value}}
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm text-white" href="{{ route('admin.plan.show', $plan->id) }}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-warning btn-sm text-white" href="{{ route('admin.plan.edit', $plan->id) }}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm text-white" href="{{ route('admin.plan.destroy', $plan->id) }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <p class="text-center">Nenhum Plano Criada</p>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
          @empty(!$plans)
              <div class="card-footer d-flex justify-content-center">
                {{$plans->links()}}
              </div>
          @endempty
        </div>
      </div>
    </div>
  </div>
@endsection
