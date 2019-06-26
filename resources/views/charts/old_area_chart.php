<div class="col-md-12">
	<canvas id="chart_{{$chart->id }}">	</canvas>
	<div class="dropdown show" style="text-align: left; float: left; width: 100%;">
        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        	<a class="dropdown-item" href="{{ URL::to('charts/' . $chart->id . '/edit') }}">Edit</a>
            <a class="dropdown-item" onclick="chartdelete({{$chart->id}})" href="javascript:;">Delete</a>
            @if($chart->chart_signal)
				<a class="dropdown-item chart_add_signal" value="{{$chart->chart_signal->value}}" level="{{$chart->chart_signal->level}}" signal_type="{{$chart->chart_signal->signal_type}}" request_id="{{$chart->id}}" new_signal="false" href="javascript:;">Update Signal</a>
				<a class="dropdown-item" onclick="signaldelete({{$chart->chart_signal->id}})" href="javascript:;">Delete Signal</a>
			@else
				<a class="dropdown-item chart_add_signal" request_id="{{$chart->id}}" new_signal='true' href="javascript:;">Add Signal</a>
			@endif	
        </div>
    </div>

    
    @if($chart->chart_signal)
		<input type="hidden" name="signal_exist" id="signal_exist" value="1">
		<input type="hidden" name="current_signal_value" id="current_signal_value" value="{{$chart->chart_signal->value}}">
	@else
	    <input type="hidden" name="signal_exist" id="signal_exist" value="0">
	@endif	
</div>
<div class="clearfix"></div>
 	<script type="text/javascript">
 	    var result = document.getElementById("socket_data").value;
		var leng   = result.length;
		var pars   = JSON.parse(result);
		var leng        = pars.asset.length;
	    var loop_count  = leng - 1;
		var chart_date = [];
		var chart_price = [];
		for( var i=0; i<=loop_count; i++){
			var time = moment(pars.asset[i].date).format("hh:mm A");
			chart_date.push(time);
			chart_price.push(pars.asset[i].price);
		}
	
		var chart_setting = {
		  	type: 'line',
			data: {
			    labels: chart_date,
			    datasets: [
				    {
				      	label: 'Price',
				      	data: chart_price,
			      		borderWidth: 1,
			      		backgroundColor: "{{$chart->chart_color}}",
						borderColor: "{{$chart->chart_color}}"
			    	}
				]
			},
			options: {
			  	scales: {
			    	yAxes: [{
				        ticks: {reverse: false}
			      	}]
			    }
			}
		};

		var chart = new Chart(document.getElementById("chart_{{$chart->id }}"), chart_setting);
		if(document.getElementById("signal_exist").value == 1){
			updateConfigAsNewObject(chart, document.getElementById("current_signal_value").value);
		}

		function updateConfigAsNewObject(chart, value) {
		    chart.options = {
			  	responsive: true,
				scales: {
			    	yAxes: [{
				        ticks: {reverse: false}
			      	}]
			    },
				annotation: {
					drawTime: 'afterDatasetsDraw',
			      	annotations: [{
			      		id: 'chart_{{$chart->id }}', 
				        type: 'line',
				        mode: 'horizontal',
				        scaleID: 'y-axis-0',
				        value: value,
				        borderColor: 'grey',
				        borderWidth: 1,
				        label: {
				          enabled: true,
				          content: 'Signal'
				        }
				    }]
			    }
			  }
		    chart.update();
		}

		//draw line code start
	/*
		var lineCoordinates = {};
		var parentOffset = $('#chart_{{$chart->id }}').offset();
		console.log(parentOffset);
		$(document).on('mousedown', '#chart_{{$chart->id }}', function(e){
			lineCoordinates.x1 = e.clientX - parentOffset.left;
			lineCoordinates.y1 = e.clientY - parentOffset.top;
			console.log(lineCoordinates); 
		})
		$(document).on('mouseup', '#chart_{{$chart->id }}', function(e){
			lineCoordinates.x2 = e.clientX - parentOffset.left;
			lineCoordinates.y2 = e.clientY - parentOffset.top;
			console.log(lineCoordinates);
			drawLine(chart, lineCoordinates);
		})
	*/
	/*	$('content_div #chart_{{$chart->id }}').on({
			mousedown: function(e) {
			    lineCoordinates.x1 = e.clientX - parentOffset.left;
			    lineCoordinates.y1 = e.clientY - parentOffset.top;    
			},
			mouseup: function(e) {
			    lineCoordinates.x2 = e.clientX - parentOffset.left;
			    lineCoordinates.y2 = e.clientY - parentOffset.top;
			    drawLine(chart, lineCoordinates);
			}
		});
	*/
	
	/*
		function drawLine(lineCoordinates) {
		    var ctx = chart.ctx;
		    ctx.beginPath();
		    ctx.strokeStyle = "#000"; //Change Line Color
		    ctx.lineWidth = 2; //Change Line Width/Thickness
		    ctx.moveTo(lineCoordinates.x1,lineCoordinates.y1);
		    ctx.lineTo(lineCoordinates.x2,lineCoordinates.y2);
		    ctx.stroke();
		}
	*/
	
	/*************************************************/
</script>