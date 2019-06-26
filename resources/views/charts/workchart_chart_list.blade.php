@extends('index')

@section('content')
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Workcharts Charts
    </div>
</header>
<!-- Dashboard Counts Section-->
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="row bg-white has-shadow">
			@foreach ($charts as $chart)
				<div class="col-md-4" style="padding:5px;">
                    <div class="workchart_box" style=" border:1px solid #dfdfdf; padding:5px;">
                    <div class="container-fluid">
                        <h3 style="float:left; width:100%; text-align: center; background-color: #F8F8F8;"><a href="{{ URL::to('charts/'.$chart->group_id) }}">{{ str_limit($chart->title,50) }}</a></h3>
                    </div>
    				<div class="thumbnail">
                        <a href="{{ URL::to('charts/'.$chart->group_id) }}"><img src="{{ asset('public/img/line-graph.jpg') }}" width="100%" alt=""></a>
    				</div>
                    <div class="dropdown show" style="text-align: center;">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item"  onclick="deleteChartParent({{$chart->group_id}}, this)" href="javascript:;">Delete</a>
                            <a class="dropdown-item" href="{{ URL::to('charts/' . $chart->group_id . '/create') }}">Add chart</a>
                            <a class="dropdown-item" href="{{ URL::to('charts/'.$chart->group_id) }}" >View charts</a>
                        </div>
                        <a href="{{ URL::to('charts/'.$chart->group_id) }}" class="btn btn-info">View charts</a>
                    </div>
				</div>
                </div>
			@endforeach
        </div>
    </div>
</section>
 

  <div class="container">
    <div class="row">
      <div class="" id="chart">

      </div>
    </div>
  </div>

@endsection

@push('script-footer')
    <script src="{{url('')}}/public/js/app.js?v={{ rand(1000, 50000000) }}"></script>
@endpush
