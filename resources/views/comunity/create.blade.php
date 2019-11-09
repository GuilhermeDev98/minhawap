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
                        <form action="{{route('comunity.create')}}" method="POST">
                            {{@csrf_field()}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nome</label>
                                        <input type="text" id="name" name="name" placeholder="Nome da Comunidade" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="linkInput" class="form-group">
                                        <label for="link">URL</label>
                                        <input type="text" id="link" name="link" placeholder="exemplo.com" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="due_date">Data de Vencimento</label>
                                        <select name="due_date" id="due_date" class="form-control">
                                            <option value="01">01</option>
                                            <option value="05">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="saveComunity" class="btn btn-primary btn-block" disabled>Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>

        const removeBtnDisabled = function(){
            $("#saveComunity").removeAttr("disabled")
        }

        $("#link").focusout(function(){
            $.ajax({
                type: "POST",
                url: '/api/v1/domain/search',
                data: { domain: $('#link').val()},
                success: (data) => {
                    if(data.available){
                        $('#linkInput').removeClass('has-danger')
                        $('#link').removeClass('form-control-danger')

                        $('#linkInput').addClass('has-success')
                        $('#link').addClass('form-control-success')
                        removeBtnDisabled()
                    }else{
                        $('#linkInput').removeClass('has-success')
                        $('#link').removeClass('form-control-success')

                        $('#linkInput').addClass('has-danger')
                        $('#link').addClass('form-control-danger')
                        $.notify({
                            // options
                            message: 'Domínio não Disponível'
                        },{
                            // settings
                            type: 'danger'
                        });
                    }
                }
            })
        })
    </script>

@endpush
