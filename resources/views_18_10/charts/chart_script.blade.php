<div class="col-md-12">
	<canvas id="chart_">	
	</canvas>
	<div calss="col-md-12">
		<a class="btn btn-default" onclick="" href="javascript:;" style="margin:5px;">Delete</a>
		<button class="btn btn-primary" data-toggle="modal" data-target="#myModalNorm">Change</button>											
	</div>
</div>
 	<script type="text/javascript">
	//var chartype='';
	//console.log(chartype);
	// works
	var url = 'ws://embeddedSoft.eu:7778';

	var socket = new WebSocket(url);
	// var connection = new WebSocket('ws://echo.websocket.org');

	var socket_data = ('{ "cmd":"get","arg":"data", "type":"asset", "startDate":"2018-01-03 00:00:00:0", "endDate":"2018-01-03 23:59:59:99999", "duration":"9999999999999999", "resolution":"999", "param": { "id":"10783" } }\r\n');

	socket.onopen = function() {
	socket.send(socket_data);
	console.log("connect to "+url+" is success.");
	};

	socket.onclose = function(event) {
	if (event.wasClean) {
	console.log('connect closed');
	} else {
	console.log('connect died'); // Ð½Ð°Ð¿Ñ€Ð¸Ð¼ÐµÑ€, "ÑƒÐ±Ð¸Ñ‚" Ð¿Ñ€Ð¾Ñ†ÐµÑÑ ÑÐµÑ€Ð²ÐµÑ€Ð°
	}
	console.log('code: ' + event.code + ' reason: ' + event.reason);
	};
     
	socket.onmessage = function(event) {
	var result = event.data;
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
	
	// graph code start from here
	
	// line chart code start
	new Chart(document.getElementById("{{$chart->id }}"), {
	  type: 'line',
	  data: {
		labels:chart_date,
		datasets: [{ 
			data:chart_price,
			label: "Price Range",
			borderColor: "#3e95cd",
			fill: false
		  }
		]
	  },
	  options: {
		title: {
		  display: true,
		  text: 'This is line chart'
		}
	  }
	});	
	
	//draw line
	
	
	
	

	// end
	
	// line chart code end
	
	// bar chart code start
	new Chart(document.getElementById("{{$chart->id }}"), {
		type: 'bar',
		data: {
		  labels: chart_date,
		  datasets: [
			{
			  label: "Price Range",
			  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
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
	});	
	// bar chart code end
	
	// pie chart code start
	
	new Chart(document.getElementById("{{$chart->id }}"), {
		type: 'pie',
		data: {
		  labels: chart_date,
		  datasets: [{
			label: "Price Range",
			backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
			data:chart_price
		  }]
		},
		options: {
		  title: {
			display: true,
			text: 'This is pie chart'
		  }
		}
	});	
	
	// pie chart code end
		 
	};

	socket.onerror = function(error) {
	console.log("error " + error.message);
	};
	
	/*************************************************/
	</script>