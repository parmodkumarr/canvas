<div class="col-md-12">
	<canvas id="chart_{{$chart->id }}">	</canvas>
	<div class="dropdown show" style="text-align: left; float: left; width: 100%;">
        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLinkBar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkBar">
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
	var chart_date = [];
	var chart_price = [];
	for( var i=0; i<=20; i++){
		var date_data = pars.asset[i].date;
		var price_data = pars.asset[i].price;
		var obj_data = {};
		obj_data.date = date_data;
		obj_data.price = price_data;
		chart_date.push(obj_data['date']);
		chart_price.push(obj_data['price']);
	}

	var chart_setting = {
			type: 'bar',
			data: {
			  labels: chart_date,
			  datasets: [
				{
				  label: "Price Range",
				  //backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
				  backgroundColor: "{{$chart->chart_color}}",
				  data:chart_price
				}
			  ]
			},
			options: {
			  legend: { display: false },
			  title: {
				display: true,
				text: 'This is bar chart'
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
				  text: 'This is bar chart'
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