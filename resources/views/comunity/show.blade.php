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
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('user.create') }}"><i class="fa fa-plus"></i></a>
            <h4 class="card-title">{{$comunity->name}} <a href="{{$comunity->link}}" target="__blank"><i class="fa fa-share"></i></a> </h4>
          </div>
          <div class="card-body">
          <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Global Sales</h5>
            <h4 class="card-title">Shipped Products</h4>
            <div class="dropdown">
              <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                <i class="now-ui-icons loader_gear"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <a class="dropdown-item text-danger" href="#">Remove Data</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="lineChartExample"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
            </div>
          </div>
        </div>
      </div>
            <div class="table-responsive">
              <table class="table text-center">
                <thead class="text-primary">
                  <th>
                    Nome
                  </th>
                  <th>
                    Status
                  </th>
                  <th>
                    Dono
                  </th>
                  <th>
                    <i class="fa fa-cogs"></i>
                  </th>
                </thead>
                <tbody>
                        <tr>
                            <td>
                                <a href="{{$comunity->link}}" target="__blank">
                                {{$comunity->name}}
                                </a>
                            </td>
                            <td>

                            </td>
                            <td>
                                <a href="">
                                    {{$comunity->user->name}}
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-success btn-sm text-white" href="{{ route('user.create') }}"><i class="fa fa-chart-line"></i></a>                      
                                <a class="btn btn-primary btn-sm text-white" href="{{ route('user.create') }}"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-warning btn-sm text-white" href="{{ route('user.create') }}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm text-white" href="{{ route('user.create') }}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
@endpush