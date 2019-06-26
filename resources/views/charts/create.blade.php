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

<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
		<div class="row">
		
			<!-- Basic Form-->
			<div class="col-md-3" ></div>
			<div class=" col-md-6" >
                    
                    
		   <div class="card">
			  
					<div id="message"></div>
						<!-- will be used to show any messages -->
						@if (Session::has('message'))
							<div class="alert alert-info">{{ Session::get('message') }}</div>
						@endif

						<!-- will be used to show any error from Validator -->
						@if($errors->count())
						  <div class="alert alert-warning" role="alert">{{ Html::ul($errors->all()) }}</div>
						@endif
				<div class="card-body">  
				<h4>Add Charts</h4>       
				  <div id="workarea">
						{{ Form::open(array('url' => 'charts/create')) }}
						<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								{{ Form::label('name', 'Name') }}
								{{ Form::text('title', Input::old('title'), ['class' => 'form-control']) }}					  
							</div>
						</div>
						<input type="hidden" name="workchart_id" id="workchart_id" value="{{ $workchart_id }}">
						<div class="col-md-12">
							<div class="form-group">
								{{ Form::label('type', 'Type') }}
								{{ Form::select('type', $select, null ,['class' => 'form-control']) }}
							</div>	
						</div>	
						<input type="hidden" name="timeseries_count" id="timeseries_count" value="0">
						<div class="col-md-12" id="group_form_div" style="display:block">
							<div id="new_timeseries_chart" style="margin-top: 5px;"></div>
							<div class="form-group" style=" margin-top:10px;text-align:center;">
								<a class="btn btn-default" href="{{ URL::to('charts/'.$workchart_id ) }}">Back</a>
								{{ Form::submit('Save!', ['class' => 'btn btn-primary']) }}
							</div>					
						
						</div>
						{{ Form::close() }}
				  </div>
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
				$("#data_option"+series_no).append('<option value="">Option Unavailable</option>');
			}else if($(this).val() == 3){
				$("#data_option"+series_no).append('<option value="">Option Unavailable</option>');
			}else if($(this).val() == 4){
				$("#data_option"+series_no).append('<option value="">Option Unavailable</option>');
			}
        });

		$('#chart_mode').change(function(){
			var mode = $(this).val();
			if(mode == 2){
				$('.chart_mode_div').show();
			}else{
				$('.chart_mode_div').hide();
			}
		})
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
	})
	var timeseries_count = 0;
	function addGroupChart(){
		timeseries_count +=1;
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

	function removeTimeseries(obj){
		var chart_count =$('#timeseries_count').val()-1;
		$('#timeseries_count').val(chart_count);
		$(obj).parent().parent().parent().remove();
	}
</script>
@endsection


@push('script-footer')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    {{-- <script src="{{url('')}}/js/addChart.js"></script> --}}
    <script src="{{url('')}}/js/workarea.js?v={{ rand(1000, 50000000) }}"></script>
@endpush

