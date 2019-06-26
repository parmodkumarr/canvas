	<div class="panel-heading">
		<div style="padding:15px;">
		<a class="btn btn-default" href="#">RTA</a>
		<a class="btn btn-default" href="#">AD</a>
		<a class="btn btn-default" href="#">AL</a>
		<a class="btn btn-default" href="#">AC</a>
		<a class="btn btn-default" href="#">SB</a>
		<a class="btn btn-default" href="#">RTA</a>
		<a class="btn btn-default" href="#">SA</a>
		<a class="btn btn-default" href="#">SSB</a>
		<a class="btn btn-default" href="#">SSA</a>
		<a class="btn btn-default" href="#">SC</a>
		<a class="btn btn-default" href="#">SL</a>
		<a class="btn btn-default" href="#">SOP</a>
		<a class="btn btn-default" href="#">CM1</a>
		<a class="btn btn-default" href="#">CM2</a>
		</div>		  
	</div>
	@foreach ($charts as $chart)	
		@if($chart->type=='M')
			@if($chart->chart_type == 'line')					
				@include('charts.line_chart',['chart' =>$chart])
			@elseif($chart->chart_type == 'bar')	
				@include('charts.bar_chart',['chart' =>$chart])
			@elseif($chart->chart_type == 'area')
				@include('charts.area_chart',['chart' =>$chart])
			@else
				@include('charts.candle_chart',['chart' =>$chart])	
			@endif						
		@else
			@if($chart->chart_type == 'line')					
				@include('charts.line_chart',['chart' =>$chart])
			@elseif($chart->chart_type == 'bar')	
				@include('charts.bar_chart',['chart' =>$chart])
			@elseif($chart->chart_type == 'area')
				@include('charts.area_chart',['chart' =>$chart])
			@else
				@include('charts.candle_chart',['chart' =>$chart])	
			@endif					
		@endif					
	@endforeach
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif
	<!-- will be used to show any error from Validator -->
	@if($errors->count())
	  <div class="alert alert-warning" role="alert">{{ Html::ul($errors->all()) }}</div>
	@endif
	
	<!-- Modal add signal to chart-->
	<div class="modal fade" id="add_chart_signal_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <!-- Modal Header -->
	            <div class="modal-header">
	            	<h5 class="modal-title" id="exampleModalLabel">Add Signal</h5>
	                <button type="button" class="close" 
	                   data-dismiss="modal">
	                       <span aria-hidden="true">&times;</span>
	                       <span class="sr-only">Close</span>
	                </button>
	            </div>          
	            <!-- Modal Body -->
	            <div class="modal-body">               
					{{ Form::open(array('files' => true, 'id' => 'add_signal_form')) }}
						<div class="form-group">
							<label for="type" class="form-control-label canvas-modal-label">Signaling:</label>
							<select name="signaling" id="signaling" class="form-control">
								<option value="1">Above</option>
								<option value="2">Below</option>
							</select>
						</div>
						<div class="form-group">
							<label for="title" class="form-control-label canvas-modal-label">Value:</label>
							<input type="text" class="form-control" name="value" id="value" value="" placeholder="Signal Value"/>
							<input type="hidden" name="id" id="chart_id" value="">	
						</div>
						<div class="form-group">
						    <label for="signal_type" class="form-control-label canvas-modal-label">Signal Type:</label>
						    <div class="row">
								<label class="radio-inline col-sm-4">
							      <input type="radio" name="signal_type" class="signal_type" checked value="1">SMS
							    </label>
							    <label class="radio-inline col-sm-4">
							      <input type="radio" name="signal_type" class="signal_type" value="2">E-Mail
							    </label>
							    <label class="radio-inline col-sm-4">
							      <input type="radio" name="signal_type" class="signal_type" value="3">IVR
							    </label>
						    </div>
						</div>
	                  <button type="button" id="submit_signal" class="btn btn-default">Submit</button>
	                {{ Form::close() }}            
	            </div>
	        </div>
	    </div>
	</div>