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
 	    var result     = document.getElementById("socket_data").value;
		var leng       = result.length;
		var pars       = JSON.parse(result);
		var chart_date = [];
		var dataPoints = [];
		for( var i=0; i<=80; i++){
			var date_data = pars.asset[i].date;
			var price_data = pars.asset[i].price;
			chart_date.push(date_data);
			dataPoints.push({
					o:pars.asset[i].open,
					h:pars.asset[i].max,
					l:pars.asset[i].min,
					c:pars.asset[i].close,
					t:date_data,
			});
		}

		/*var candleCount = 60;
		var data = getRandomData('April 01 2017', candleCount);
		console.log(data);
		var xTicks = data.map(function (x) {
		  return x.t;
		});

		var oneDay = (1000 * 60 * 60 * 24);
		xTicks.unshift(xTicks[0] - oneDay);
		xTicks.push(xTicks[xTicks.length - 1] + oneDay);*/
		/*var ctx = document.getElementById("chart_{{$chart->id }}").getContext("2d");
		new Chart(ctx, {
		  type: 'candlestick',
		  data: {
		    labels: chart_date,
		    datasets: [{
		      label: "Track Price",
		      data: dataPoints,
		    }]
		  },
		});*/
		var chart_setting = {
		  	type: 'candlestick',
			data: {
			    labels: chart_date,
			    datasets: [{
			      	label: "Track Price",
			      	data: dataPoints,
			      	backgroundColor: "{{$chart->chart_color}}",
					borderColor: "{{$chart->chart_color}}"
			    }]
			},
		  	options: {
		  		responsive: true
		  	}
		};
		var chart = new Chart(document.getElementById("chart_{{$chart->id }}"), chart_setting);

		if(document.getElementById("signal_exist").value == 1){
			updateConfigAsNewObject(chart, document.getElementById("current_signal_value").value);
		}

		function updateConfigAsNewObject(chart, value) {
		    chart.options = {
			  	responsive: true,
				annotation: {
					drawTime: 'afterDatasetsDraw',
			      	annotations: [{
			      		id: 'chart_{{$chart->id }}', 
				        type: 'line',
				        mode: 'horizontal',
				        scaleID: 'y-axis-0',
				        value: value,
				        borderColor: 'red',
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

		/*function randomNumber(min, max) {
			return Math.random() * (max - min) + min;
		}

		function getRandomBarNoTime(lastClose) {
			var open = randomNumber(lastClose * .95, lastClose * 1.05);
			var close = randomNumber(open * .95, open * 1.05);
			var high = randomNumber(Math.max(open, close), Math.max(open, close) * 1.1);
			var low = randomNumber(Math.min(open, close) * .9, Math.min(open, close));
			return {
				o: open,
				h: high,
				l: low,
				c: close,
			};
		}

		function randomBar(date, lastClose) {
			var bar = getRandomBarNoTime(lastClose);
			bar.t = date.valueOf();
			return bar;
		}

		function getRandomData(date, count) {
			var dateFormat = 'MMMM DD YYYY';
			var date = moment(date, dateFormat);
			var data = [randomBar(date, 30)];
			while (data.length < count) {
				date = date.clone().add(1, 'd');
				if (date.isoWeekday() <= 5) {
					data.push(randomBar(date, data[data.length - 1].c));
				}
			}
			return data;
		}*/
	
		/*var chart_setting = {
		  	type: 'line',
			data: {
			    labels: chart_date,
			    datasets: [
				    {
				      	label: 'Price',
				      	data: chart_price,
			      		borderWidth: 1
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
		};*/

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
	/*************************************************/
</script>