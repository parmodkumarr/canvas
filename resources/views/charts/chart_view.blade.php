@extends('index')
@section('sidebar')
@endsection
@section('content')
	<script>
		
		var charts = [];
		var chartsActivity = {};
		var chart_comment_pos = [];
		var lineCoordinates   = {};
    </script>
    <input type="hidden" name="socket_connected" id="socket_connected" value="0">
    <input type="hidden" name="chart_drawn" id="chart_drawn" value="0">
	<header class="page-header">
	    <div class="container-fluid">
	        <h2 class="no-margin-bottom">Charts</h2>
	    </div>
	</header>
	<section class="dashboard-counts no-padding-bottom">	
		<div class="container-fluid">			
			<div class="bg-white has-shadow">
				<div class="row">
				<input type="hidden" name="group_id" id="group_id" value="{{$group_id}}">
				<input type="hidden" name="chart_operation_type" id="chart_operation_type" value="">
				<input type="hidden" name="chart_operation_start" id="chart_operation_start" value="">
				<input type="hidden" name="chart_operation_end" id="chart_operation_end" value="">
					<div id="content_div" style="float: left; width: 100%; text-align: center;">
						<img class="text-center img-fluid" src="{{ asset('img/loading.gif') }}" alt="loading chart">
						<p>Loading....</p>
					</div>			
				</div>
			</div>
		</div>
	</section>

<!-- <script src="{{ asset('public/js/jquery/jquery.min.js')}}"></script> -->
	

@endsection

