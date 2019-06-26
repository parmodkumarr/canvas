<script type="text/javascript">
	  	
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
	
	
	};
		socket.onerror = function(error) {
	console.log("error " + error.message);
	};
</script>