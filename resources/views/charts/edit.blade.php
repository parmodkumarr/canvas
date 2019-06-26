@extends('index')

@section('content')
<style>

.main_section {
    float: left;
    width:100%;
    margin-top: 10px;
}
.main_section .input_sec {
    float: left;
    width: 40%;
}

.main_section .close {
    float: left;
    width:12%;
        margin-top: 30px;
}

</style>
  <div class="container content">
    <div id="message"></div>
    
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
		<div class="row bg-white has-shadow">
		   <div class="panel panel-default" style="width:100%;">
			  <div class="panel-heading">
			  	@if (Session::has('message'))
			        <div class="alert alert-info">{{ Session::get('message') }}</div>
			    @endif
			  	@if($errors->count())
			      <div class="alert alert-warning" role="alert">{{ Html::ul($errors->all()) }}</div>
			    @endif
			  </div>
				<div class="panel-body">         
				  <div id="workarea">
						{{ Form::model($chart, ['url' => 'charts/update/'.$chart->id, 'method' => 'put']) }}
						<div class="row">
						<div class="col-md-12">
							<div class="edit_heading">
							<h5>Edit Chart</h5>
						</div>
							<div class="form-group">
							<input type="hidden" name="workchart_id" id="workchart_id" value="{{ $chart->workchart_id }}">	
							@if($chart)
							<input type="hidden" name="mainchart_id" id="mainchart_id" value="{{ $chart->id }}">	
							@endif
												  
							</div>
						</div>	
						
						
						

						<div class="col-md-12" id="group_form_div" style="display:block">
							<div id="new_timeseries_chart">
								
								@if(count($timeseries) > 0)
								<input type="hidden" name="timeseries_count" id="timeseries_count" value="{{count($timeseries)}}">
								    @php
									$i = 1
									@endphp
									@foreach($timeseries as $timeserie)
										<div class="row col-md-6 main_section" id="group_chart_no{{$i}}">
											<div class="border_both">
											<h6>TimeSeries : {{$i}}</h6>
											<div class="col-md-12">
												<div class="form-group">
													<div class="radio">
												        <label style="margin-left: 10px;">
												        	<input type="radio" name="series_type{{$i}}" class='minimal-red series_type' series_no="{{$i}}" value="1" @if($timeserie->series_type == '1') checked onload="func1();" @endif>Assets
												        </label>
											        
												        <label style="margin-left: 10px;">
												        	<input type="radio" name="series_type{{$i}}" class='minimal-red series_type' series_no="{{$i}}" value="2" @if($timeserie->series_type == '2') checked @endif>Indicator
												        </label>
											       
												        <label style="margin-left: 10px;">
												        	<input type="radio" name="series_type{{$i}}" class='minimal-red series_type' series_no="{{$i}}" value="3" @if($timeserie->series_type == '3') checked @endif>User Indicator
												        </label>

												        <label style="margin-left: 10px;">
												        	<input type="radio" name="series_type{{$i}}" class='minimal-red series_type' series_no="{{$i}}" value="4" @if($timeserie->series_type == '4') checked @endif>User Algo.
												        </label>
											        </div>
											    </div>
										    </div>
										    <input type="hidden" name="saved_timeseries_id{{$i}}" value="{{$timeserie->id}}"> 

										    <div class="col-md-12">
												<div class="form-group">
													<label for="type">Data Option</label>
													<select class="form-control" name="data_option{{$i}}" id="data_option{{$i}}" current_option{{$i}}="{{$timeserie->param_id}}" required>
													</select>	
												</div>									
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label for="type">Chart Type</label>
													<select class="form-control" name="chart_type{{$i}}" id="chart_type{{$i}}" required>
													<option value="">Select Chart Type</option>
													<option value="line" @if($timeserie->chart_type == 'line') selected @endif>Line</option>
												    <option value="bar" @if($timeserie->chart_type == 'bar') selected @endif>Bar</option>
												    <option value="area" @if($timeserie->chart_type == 'area') selected @endif>Area</option>
												    <option value="candle" @if($timeserie->chart_type == 'candle') selected @endif>Candle</option>
												    </select>
												</div>									
											</div>

											<div class="col-md-12 input_sec">
												<div class="form-group">
													<label for="color">Color</label>
													<input type="text" name="timeseries_chart_color{{$i}}" id="timeseries_chart_color{{$i}}" class="form-control timeseries_chart_color" value="{{$timeserie->color}}">
												</div>
											</div>
											
											<div class="close">
												<div class="form-group">
													<a class="btn remove_btn" href="javascript:;" onclick="removeTimeseries(this,{{$timeserie->id}})">
														<i class="fa fa-remove"></i>Remove
													</a>
												</div>
											</div>
										</div>
										</div>
										@php
										$i++
										@endphp
									@endforeach
								@else
								<input type="hidden" name="timeseries_count" id="timeseries_count" value="0">	
								@endif
							</div>	
							<div class="clearfix"></div>			
							<div class="form-group" style="text-align: center;">
								<a class="btn btn-default back" href="{{ URL::to('charts/'.$chart->workchart_id) }}">Back</a>
								

								<a class="btn btn-default edit_time_series" href="javascript:;" title="Add Time Series" onclick="addTimeseriesToChart();">
									<i class="fa fa-plus"></i> Add/Edit Time Series
								</a>
								{{ Form::submit('Save!', ['class' => 'btn btn-primary save']) }}
							</div>					
						</div>
						{{ Form::close() }}
				  </div>
				</div>
			  </div>
			</div>						
		</div>	
	</div>
</section>
<script src="{{ asset('public/js/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('public/js/spectrum.js')}}"></script>
<script>
	$(document).ready(function(){
		

		$(document).on('click', '.series_type', function(){
			
			var series_no = $(this).attr('series_no');
			
			if($(this).val() == 1){
				getTimesersiesDataOptions('asset', series_no, '');
			}else if($(this).val() == 2){
				getTimesersiesDataOptions('indicator', series_no, '');
			}else if($(this).val() == 3){
				getTimesersiesDataOptions('userIndicator', series_no, '');
			}else if($(this).val() == 4){
				getTimesersiesDataOptions('userAlgo', series_no, '');
			}
        });

		$('#chart_mode').change(function(){
			var mode = $(this).val();
			if(mode == 2){
				$('.chart_mode_div').show();
			}else{
				$('.chart_mode_div').hide();
			}
		});

		$('#start_date').datetimepicker({format: 'yyyy-mm-dd hh:mm:ss'}).on('changeDate', function (e) {         
		});
		$('#end_date').datetimepicker({format: 'yyyy-mm-dd hh:mm:ss'}).on('changeDate', function (e) {
			var endDate = $("#end_date").val();
	        var startDate = $("#start_date").val();
	        if(startDate == ''){
	        	$("#start_date").addClass('has-error');
	        	$("#start_date").focus();
	        }else{
		        if(startDate>endDate){
		            //alert('Please select date which is less then starting date');
		            $("#end_date").addClass('has-error');
		            $("#end_date").val('');
		            $("#end_date").focus();
		        }  
	        }         
		});
		
    $(".timeseries_chart_color").spectrum({
	    //color:$("#group_c_color{{--$i--}}").val(),
	    showInput: true,
	    className: "full-spectrum",
	    showInitial: true,
	    showPaletteOnly: true,
	    showPalette: true,
	    showSelectionPalette: true,
	    maxSelectionSize: 10,
	    preferredFormat: "hex",
	    localStorageKey: "spectrum.demo",
	    move: function (color) {},
	    show: function () {},
	    beforeShow: function () {},
	    hide: function () {},
	    change: function() {},
	    palette: [
	        ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
	        ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
	        ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
	        ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
	        ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
	        ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
	        ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
	        ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
	    ]
    });
		checkAndGetResultFromApi();
	});
	function checkAndGetResultFromApi(){
		var timeseries_count = $('#timeseries_count').val();
		
			var checked_button  = $('input[type="radio"]:checked');
			checked_button.each(function(i){
				console.log('radio_button : '+i);
				var series_no = $(this).attr('series_no');
				var current_option = $('#data_option'+series_no).attr('current_option'+series_no);
				
			    if($(this).val() == 1){
					getTimesersiesDataOptions('asset', series_no, current_option);
				}else if($(this).val() == 2){
					getTimesersiesDataOptions('indicator', series_no, current_option);
				}else if($(this).val() == 3){
					getTimesersiesDataOptions('userIndicator', series_no, current_option);
				}else if($(this).val() == 4){
					getTimesersiesDataOptions('userAlgo', series_no, current_option);
				}
		    });
		
	}
	//var timeseries_count = 0;
	function addTimeseriesToChart(){
		var timeseries_count = document.getElementById("timeseries_count").value;
		++timeseries_count;
		$.ajax({
			type: 'GET',
			url: APP_URL+'/charts/get_timeseries_form/'+timeseries_count,
			success: function(response) {
				console.log(response.view);
				$('#timeseries_count').val(timeseries_count);
				if (response.status == 'success') {
					$('#new_timeseries_chart').append(response.view);
				} else {
					
				}
			},
		});	
	}

function removeTimeseries(obj,id){
	
	if(id!==null){
	   swal({
		   title: "Are you sure?",
		   text: "Your will not be able to recover this data!",
		   type: "warning",
		   showCancelButton: true,
		   confirmButtonClass: "btn-danger",
		   confirmButtonText: "Yes, delete it!",
		   closeOnConfirm: false
	   }).then(function(isConfirm){
		    if (isConfirm.value) {
			    $.ajax({
				    url: APP_URL+'/charts/delete_time_series/'+id,
				    type: 'GET',
				    success: function(response){
					    if(response.status == 'success'){
						    swal({
							    title: 'Deleted!', 
							    text: 'The timeseries was deleted successfully.',
							    type: 'success'
						    });
							location.reload();
					    }else{
						    swal({
							    title: 'Deleted!', 
							    text: 'The timeseries could not be deleted.',
							    type: 'error'
						    });
					    }
				    }
			    });
		   } 
	   });
	   
	}else{
		var chart_count = $('#timeseries_count').val()-1;
		$('#timeseries_count').val(chart_count);
		$(obj).parent().parent().parent().remove();
	}
}
	
</script>
@endsection


@push('script-footer')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    {{-- <script src="{{url('')}}/js/addChart.js"></script> --}}
    <script src="{{url('')}}/js/workarea.js?v={{ rand(1000, 50000000) }}"></script>
@endpush

