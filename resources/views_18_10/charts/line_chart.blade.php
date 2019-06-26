<script type="text/javascript">
	//$(window).bind("load", function() {
	if($('#chart_drawn').val() == 1){
		
		var result = document.getElementById("socket_data").value;
		var leng   = result.length;
		var pars   = JSON.parse(result);
		var dataPoints = [];
		for(var i=0; i<=20; i++){
			dataPoints.push({
					    //x:new Date(pars.asset[i].date),
						y:pars.asset[i].price
				});
		}

	/*var chart_setting = {
		  	type: 'line',
		  	data: {
				labels:chart_date,
				datasets: [{ 
					data:chart_price,
					label: "Price Range",
					backgroundColor: "{{$chart->chart_color}}",
					borderColor: "{{$chart->chart_color}}",
					fill: false
			  	}]
		  	},
		  	options: {
		  		responsive: true,
				title: {
			  		display: true,
			  		text: 'This is line chart'
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
				title: {
				  display: true,
				  text: 'This is line chart'
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
		}*/
	/*************************************************/

	
	//console.log(dataPoints);
	var chart = new CanvasJS.Chart("chart_{{$chart->id }}", {
		animationEnabled: true,
		theme: "light2",
		title:{
			text: "Price Change Over Time"
		},
		axisY:{
			includeZero: false
		},
		data: [{        
			type: "line",       
			//dataPoints: dataPoints
			dataPoints: [
				{ y: 450 },
				{ y: 414 },
				{ y: 520 },
				{ y: 460 },
				{ y: 450 },
				{ y: 500 },
				{ y: 480 },
				{ y: 480 },
				{ y: 410 },
				{ y: 500 },
				{ y: 480 },
				{ y: 510 }
			]
		}]
	});
	chart.render();
	var lineCoordinates = {};
	var parentOffset    = $(chart.container).offset();
	$(chart.container).on({
		mousedown: function(e) {
		    lineCoordinates.x1 = e.clientX - parentOffset.left;
		    lineCoordinates.y1 = e.clientY - parentOffset.top;    
		},
		mouseup: function(e) {
		    lineCoordinates.x2 = e.clientX - parentOffset.left;
		    lineCoordinates.y2 = e.clientY - parentOffset.top;
		    drawLineGraph(chart, lineCoordinates);
		}
	});

	function drawLineGraph(chart, lineCoordinates) {
		//alert('Draw Line Function called');
		console.log(lineCoordinates);
	    var ctx = chart.ctx;
	    //console.log(ctx);
	    ctx.beginPath();
	    ctx.strokeStyle = "#000"; //Change Line Color
	    ctx.lineWidth = 2; //Change Line Width/Thickness
	    ctx.moveTo(lineCoordinates.x1,lineCoordinates.y1);
	    ctx.lineTo(lineCoordinates.x2,lineCoordinates.y2);
	    ctx.stroke();
	    //console.log(ctx.error);
	    console.log(ctx);
	}
}
	</script>

<div class="col-md-12">
	<!--<canvas id="chart_{{$chart->id }}">	</canvas>-->
	<div id="chart_{{$chart->id }}" style="height: 300px; width: 100%;"></div>
	<div class="dropdown show" style="text-align: left; float: left; width: 100%;">
        <a class="btn btn-default btn-sm dropdown-toggle" href="#" role="button" 
        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
