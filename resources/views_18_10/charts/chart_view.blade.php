@extends('index')

@section('sidebar')

@endsection

@section('content')
<script type="text/javascript">
    var api_data = '';
	// works
	var url = 'ws://embeddedSoft.eu:7778';
	var socket = new WebSocket(url);
	//var connection = new WebSocket('ws://echo.websocket.org');
	var socket_data = ('{ "cmd":"get","arg":"data", "type":"asset", "startDate":"2018-01-03T00:00:00.0Z", "endDate":"2018-01-03T23:59:59.99999Z", "duration":"9999999999999999", "resolution":"100", "param": { "id":"10783" } }\r\n');
	//Getting data of stock|indicator|userIndicator|userAlgo:
	// 'endDate' or 'duration' is needed
	/*var socket_data = ('{"cmd":"get","arg":"data","type":"stock",   "startDate":"2018-01-03T00:00:00.0Z","endDate":"2018-01-03T23:59:59.99999Z",    "duration":"99999999","resolution":"100","param":{"id":"10783" } }\r\n');*/
	/*User selects one of data;: asset, user indicator, indicator, user algo.
	Id of above types of data are feacheable by "get list" json command:*/
	//"type":"asset|indicator|userIndicator|userAlgo"
	//var socket_data = ('{"cmd":"get","arg":"list","type":"indicator"}');

	socket.onopen = function() {
		document.getElementById("socket_connected").value = 1;
		socket.send(socket_data);
		console.log("connect to "+url+" is success.");
	};

	socket.onclose = function(event) {
		if (event.wasClean) {
			console.log('connect closed');
		} else {
			console.log('connect died');
		}
		console.log('code: ' + event.code + ' reason: ' + event.reason);
	};
     
	socket.onmessage = function(event) {
		api_data = event.data;
		document.getElementById("socket_data").value = api_data;
		console.log(api_data);
	};

	socket.onerror = function(error) {
		console.log("error " + error.message);
	};
	
	/*************************************************/
	</script>
	<header class="page-header">
	    <div class="container-fluid">
	        <h2 class="no-margin-bottom">Charts</h2>
	    </div>
	</header>
	<section class="dashboard-counts no-padding-bottom">	
		<div class="container-fluid">			
			<div class="bg-white has-shadow">
				<div class="row">
				<input type="hidden" name="workchart_id" id="workchart_id" value="{{$workchart_id}}">
					<div id="content_div" style="float: left; width: 100%; text-align: center;">
						<img class="text-center img-fluid" src="{{ asset('img/loading.gif') }}" alt="loading chart">
						<p>Loading....</p>
					</div>			
				</div>
			</div>
		</div>
	</section>
@endsection

