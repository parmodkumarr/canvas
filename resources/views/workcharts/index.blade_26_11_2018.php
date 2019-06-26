@extends('index')

@section('content')
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Workcharts
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
			@foreach ($workcharts as $workchart)
				<div class="col-md-4">
                    <div class="container-fluid">
                        <h3 style="float:left; width:100%; text-align: center;"><a href="{{ URL::to('charts/'.$workchart->id) }}">{{ str_limit($workchart->title,50) }}</a></h3>
                    </div>
    				<div class="thumbnail">
    					@if ($workchart->picture)
    						<a href="{{ URL::to('charts/'.$workchart->id) }}"><img src="{{ $workchart->picture }}"  width="100%" alt=""></a>
    					@else
    						<a href="{{ URL::to('charts/'.$workchart->id) }}"><img src="{{ asset('public/img/line-graph.jpg') }}" width="100%" alt=""></a>
    					@endif
    				</div>
                    <div class="dropdown show">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item"  onclick="deleteWorkchart({{$workchart->id}}, this)" href="javascript:;">Delete</a>
                            <a class="dropdown-item" href="{{ URL::to('workcharts/' . $workchart->id . '/create') }}">Add chart</a>
                            @if($workchart->timeseries)
                                <a class="dropdown-item" href="{{ URL::to('workcharts/edit_time_series/'. $workchart->timeseries->id) }}">Update Time Series</a>
                            @else
                                <a class="dropdown-item" href="{{ URL::to('workcharts/add_time_series/'. $workchart->id) }}">Add Time Series</a>
                            @endif
                            <a class="dropdown-item" href="{{ URL::to('charts/'.$workchart->id) }}" >Show charts</a>
                            <a class="dropdown-item" href="{{ URL::to('workcharts/show_group/'.$workchart->id) }}" >Show Groups</a>
                            <a class="dropdown-item" href="{{ URL::to('workcharts/' . $workchart->id . '/edit') }}">Edit workchart</a>
                        </div>
                        <a href="{{ URL::to('charts/'.$workchart->id) }}" class="btn btn-info" style="margin:5px;">Show charts</a>
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
