<input type="hidden" name="chart_start_date" id="chart_start_date" value="">
	<input type="hidden" name="chart_end_date" id="chart_end_date" value="">
	@if(Request::path() == 'charts/*')
		 <script>
		  alert('comming to start date time script');
			@if($chart->chart_mode == 2)
				var start_time = moment({{$chart->start_date}}, 'YYYY-MM-DD HH:mm:ss').toISOString();
				var end_time   = moment({{$chart->end_date}}, 'YYYY-MM-DD HH:mm:ss').toISOString();
			@else
				var start_time = moment().format("YYYY-MM-DDTHH:mm:ss.SSS[Z]"); 
				var end_time   = moment().subtract(12, 'hours').format("YYYY-MM-DDTHH:mm:ss.SSS[Z]");
			@endif
			console.log(start_time);
			console.log(end_time);
			document.getElementById("chart_start_date").value = start_time;
			document.getElementById("chart_end_date").value = end_time;
	    </script>
    @endif
	<input type="hidden" name="socket_connected" id="socket_connected" value="0">
    <input type="hidden" name="socket_data" id="socket_data" value="">
    <input type="hidden" name="chart_drawn" id="chart_drawn" value="0">