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
				<div class="col-md-3" style="padding:5px;">
                    <div class="workchart_box" style=" border:1px solid #dfdfdf; padding:5px;">
                    <div class="container-fluid">
                        <h5 style="float:left; width:100%; text-align: center; background-color: #F8F8F8;">
                            <a class="dropdown-item" href="{{ URL::to('charts/'.$workchart->id) }}" >
                            {{ str_limit($workchart->title,20) }}</a></h5>
                    </div>
    				<div class="thumbnail">
    					@if ($workchart->picture)
                            <a class="dropdown-item" href="{{ URL::to('charts/'.$workchart->id) }}" >
    						<img src="{{ $workchart->picture }}"  width="100%" alt=""></a>
    					@else
                            <a class="dropdown-item" href="{{ URL::to('charts/'.$workchart->id) }}" >
    						<img src="{{ asset('public/img/line-graph.jpg') }}" width="100%" alt=""></a>
    					@endif
    				</div>
                    <div class="dropdown show" style="text-align: center;">
                       
                        <a class="btn btn-danger" onclick="deleteWorkchart({{$workchart->id}}, this)" href="javascript:;">Delete</a>
                        <a class="btn btn-info" href="{{ URL::to('workcharts/' . $workchart->id . '/edit') }}">Edit workchart</a>
                        
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
