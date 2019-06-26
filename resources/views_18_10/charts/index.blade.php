@extends('index')

@section('content')
<!-- Page Header-->
<header class="page-header">
    <div class="container-fluid">
        <h2 class="no-margin-bottom">Main Workareas
    </div>
</header>
<!-- Dashboard Counts Section-->   
        <!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif	
		<section class="dashboard-counts no-padding-bottom">	
			<div class="container-fluid">			
				<div class="bg-white has-shadow">
					<div class="row">					
						@foreach ($charts as $chart)	
						 @if($chart->type=='M')
							<div class="col-md-12" style="text-align:center;"> Main chart </div>							 
								<div class="col-md-12">
								<div style="text-align:center;">
									<h4>
									<a href="{{ URL::to('charts/view/'.$chart->id) }}"style="margin:5px;" >{{ str_limit($chart->title,50) }}</a>								
									</h4>								
								</div>								
									<div class="thumbnail">
										@if ($chart->picture)
											<a href="#"><img src="{{ $chart->picture }}" title="Main chart" alt="Main chart"></a>
										@else
										<a href="#"><img src="{{ asset('public/img/line-graph.jpg') }}" style="width: 500px;height:250px;" title="Main chart" alt="Main chart"></a>
										@endif
									</div>
									<div class="caption" style="display: flex; margin:20px 0;">
									<a class="btn btn-default test" onclick="chartdelete({{$chart->id}})" href="javascript:;" style="margin:5px;"> Delete </a>
									</div>
								</div>
						
							@else
								<div class="col-md-3">
								<div style="text-align:center;">
									<h4>
									<a href="{{ URL::to('charts/view/'.$chart->id) }}"style="margin:5px;" >{{ str_limit($chart->title,50) }}</a>								
									</h4>								
								</div>
									<div class="thumbnail">
										@if ($chart->picture)
											<a href="#"><img src="{{ $chart->picture }}"  width="100%" title="Sub chart" alt="Sub chart"></a>
										@else
											<a href="#"><img src="{{ asset('public/img/line-graph.jpg') }}" width="100%" title="Sub chart" alt="Sub chart"></a>
										@endif
									</div>
									<div class="caption" style="display: flex; margin:20px 0;">
									<a class="btn btn-default" onclick="chartdelete({{$chart->id}})" href="javascript:;" style="margin:5px;">Delete</a>
									</div>
								</div>					
							@endif
						@endforeach 
					</div>					
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
    <script src="{{url('')}}/js/app.js?v={{ rand(1000, 50000000) }}"></script>
@endpush
