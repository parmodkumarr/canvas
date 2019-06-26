<div class="row col-md-6 main_section" id="group_chart_no{{$id}}" >
	<div class="border_both">
	<h6>TimeSeries : {{$id}}</h6>
	<div class="col-md-12">
		<div class="form-group">
			<div class="radio">
		        <label style="margin-left: 10px;">
		        	<input type="radio" name="series_type{{$id}}" series_no="{{$id}}" class='minimal-red series_type' checked value="1">Assets
		        </label>
	        
		        <label style="margin-left: 10px;">
		        	<input type="radio" name="series_type{{$id}}" series_no="{{$id}}" class='minimal-red series_type' value="2">Indicator
		        </label>
	       
		        <label style="margin-left: 10px;">
		        	<input type="radio" name="series_type{{$id}}" series_no="{{$id}}" class='minimal-red series_type' value="3">User Indicator
		        </label>

		         <label style="margin-left: 10px;">
		        	<input type="radio" name="series_type{{$id}}" series_no="{{$id}}" class='minimal-red series_type' value="4">User Algo.
		        </label>
	        </div>
	    </div>
    </div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="type" >Data Option</label>
			<select class="form-control" name="data_option{{$id}}" id="data_option{{$id}}" current_option{{$id}}="0" required>
				
			</select>
		</div>									
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="type" >Chart Type</label>
			<select class="form-control" name="chart_type{{$id}}" id="chart_type{{$id}}" required>
				<option value="">Select Chart Type</option>
				<option value="line">Line</option>
				<option value="bar">Bar</option>
				<option value="area">Area</option>
				<option value="candle">Candle</option>
			</select>
		</div>									
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="color">Color</label>
			<input type="text" name="timeseries_chart_color{{$id}}" id="timeseries_chart_color{{$id}}" class="form-control timeseries_chart_color" value="#444">
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-12">
		<div class="form-group">
			<a class="btn btn-default remove_btn" href="javascript:;" onclick="removeTimeseries(this,null)">
				<i class="fa fa-remove"></i> Remove
			</a>
		</div>
	</div>
</div>
</div>

<script src="{{ asset('public/js/spectrum.js')}}"></script>
<script>
	getTimesersiesDataOptions('asset', {{ $id }}, '');
	$("#timeseries_chart_color{{$id}}").spectrum({
	    color: "#ECC",
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
</script>