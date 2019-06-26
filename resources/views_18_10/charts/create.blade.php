@extends('index')

@section('content')

  <div class="container content">
    <div id="message"></div>
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <!-- will be used to show any error from Validator -->
    @if($errors->count())
      <div class="alert alert-warning" role="alert">{{ Html::ul($errors->all()) }}</div>
    @endif
<section class="dashboard-counts no-padding-bottom">
    <div class="container-fluid">
		<div class="row bg-white has-shadow">
		   <div class="panel panel-default">
			  <div class="panel-heading"><h4>Add Charts</h4></div>
				<div class="panel-body">         
				  <div id="workarea">
						{{ Form::open(array('url' => 'charts/create')) }}
						<div class="row">
						<div class="col-md-12">
							<div class="form-group">
							<input type="hidden" name="workchart_id" id="workchart_id" value="{{ $workchart_id }}">	
							@if($check)
							<input type="hidden" name="mainchart_id" id="mainchart_id" value="{{ $check->id }}">	
							@endif
								{{ Form::label('name', 'Name') }}
								{{ Form::text('title', Input::old('title'), ['class' => 'form-control']) }}					  
							</div>
						</div>	
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('type', 'Type') }}
								{{ Form::select('type', $select, null ,['class' => 'form-control']) }}
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('chart type', 'Chart Type') }}
								{{ Form::select('chart_type', ['' => 'Select chart','line' => 'Line','bar' => 'bar','candle' => 'Candle','area' => 'Area'], null, ['class' => 'form-control']) }}		  
							</div>									
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{{ Form::label('data group', 'Data Group') }}
								{{ Form::select('data_group', ['' => 'Select Data Set','asset' => 'Asset','indicator' => 'Indicator','userIndicator' => 'User Indicator','userAlgo' => 'User Algo'], null, ['class' => 'form-control', 'id' => 'data_group']) }}
							</div>									
						</div>
						<div class="col-md-6" id="data_group_option_div" style="display:none">
							<div class="form-group">
								{{ Form::label('data option', 'Data Option') }}
								{{ Form::select('data_group_option', ['' => 'Select Data Set'], null, ['class' => 'form-control', 'id' => 'data_group_option']) }}
							</div>									
						</div>
						<div class="col-md-12">
							<div class="form-group">
								{{ Form::label('chart color', 'Chart Color') }}
								{{ Form::text('chart_color', Input::old('title'), ['class' => 'form-control', 'id' => 'chart_color']) }}					  
							</div>
						</div>
						<div class="col-md-6">				
							<div class="form-group">
								<a class="btn btn-default" href="">Back</a>
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
</section>
@endsection


@push('script-footer')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    {{-- <script src="{{url('')}}/js/addChart.js"></script> --}}
    <script src="{{url('')}}/js/workarea.js?v={{ rand(1000, 50000000) }}"></script>
@endpush
