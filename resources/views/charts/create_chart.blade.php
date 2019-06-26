<script>
 
	
	//get time series data based on there param id
	function getDateForTimeSeries(chart_start_date, chart_end_date, param_id, chart_type, instance, timeseries, timeseries_count, current_series){
		var url = 'ws://embeddedSoft.eu:7778';
		var socket = new WebSocket(url);
		var screen_width = $( '.chart_line_draw' ).width();;
		var screen_height = screen.width;
		
		var request_data = ('{ "cmd":"get","arg":"data", "type":"asset", "startDate":"'+chart_start_date+'", "endDate":"'+chart_end_date+'", "duration":"9999999999999999", "resolution":"'+screen_width+'", "param": { "id":"'+param_id+'" } }\r\n');
		
		console.log('request data : '+request_data);
		socket.onopen = function() {
			socket.send(request_data);
			console.log("connect to "+url+" is success.");
		};

		socket.onclose = function(event) {
			if (event.wasClean) {
				console.log('connect closed');
			} else {
				console.log('connect died');
				var chart_data  = [];
				if(chart_start_date < chart_end_date){
					var diffrence_years   = chart_end_date.diff(chart_start_date, 'years');
					var diffrence_months  = chart_end_date.diff(chart_start_date, 'months');
					var diffrence_days    = chart_end_date.diff(chart_start_date, 'days');
					var diffrence_hours   = chart_end_date.diff(chart_start_date, 'hours');
					var diffrence_minutes = chart_end_date.diff(chart_start_date, 'minutes');
					var diffrence_seconds = chart_end_date.diff(chart_start_date, 'seconds');
					var diffrence_milis   = chart_end_date.diff(chart_start_date, 'milliseconds');
					for(var i=0; i<=10000; i++){
						if(diffrence_years >= 1){
							duration = moment.duration({years: i});
						}else{
							if(diffrence_months >= 1){
								duration = moment.duration({months: i});
							}else{
								if(diffrence_days >= 1){
									duration = moment.duration({days: i});
								}else{
									if(diffrence_hours != 0 && diffrence_hours >= 1){
										duration = moment.duration({hours: i});
			  						}else{
			  							if(diffrence_minutes != 0 && diffrence_minutes >= 30){
			  								duration = moment.duration({minutes: i});
			  							}else{
			  								if(diffrence_seconds != 0 && diffrence_seconds >= 1){
			  									duration = moment.duration({seconds: i});
				  							}else{
				  								if(diffrence_milis != 0 && diffrence_milis >= 30){
			  										duration = moment.duration({milliseconds: i});
					  							}else{
					  								duration = moment.duration({milliseconds: i});
					  							}
				  							}
			  							}
			  					    }
			  					}
							}
						}
						var new_time = moment(chart_start_date, 'YYYY-MM-DDTHH:mm:ss.SSS[Z]').add(duration).format("YYYY-MM-DDTHH:mm:ss.SSS[Z]");
						if(new_time < chart_end_date){
							if(chart_type == 'candle'){
								chart_data.push({ x: new Date(new_time), y: [null, null, null, null] });
							}else{
								chart_data.push({ x: new Date(new_time), y: null });
							}
						}
					}
				}

				alert('Connection Died');

			}
			console.log('code: ' + event.code + ' reason: ' + event.reason);
		};
	     
		socket.onmessage = function(event) {
			console.log(event.data);
			if (socket.readyState === WebSocket.OPEN) {
		      	socket.close();
		    }
			//prepare the data for chart start
			var result           = event.data;
			var pars             = JSON.parse(result);
			var leng             = pars.asset.length;
			var loop_count       = leng - 1;
			var price_data       = [];
			var chart_data       = [];
			var min_step_array   = [];
			var dummy_yaxis_data = [];
			if(leng > 0){
				for(var i=0; i<=loop_count; i++){
					var time = new Date(pars.asset[i].date);
					min_step_array.push(pars.asset[i].date);
					if(chart_type == 'candle'){
						chart_data.push({ x: time, y: [pars.asset[i].open, pars.asset[i].max, pars.asset[i].min, pars.asset[i].close], volume: pars.asset[i].volume });
					}else{
						chart_data.push({ x: time, y: pars.asset[i].price, volume: pars.asset[i].volume });
					}
					dummy_yaxis_data.push({y: pars.asset[i].price });
					price_data.push(pars.asset[i].price);
				}
				
				if(loop_count > 0){
					var time = pars.asset[0].date;
					var dummy_time = time;
					if(chart_start_date < time){
						if(chart_type == 'candle'){
							chart_data.unshift({ x: new Date(chart_start_date), y: [null, null, null, null] });
						}else{
							chart_data.unshift({ x: new Date(chart_start_date), y: null });
						}
					}
				}
				
				if(loop_count > 0){
					if(pars.asset[loop_count-1].date != undefined && chart_end_date > pars.asset[loop_count-1].date){
						var start_time = pars.asset[loop_count-1].date;
						if(chart_type == 'candle'){
							chart_data.push({ x: new Date(chart_end_date), y: [null, null, null, null] });
						}else{
							chart_data.push({ x: new Date(chart_end_date), y: null });
						}
					}
				}
			}else{
				var startDate = moment(chart_start_date, "YYYY-MM-DDTHH:mm:ss.SSS[Z]");
				var endDate   = moment(chart_end_date, "YYYY-MM-DDTHH:mm:ss.SSS[Z]");
					
				var diffrence_years   = endDate.diff(startDate, 'years');
				var diffrence_months  = endDate.diff(startDate, 'months', true);
				var diffrence_days    = endDate.diff(startDate, 'days');
				var diffrence_hours   = endDate.diff(startDate, 'hours');
				var diffrence_minutes = endDate.diff(startDate, 'minutes');
				var diffrence_seconds = endDate.diff(startDate, 'seconds');
				var diffrence_milis   = endDate.diff(startDate, 'milliseconds');
				//console.log(diffrence_days);
				
				
				if(chart_start_date < chart_end_date){
					var dummy_time = chart_start_date;
					for(var i=0; i<=10000; i++){
						if(diffrence_years >= 1){
							duration = moment.duration({years: i});
						}else{
							if(diffrence_months >= 1){
								duration = moment.duration({months: i});
							}else{
								if(diffrence_days >= 1){
									duration = moment.duration({days: i});
								}else{
									if(diffrence_hours != 0 && diffrence_hours >= 1){
										duration = moment.duration({hours: i});
			  						}else{
			  							if(diffrence_minutes != 0 && diffrence_minutes >= 30){
			  								duration = moment.duration({minutes: i});
			  							}else{
			  								if(diffrence_seconds != 0 && diffrence_seconds >= 1){
			  									duration = moment.duration({seconds: i});
				  							}else{
				  								if(diffrence_milis != 0 && diffrence_milis >= 30){
			  										duration = moment.duration({milliseconds: i});
					  							}else{
					  								duration = moment.duration({milliseconds: i});
					  							}
				  							}
			  							}
			  					    }
			  					}
							}
						}

						var new_time = moment(dummy_time, 'YYYY-MM-DDTHH:mm:ss.SSS[Z]').add(duration).format("YYYY-MM-DDTHH:mm:ss.SSS[Z]");
						
						if(new_time >= chart_end_date){
							break;
						}
						
						if(new_time > chart_start_date){
							
							if(chart_type == 'candle'){
								chart_data.push({ x: new Date(new_time), y: [null, null, null, null] });
							}else{
								chart_data.push({x: new Date(new_time), y: null });
							}
							dummy_time = new_time;
						}
					}
				}
							
				if(chart_type == 'candle'){
					chart_data.push({ x: new Date(chart_end_date), y: [null, null, null, null] });
					chart_data.unshift({ x: new Date(chart_start_date), y: [null, null, null, null] });
				}else{					
					chart_data.push({x: new Date(chart_end_date), y: null });
					chart_data.unshift({x: new Date(chart_start_date), y: null });
				}
				
			}

			if(chart_type == 'area'){
				
                instance.options.data.push({
                    dataPoints:chart_data,
                    type: 'area',
                    id: 'timeseries'+timeseries.id,
                    showInLegend : true,
                    legendText : timeSeriesCaptions[param_id],
                    charttypename: 'area',
                    color: timeseries.color
                });
			  	
			  	
			}else if(chart_type == 'bar'){
			  	
                instance.options.data.push({
                    dataPoints:chart_data,
                    type: 'column',
                    id: 'timeseries'+timeseries.id,
                    showInLegend : true,
                    legendText : timeSeriesCaptions[param_id],
                    charttypename: 'bar',
                    color: timeseries.color
                });
			  	
			  	
			}else if(chart_type == 'candle'){
				
			  	
                instance.options.data.push({
                    type: 'candlestick',
                    dataPoints: chart_data,
                    id: 'timeseries'+timeseries.id,
                    showInLegend : true,
                    legendText : timeSeriesCaptions[param_id],
                    charttypename: 'candle'
                });
			  	
			  	
		  	}else if(chart_type == 'line'){
		  		
			  	
                instance.options.data.push({
                    dataPoints:chart_data,
                    showInLegend : true,
                    legendText : timeSeriesCaptions[param_id],
                    type: 'line',
                    lineColor: timeseries.color
                });
			  	
			  	
			  	
		  	}
            
            instance.render();
		  	
            var startDate = moment(chart_start_date, "YYYY-MM-DDTHH:mm:ss.SSS[Z]");
            var endDate   = moment(chart_end_date, "YYYY-MM-DDTHH:mm:ss.SSS[Z]");

            var diffrence_years   = endDate.diff(startDate, 'years');
            var diffrence_months  = endDate.diff(startDate, 'months', true);
            var diffrence_days    = endDate.diff(startDate, 'days');
            var diffrence_hours   = endDate.diff(startDate, 'hours');
            var diffrence_minutes = endDate.diff(startDate, 'minutes');
            var diffrence_seconds = endDate.diff(startDate, 'seconds');
            var diffrence_milis   = endDate.diff(startDate, 'milliseconds');
			
			if(diffrence_years > 1){
				if(diffrence_years > 10 && diffrence_years < 30){
					instance.options.axisX.interval = 3;
					instance.options.axisX.intervalType = 'year';
				}else if(diffrence_years > 30){
					instance.options.axisX.interval = 5;
					instance.options.axisX.intervalType = 'year';
				}else{
					instance.options.axisX.interval = 1;
					instance.options.axisX.intervalType = 'year';
				}
			}else if(diffrence_months > 1){
				if(diffrence_months > 10 && diffrence_months < 30){
					instance.options.axisX.interval = 3;
					instance.options.axisX.intervalType = 'month';
				}else if(diffrence_months > 30){
					instance.options.axisX.interval = 5;
					instance.options.axisX.intervalType = 'month';
				}else{
					instance.options.axisX.interval = 1;
					instance.options.axisX.intervalType = 'month';
				}
			}else if(diffrence_days > 1){
				if(diffrence_days > 10 && diffrence_days < 30){
					instance.options.axisX.interval = 3;
					instance.options.axisX.intervalType = 'day';
				}else if(diffrence_days > 30){
					instance.options.axisX.interval = 5;
					instance.options.axisX.intervalType = 'day';
				}else{
					instance.options.axisX.interval = 1;
					instance.options.axisX.intervalType = 'day';
				}
			}else if(diffrence_hours > 1){
				if(diffrence_hours > 10 && diffrence_hours < 30){
					instance.options.axisX.interval = 3;
					instance.options.axisX.intervalType = 'hour';
				}else if(diffrence_hours > 30){
					instance.options.axisX.interval = 5;
					instance.options.axisX.intervalType = 'hour';
				}else{
					instance.options.axisX.interval = 1;
					instance.options.axisX.intervalType = 'hour';
				}
			}else if(diffrence_minutes > 1){
				if(diffrence_minutes > 10 && diffrence_minutes < 30){
					instance.options.axisX.interval = 3;
					instance.options.axisX.intervalType = 'minute';
				}else if(diffrence_minutes > 30){
					instance.options.axisX.interval = 5;
					instance.options.axisX.intervalType = 'minute';
				}else{
					instance.options.axisX.interval = 1;
					instance.options.axisX.intervalType = 'minute';
				}
			}else if(diffrence_seconds > 1){
				if(diffrence_seconds > 10 && diffrence_seconds < 30){
					instance.options.axisX.interval = 3;
					instance.options.axisX.intervalType = 'second';
				}else if(diffrence_seconds > 30){
					instance.options.axisX.interval = 5;
					instance.options.axisX.intervalType = 'second';
				}else{
					instance.options.axisX.interval = 1;
					instance.options.axisX.intervalType = 'second';
				}
			}

			if(price_data.length > 0){
				var y_max = Math.max.apply(null, price_data);
				
				var y_min = Math.min.apply(null, price_data);
				var y_secondMin = Math.min.apply(null, price_data.filter(n => n != y_min));
				var y_diffrence = y_secondMin - y_min;
                //add tick on max value for y axis
                instance.options.axisY.stripLines.push({
                    value: price_data[0],
                    label: price_data[0],
                    labelPlacement: "outside",
                    thickness: 0,
                    labelBackgroundColor:"black",
                    labelFontColor: "white",
                    nametype: 'outtickleft'
                });
                instance.options.axisY2.stripLines.push({
                    value: price_data[price_data.length - 1],
                    label: price_data[price_data.length - 1],
                    labelPlacement: "outside",
                    thickness: 0,
                    labelBackgroundColor:"black",
                    labelFontColor: "white",
                    nametype: 'outtickright'
                });
				
			}
			

			instance.options.axisX.minimum = new Date(chart_start_date);
	        instance.options.axisX.maximum = new Date(chart_end_date);
	        instance.render();
	        
            if( leng > 0 ){
                var chartid = instance.container.id.split('_')[1];
                if(chartsActivity[chartid] != undefined){
                    operationAfterCheckTopButton(chartid, chartsActivity[chartid]);
                }
            }
	        
		};

		socket.onerror = function(error) {
			console.log("error " + error.message);
		};
	}

	function operationAfterCheckTopButton(chart_id, options){
        console.log(options);
		if(options.length > 0 && chart_id != ''){
            chartsActivity[chart_id] = [];
			options.forEach(function(option) {	
				if(option == 'SL'){
					let l = document.getElementById(chart_id+'_show_line');
					l.click();
				}else if(option == 'SC'){
					let l = document.getElementById(chart_id+'_show_comment');
					l.click();
				}else if(option == 'SSA'){
					let l = document.getElementById(chart_id+'_show_sig_abov');
					l.click();
				}else if(option == 'SSB'){
					let l = document.getElementById(chart_id+'_show_sig_belo');
					l.click();
				}else if(option == 'CM1'){
					let l = document.getElementById('mychart_'+chart_id+'_cross_mode1');
					l.click();
				}else if(option == 'CM2'){
					let l = document.getElementById('mychart_'+chart_id+'_cross_mode2');
					l.click();
				}
			});
            
		}
	}
    //save chart as image
	function saveChartImage(chart_id, ext){
		if(charts.length > 0){
            charts.forEach(function(instance) {
            	if(instance.container.id == 'mychart_'+chart_id){
            		//instance.exportChart({format: ext});
            		/*instance.exportChart({
             			format: String (“jpg” | “png”),
             			toDataURL: Boolean (default false),
             			fileName: String
         			});*/ 
            	}
            })
        }
    }
    function getAssetBoxData(type = 'asset' ){
        var series_no = 1;
        var url = 'ws://embeddedSoft.eu:7778';
        var socket = new WebSocket(url);
        var socket_data = ('{ "cmd":"get", "arg":"list", "type":"'+type+'" }\r\n');        
        socket.onopen = function() {
            socket.send(socket_data);            
        };
                 
        socket.onmessage = function(event) {
            var result = event.data;
            
            var pars   = JSON.parse(result);
            switch(type){
                case 'asset':
                    var data   = pars.instrument;
                    break;
                case 'indicator':
                    var data   = pars.indicator;
                    break;
                case 'userIndicator':
                    var data   = pars.userIndicator;
                    break;
                case 'userAlgo':
                    var data   = pars.userAlgo;
                    break;    
            }
            var leng   = data.length;
            var options = '';
            var selected = '';
            
            if(leng > 0){
                for(var i=0; i <= leng -1; i++){                    
                    timeSeriesCaptions[data[i].id] = data[i].name;
                }
            }             
        };
    }
    getAssetBoxData('asset');
    getAssetBoxData('indicator');
    getAssetBoxData('userIndicator');
    getAssetBoxData('userAlgo');
</script>

@if(count($charts) > 0)
	@foreach ($charts as $chart)
			<div class="chart_container_class" style="background-color: #ffffff; padding-bottom: 5px;">
				<div style="background-color: #f1f1f1;">
					@include('charts.all_one_chart',['chart' => $chart])
				</div> 
			</div>
	@endforeach
@else
<div class="chart_container_class" style="background-color: #ffffff; padding-bottom: 5px;">
	<div style="background-color: #f1f1f1;">
		@include('charts.blank_chart',['group_id' => $group_id])
	</div> 
</div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<!-- will be used to show any error from Validator -->
@if($errors->count())
  <div class="alert alert-warning" role="alert">{{ Html::ul($errors->all()) }}</div>
@endif
	
<!-- Modal add signal to chart-->
<div class="modal fade" id="add_chart_signal_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            	<h5 class="modal-title" id="exampleModalLabel">Add/Update Signal</h5>
                <button type="button" class="close closesignalmodel" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
            </div>          
            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<!--Modal add chart in group chart -->
<div class="modal fade" id="add_chart_group_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            	<h5 class="modal-title" id="exampleModalLabel">Add Chart</h5>
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
            </div>          
            <!-- Modal Body -->
            <div class="modal-body"> 
				<div class="form-group">
					<label for="title" class="form-control-label canvas-modal-label">Title:</label>
					<input type="text" class="form-control" name="group_chart_title" id="group_chart_title" value="" placeholder="Chart Title" required />
				</div>
				<div class="form-group">
					<label for="title" class="form-control-label canvas-modal-label">Type:</label>
					<select class="form-control" name="group_chart_type" id="group_chart_type" required>
					  	<option value="S">Sub</option>
					</select>
				</div>
				<div class="form-group">
					<label for="title" class="form-control-label canvas-modal-label">Mode:</label>
					<select class="form-control" name="group_chart_mode" id="group_chart_mode" required>
					  	<option value="">Select Mode</option>
					  	<option value="1">Real Time</option>
					  	<option value="2">Historical</option>
					</select>
				</div>
				<div class="form-group group_chart_mode_div" style="display:none;">
					<label for="title" class="form-control-label canvas-modal-label">Start Date:</label>
					<input type="text" class="form-control" name="group_chart_start_date" id="group_chart_start_date" value="" placeholder="Select Start Date" required />
				</div>
				<div class="form-group group_chart_mode_div" style="display:none;">
					<label for="title" class="form-control-label canvas-modal-label">End Date:</label>
					<input type="text" class="form-control" name="group_chart_end_date" id="group_chart_end_date" value="" placeholder="Select End Datee" required />
				</div>
				<input type="hidden" name="group_id" id="group_id" value="">
				<div class="modal-footer">
					<button type="button" id="submit_chart_group" class="btn btn-primary text-right" data-dismiss="modal">Submit</button>	
				   <button type="button" class="btn btn-danger text-right" data-dismiss="modal">Cancel</button>
				</div>
            </div>
        </div>
    </div>
</div>

<!-- The comment model -->
<div class="modal" id="correlation_model">
	<div class="modal-dialog">
	  <div class="modal-content">    
		<!-- Modal Header -->
		<div class="modal-header">
		  <h4 class="modal-title">Correlation Matrix</h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<!-- Modal body -->
		<div class="modal-body">
			<div class="form-group correlation_content">				
			</div>
		</div>		
	  </div>
	</div>
</div>
<!-- The comment model -->
<div class="modal" id="comment_model">
	<div class="modal-dialog">
	  <div class="modal-content">    
		<!-- Modal Header -->
		<div class="modal-header">
		  <h4 class="modal-title">Add comment</h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<!-- Modal body -->
		<div class="modal-body">
			<div class="form-group">
				<label style="text-align: left; width: 100%;">Add Comment</label>
				<textarea class="form-control" rows="2" placeholder="Enter Text.." name="comnt_text" id="comnt_text" value=""></textarea>
				<input type="hidden" name="comment_chart_id" id="comment_chart_id" value="">
			</div>
		</div>
		<!-- Modal footer -->
		<div class="modal-footer">
			<button class="btn btn-sm btn-primary" id="save_chart_comment">Submit</button>
			<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
		</div>
	  </div>
	</div>
</div>	
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('change', '#group_chart_mode', function(){
			var current_mode = $(this).val();
			if(current_mode == 2){
				$('.group_chart_mode_div').show();
			}
		});

	    $('#group_chart_start_date').datetimepicker({format: 'yyyy-mm-dd hh:mm:ss'}).on('changeDate', function (e) {         
		});

		$('#group_chart_end_date').datetimepicker({format: 'yyyy-mm-dd hh:mm:ss'}).on('changeDate', function (e) {
			var endDate = $("#group_chart_end_date").val();
	        var startDate = $("#start_date").val();
	        if(startDate == ''){
	        	$("#group_chart_start_date").addClass('has-error');
	        	$("#group_chart_start_date").focus();
	        }else{
		        if(startDate > endDate){
		            //alert('Please select date which is less then starting date');
		            $("#group_chart_end_date").addClass('has-error');
		            $("#group_chart_end_date").val('');
		            $("#group_chart_end_date").focus();
		        }  
	        }         
		});

		$('#submit_chart_group').on('click', function(){
			var title      = $('#group_chart_title').val();
			var type       = $('#group_chart_type').val();
			var mode       = $('#group_chart_mode').val();
			var start_date = $('#group_chart_start_date').val();
			var end_date   = $('#group_chart_end_date').val();
			var group_id   = $('#group_id').val();
			var error      = false;
			if(mode == 2){
				if(start_date == ''){
					$("#group_chart_start_date").addClass('has-error');
	        		$("#group_chart_start_date").focus();
	        		var error      = true;
	        		return false;
				}
				if(end_date == ''){
					$("#group_chart_end_date").addClass('has-error');
		            $("#group_chart_end_date").focus();
		            var error      = true;
		            return false;
				}
			}
			if(error == false){
				$.ajax({
			        type: 'POST',
			        data: {'group_id' : group_id, 'end_date' : end_date, 'start_date' : start_date, 'chart_mode' : mode, 'type' : type, 'title' : title, "_token": "{{ csrf_token() }}"},
			        url: APP_URL+'/charts/saveGroupChart',
			        success: function(response) {
			           	if(response.status == 'success'){
			           		$('#group_chart_title').val('');
							//$('#group_chart_type').val();
							$('#group_chart_mode').val('');
							$('#group_chart_start_date').val('');
							$('#group_chart_end_date').val('');
							$('#group_id').val('');
	                       	swal({
	                           	title: 'Added!', 
	                           	text: 'The Chart added to group successfully.',
	                           	type: 'success'
	                       	});
						    location.reload();
	                   	}else{
	                       	swal({
	                           	title: 'Failed!', 
	                           	text: 'The Chart could not be added.',
	                           	type: 'error'
	                       	});
	                   	}
			        },
			    });
			}
		})
	})

	$('#content_div a.chart_top_button').on('click', function(e){
		var cur_obj  = $(this);
		var c_s_b    = cur_obj.text();
		var chart_id = cur_obj.attr('chart_id');
		if(chartsActivity[chart_id] == undefined){
			chartsActivity[chart_id] = [];
		}
		
        if(c_s_b == 'AL')
        {
			if( !($.inArray('SL', chartsActivity[chart_id]) >= 0) ){
				chartsActivity[chart_id].push('SL');
			}
            if($('#'+chart_id+'_add_comment').hasClass( "active" )){
                $('#'+chart_id+'_add_comment').removeClass("active");
            }
            showChartLineFromDB(chart_id);
            $('#'+chart_id+'_show_line').addClass("active");
            cur_obj.addClass("active");
       
        }
        else if(c_s_b == 'AC'){
            if($('#'+chart_id+'_chart_add_line').hasClass( "active" )){
                $('#'+chart_id+'_chart_add_line').removeClass("active");
			}
			if( !($.inArray('SC', chartsActivity[chart_id]) >= 0) ){
            	chartsActivity[chart_id].push('SC');
            }
            showComments(chart_id);
            cur_obj.addClass("active");
            $('#'+chart_id+'_show_comment').addClass("active");
        }
        else if(c_s_b == 'SB'){
			if( !($.inArray('SSB', chartsActivity[chart_id])  >= 0) ){
                chartsActivity[chart_id].push('SSB');
            }
            showSignalAboveBelow(chart_id, 2);
            $('#'+chart_id+'_show_sig_belo').addClass("active");
            addSignal(chart_id, 2);
            cur_obj.addClass("active");
        }else if(c_s_b == 'SA'){
			if( !($.inArray('SSA', chartsActivity[chart_id])  >= 0) ){
                chartsActivity[chart_id].push('SSA');
            }
            showSignalAboveBelow(chart_id, 1);
            $('#'+chart_id+'_show_sig_abov').addClass("active");
            addSignal(chart_id, 1);
            cur_obj.addClass("active");	
        }
        else if(c_s_b == 'AD'){
            window.location = APP_URL+'/charts/'+chart_id+'/edit';
        }
        else if(c_s_b == 'SL'){
            if( cur_obj.hasClass( "active" ) ){
                hideChartMouseLine(chart_id);
				cur_obj.removeClass("active");
				chartsActivity[chart_id].splice( chartsActivity[chart_id].indexOf('SL'),1 );
            }else{
                if( !($.inArray('SL', chartsActivity[chart_id])  >= 0) ){
                    chartsActivity[chart_id].push('SL');
                }
                showChartLineFromDB(chart_id);
                cur_obj.addClass("active");
            }
        }
        else if(c_s_b == 'SC'){
            if( cur_obj.hasClass( "active" ) ){
                hideChartComment(chart_id);
				cur_obj.removeClass("active");
				chartsActivity[chart_id].splice( chartsActivity[chart_id].indexOf('SC'),1 );
            }else{
                if( !($.inArray('SC', chartsActivity[chart_id])  >= 0) ){
                chartsActivity[chart_id].push('SC');
                }
                showComments(chart_id);
                cur_obj.addClass("active");
            }
        }
        else if(c_s_b == 'SSB'){
            if( cur_obj.hasClass( "active" ) ){
                hideSignalLine(chart_id, 2);
				cur_obj.removeClass("active");
				chartsActivity[chart_id].splice( chartsActivity[chart_id].indexOf('SSB'),1 );
            }else{
                if( !($.inArray('SSB', chartsActivity[chart_id])  >= 0) ){
                chartsActivity[chart_id].push('SSB');
                }
                showSignalAboveBelow(chart_id, 2);
                cur_obj.addClass("active");
            }
        }
        else if(c_s_b == 'SSA'){
            if( cur_obj.hasClass( "active" ) ){
                hideSignalLine(chart_id, 1);
				cur_obj.removeClass("active");
				chartsActivity[chart_id].splice( chartsActivity[chart_id].indexOf('SSA'),1 );
            }else{
                if( !($.inArray('SSA', chartsActivity[chart_id])  >= 0) ){
                chartsActivity[chart_id].push('SSA');
                }
                showSignalAboveBelow(chart_id, 1);
                cur_obj.addClass("active");
            }
        }
        else if(c_s_b == 'CM1'){
            if($('#mychart_'+chart_id+'_cross_mode1').hasClass( "active" )){
                disableCrossMode(chart_id, 1);
				cur_obj.removeClass("active");	
				if( ($.inArray('CM1', chartsActivity[chart_id])  >= 0) ){
					chartsActivity[chart_id].splice( chartsActivity[chart_id].indexOf('CM1'),1 );
				}
            }else{
                if($('#mychart_'+chart_id+'_cross_mode2').hasClass( "active" )){
                    disableCrossMode(chart_id, 2);
					$('#mychart_'+chart_id+'_cross_mode2').removeClass("active");	
					chartsActivity[chart_id].splice( chartsActivity[chart_id].indexOf('CM2'),1 );
                }
                if( !($.inArray('CM1', chartsActivity[chart_id])  >= 0) ){
                chartsActivity[chart_id].push('CM1');
                }
                showCrossMode(chart_id, 1);
                cur_obj.addClass("active");
            }
        }
        else if(c_s_b == 'CM2'){
            if($('#mychart_'+chart_id+'_cross_mode2').hasClass( "active" )){
                disableCrossMode(chart_id, 2);
				cur_obj.removeClass("active");	
				if( ($.inArray('CM2', chartsActivity[chart_id])  >= 0) ){
					chartsActivity[chart_id].splice( chartsActivity[chart_id].indexOf('CM2'),1 );
				}
            }
            else{
                if($('#mychart_'+chart_id+'_cross_mode1').hasClass( "active" )){
                    disableCrossMode(chart_id, 1);
					$('#mychart_'+chart_id+'_cross_mode1').removeClass("active");	
					chartsActivity[chart_id].splice( chartsActivity[chart_id].indexOf('CM1'),1 );
                }
                if( !($.inArray('CM2', chartsActivity[chart_id])  >= 0) ){
                chartsActivity[chart_id].push('CM2'); 
                }
                showCrossMode(chart_id, 2);
                cur_obj.addClass("active");
            }
        }
        else if(c_s_b == 'D'){
            if($('#'+chart_id+'_add_comment').hasClass( "active" )){
                $('#'+chart_id+'_add_comment').removeClass("active");
            }
            if($('#'+chart_id+'_chart_add_line').hasClass( "active" )){
                $('#'+chart_id+'_chart_add_line').removeClass("active");
            }
        }
        
		$(".chart_top_button").each(function( index ) {
			var l_s_b = $(this).text();
			if($(this).hasClass( "active" )){
				if((l_s_b == 'SL' || l_s_b == 'SC' || l_s_b == 'SSA' || l_s_b == 'SSB') && c_s_b == 'D'){
					cur_obj.addClass("active");
				}else if((c_s_b != 'AL' && l_s_b == 'AL') || (c_s_b != 'AC' && l_s_b == 'AC') || (c_s_b != 'SA' && l_s_b == 'SA') || (c_s_b != 'SB' && l_s_b == 'SB')){
					$(this).removeClass("active");
				}
			}
		});
        
    });


	$('#content_div div.chart_line_draw').on('mousedown', function(e){
		var c_c_id = $(this).attr('id');
		var chart_id = c_c_id.split('_')[1];
		if(charts.length > 0){
			charts.forEach(function(instance) {	
				if(instance.container.id == c_c_id){
					var parentOffset = $(instance.container).offset();
					var relX    = e.pageX - parentOffset.left;
					var relY    = e.pageY - parentOffset.top+2;
					var valuex  = Math.round(instance.axisX[0].convertPixelToValue(relX));
					var x_value = new Date(valuex).toISOString();
					var y_value = formatNumber(instance.axisY[0].convertPixelToValue(relY), 2, '.', '');
					
					//empty the comment postion array is any value exist then add new
					chart_comment_pos.length = 0;
					chart_comment_pos.push({ x : x_value, y : y_value }) ;
					//empty the object if any pre vavlue exist
					lineCoordinates = {};
					lineCoordinates.x1 = x_value;
					lineCoordinates.y1 = y_value;
					
					//check if stripline/signal was clicked
					
					for(var j=0; j<=instance.options.axisY.stripLines.length -1; j++){
						let c_s_v = instance.options.axisY.stripLines[j].value;
						if( c_s_v != undefined ){
						
						
							if(c_s_v.toString().indexOf(".")!==-1){
								let l_a_d = c_s_v.toString().split('.')[1].length;
								var s_value = formatNumber(instance.axisY[0].convertPixelToValue(relY), l_a_d, '.', '');
							}else{
								var s_value = Math.round(instance.axisY[0].convertPixelToValue(relY));
							}
						    if(instance.options.axisY.stripLines[j].value== s_value){
						    	if(instance.options.axisY.stripLines[j].nametype == 'above' && $('#'+chart_id+'_activity_delete').hasClass('active') && $('#'+chart_id+'_show_sig_abov').hasClass('active')){
						    		var result = signalLineOperation(chart_id, s_value, instance, j);
						    	}else if(instance.options.axisY.stripLines[j].nametype == 'below' && $('#'+chart_id+'_activity_delete').hasClass('active') && $('#'+chart_id+'_show_sig_belo').hasClass('active')){
						      		var result = signalLineOperation(chart_id, s_value, instance, j);
						      	}
						      	break;
						    }
					    } 
					}
				}
			});
		}
	});

	$('#content_div div.chart_line_draw').on('mouseup', function(e){
		var c_c_id = $(this).attr('id');
		var chart_id = c_c_id.split('_')[1];
		if(charts.length > 0){
			charts.forEach(function(instance) {
				if(instance.container.id == c_c_id){
					//console.log(instance.container.id);
					var parentOffset = $(instance.container).offset();
					var relX    = e.pageX - parentOffset.left;
					var relY    = e.pageY - parentOffset.top;
					var valuex  = Math.round(instance.axisX[0].convertPixelToValue(relX));
					var x_value = new Date(valuex).toISOString();
					var y_value = formatNumber(instance.axisY[0].convertPixelToValue(relY), 2, '.', '');
					lineCoordinates.x2 = x_value;
					lineCoordinates.y2 = y_value;
					// check and save line data if save line button is active
					if($('#'+chart_id+'_chart_add_line').hasClass('active')){
					    saveChartMouseLine(lineCoordinates, chart_id);
					}
					if($('#'+chart_id+'_add_comment').hasClass('active')){
					    openAddCommentModel(chart_id);
					}
				}
			});
		}
		return false;
	});

	// hide lines drawn by mouse when user again click show line button
	function hideChartMouseLine(chart_id){
		if(charts.length > 0){
			charts.forEach(function(instance) {
				if(instance.container.id == 'mychart_'+chart_id){
					console.log(instance.options.data);
					//first remove all line that are on chart
					for(var i =0; i <= instance.options.data.length -1; i++){
						if(instance.options.data[i].id != undefined){
							if(instance.options.data[i].id == 'mouse_line'){
								//instance.options.data.splice(i, 1);
								instance.data[i].remove();
								instance.render();
								--i;
							}
						}
					}
					
        		}
    		})
		}
	}

	// hide chart comment when show comment button is clicked
	function hideChartComment(chart_id){
		if(charts.length > 0){
            charts.forEach(function(instance) {
            	if(instance.container.id == 'mychart_'+chart_id){
            		// remove all comment
            		for(var i = 0; i<= instance.options.data.length -1; i++){
            			if (instance.options.data[i].type !== undefined) {	
            				if(instance.options.data[i].type == 'scatter' && instance.options.data[i].type_name == 'show_comment'){
            					instance.data[i].remove();
            					instance.render();
            				}
            			}
            		}
            	}
            })
        }
	}

	// hide signal when button is clicked again
	function hideSignalLine(chart_id, level){
		if(chart_id != '' && level != ''){
			var name_type = level == 1 ? 'above' : 'below';
			if(charts.length > 0){
				charts.forEach(function(instance) {
					if(instance.container.id == 'mychart_'+chart_id){
						var strip_lines = instance.options.axisY.stripLines;
						for (var i = strip_lines.length - 1; i >= 0; --i) {	
							if(strip_lines[i].nametype != undefined){
								if(strip_lines[i].nametype == name_type){
									strip_lines.splice(i, 1);
									instance.render();
								}
							}
						}
						var strip_lines = instance.options.axisY2.stripLines;
						for (var i = strip_lines.length - 1; i >= 0; --i) {	
							if(strip_lines[i].nametype != undefined){
								if(strip_lines[i].nametype == name_type){
									strip_lines.splice(i, 1);
									instance.render();
								}
							}
						}
					}
				});
			}
		}
	}

	//disable cross mode
	function disableCrossMode(chart_id, type){
		if(charts.length > 0){
			charts.forEach(function(instance) {
				if(instance.container.id == 'mychart_'+chart_id){
					instance.options.axisX.crosshair.enabled = false;
					instance.options.axisY.crosshair.enabled = false;
					instance.options.axisY2.crosshair.enabled = false;
					instance.render();
				}
			})
		}
	}

	//function to save the mouse drawn line
	function saveChartMouseLine(lineCoordinates, chart_id){
		if(chart_id != ''){
			var check1 = moment(lineCoordinates.x1, moment.ISO_8601);
			var check2 = moment(lineCoordinates.x2, moment.ISO_8601);
			var T1 = moment(document.getElementById("c_s_d_"+chart_id).value, moment.ISO_8601);
			var T2 = moment(document.getElementById("c_e_d_"+chart_id).value, moment.ISO_8601);
			
			if(check1.isBetween(T1,T2) && check2.isBetween(T1,T2)){
				var line_data_array = {
			  		dataPoints:[{x: lineCoordinates.x1, y : lineCoordinates.y1},
			  					{x: lineCoordinates.x2, y : lineCoordinates.y2}],
			  		type: 'line',
					Color: '#000000'
			  	}

			    var data = {'line_data' : line_data_array, 'chart_id' : 'mychart_'+chart_id, "_token": "{{ csrf_token() }}"};
				makeAjaxRequest('POST', '/charts/saveChartLine', data)
				.done(function(response) {
				    if(response.status == 'error'){
		        		swal({
		                   title: 'Error!', 
		                   text: 'Some Error occured please try again later.',
		                   type: 'error'
		                });
		        	}else{
		        		if(charts.length > 0){
		    				charts.forEach(function(instance) {
		    					if(instance.container.id == 'mychart_'+chart_id){
									if(response.data.length > 0){
					        			for(var i =0; i <= response.data.length -1; i++){
					        				let line_id = response.data[i].line_id;
					        				var new_line = {
					        						type: 'line',
													color: '#F08080',
													id: 'mouse_line',
													markerSize: 5,
													line_id: line_id,
													chart_id: line_id,
													markerType: 'circle',
					        						dataPoints:[
					        							{x: new Date(response.data[i].dataPoints[0].x), y : parseFloat(response.data[i].dataPoints[0].y), click: mouseLineOperation},
				  										{x: new Date(response.data[i].dataPoints[1].x), y : parseFloat(response.data[i].dataPoints[1].y), click: mouseLineOperation}]
													}
					        				instance.options.data.push(new_line);
					        				instance.render();		
					        			}
					        		}
				        		}
			        		})
		        		}
		        	}
				})
				.fail(function(xhr) {
				    console.log('error callback ', xhr);
				});
			}
		}
	}

	//show chart line saved in database
	function showChartLineFromDB(chart_id){
		if(chart_id > 0){
			makeAjaxRequest('GET', '/charts/getChartLine/'+chart_id, '')
			.done(function(response) {
			    if(response.status == 'success'){
        			if(charts.length > 0){
        				charts.forEach(function(instance) {
        					if(instance.container.id == 'mychart_'+chart_id){
        						for(var i =0; i <= instance.options.data.length -1; i++){
        							if(instance.options.data[i].id != undefined){
	        							if(instance.options.data[i].id == 'mouse_line'){
	        								instance.options.data.splice(i, 1);
	        								instance.render();
	        							}
	        						}
        						}
        						
								if(response.data.length > 0){
				        			for(var i =0; i <= response.data.length -1; i++){
				        				let line_id = response.data[i].line_id;
				        				var new_line = {
				        						type: 'line',
												color: '#F08080',
												id: 'mouse_line',
												markerSize: 5,
												line_id: line_id,
												chart_id: line_id,
												markerType: 'circle',
				        						dataPoints:[
				        							{x: new Date(response.data[i].dataPoints[0].x), y : parseFloat(response.data[i].dataPoints[0].y), click: mouseLineOperation},
			  										{x: new Date(response.data[i].dataPoints[1].x), y : parseFloat(response.data[i].dataPoints[1].y), click: mouseLineOperation}]
												}
				        				instance.options.data.push(new_line);
				        				instance.render();		
				        			}
				        		}
			        		}
		        		})
	        		}
	        	}
			})
			.fail(function(xhr) {
			    console.log('error callback ', xhr);
			});
		}
	}

	//delete mouse drawn line on chart
	function mouseLineOperation(e){
		var line_id  = e.dataSeries.line_id;
		var chart_id = e.chart._containerId.split('_')[1];
		if($('#'+chart_id+'_activity_delete').hasClass('active') && $('#'+chart_id+'_show_line').hasClass('active')){
    		swal({
		       title: "Are you sure?",
		       text: "You will not be able to recover this Line!",
		       type: "warning",
		       showCancelButton: true,
		       confirmButtonClass: "btn-danger",
		       confirmButtonText: "Yes, delete it!",
		       closeOnConfirm: false
		   	}).then(function(isConfirm){
		        if (isConfirm.value) {
		            var data = {'_token' : '{{ csrf_token() }}', 'line_id':line_id};
					makeAjaxRequest('POST', '/charts/delete_line', data)
					.done(function(response) {
					    if(response.status == 'success'){
	                        swal({
	                           title: 'Deleted!', 
	                           text: 'The Line was deleted successfully.',
	                           type: 'success'
	                        });
						    //showChartLineFromDB(chart_id);
						    if(charts.length > 0){
        						charts.forEach(function(instance) {
        							if(instance.container.id == 'mychart_'+chart_id){
					        			// first remove all mouse drawn line from chart
					        			instance.options.data.forEach(function(obj, i){
					        				if(obj.line_id == line_id){
					        					instance.options.data.splice(i, 1);
					        					instance.render();
					        				}
										});
									}
								})
							} 
	                   }else{
	                       swal({
	                           title: 'Deleted!', 
	                           text: 'The Line could not be deleted.',
	                           type: 'error'
	                       });
	                   }
					})
					.fail(function(xhr) {
					    console.log('error callback ', xhr);
					});
		        } 
		    });
    	}
	}

	//open add comment model
	function openAddCommentModel(chart_id){
		showComments(chart_id);
		
		$('#comment_model').modal('toggle');
		$('#comment_chart_id').val(chart_id);
		
	}

	//save chart comment on submit button click
	$(document).on('click', '#save_chart_comment', function(e){
		var text     = document.getElementById("comnt_text").value;
		var chart_id = document.getElementById("comment_chart_id").value;
		var valueX = chart_comment_pos[0].x;
		var valueY = chart_comment_pos[0].y;
		if(text.length > 0){
            var data = {'_token' : '{{ csrf_token() }}', 'text':text, 'valueX':valueX, 'valueY':valueY, 'font_style':'', 'font_color':''};
			makeAjaxRequest('POST', '/charts/add_comment/'+chart_id, data)
			.done(function(response) {
			    if(response.status == 'success'){
                   	$('#comment_model').modal('toggle');
                   	showComments(chart_id);
                   	/*var comment = response.comment;
                   	if(comment != ''){
		                if(charts.length > 0){
			                charts.forEach(function(instance) {
			                	if(instance.container.id == 'mychart_'+chart_id){
			                		instance.options.data.forEach(function(obj, i){
			                			if(obj.type != undefined){
				                			if(obj.type == 'scatter' && obj.type_name == 'show_comment'){
				                				let dasetdata = {x : new Date(comment.xaxis), y : parseFloat(comment.yaxis), indexLabel: comment.comment, indexLabelFontColor: "black", comment_id: comment.id, click:deleteComment};
				                				obj.dataPoints.push(dasetdata);
				                				instance.render();
				                			}
				                		}
			                		});
			                	}
			                })
			            }
			        }*/
                }
			})
			.fail(function(xhr) {
			    console.log('error callback ', xhr);
			});
		}else{
			alert('Please add text for adding the comment.');
		}
	})

	// Show chart comment
	function showComments(chart_id){
		if(chart_id > 0){
		    var comments = [];
	        var data = {'_token' : '{{ csrf_token() }}'};
			makeAjaxRequest('POST', '/charts/get_comments/'+chart_id, data)
			.done(function(response) {
			    if(response.status == 'success'){
                   	var comments = response.comments;
	                var dataset = [];
	                if(comments.length > 0){
		                if(charts.length > 0){
			                charts.forEach(function(instance) {
			                	if(instance.container.id == 'mychart_'+chart_id){
			                		//first remove all comment from chart
			                		/*instance.options.data.forEach(function(obj, i){
			                			if(obj.type != undefined){
				                			if(obj.type == 'scatter' && obj.type_name == 'show_comment'){
				                				//instance.data[i].remove();
				                				instance.options.data.splice(i, 1);
				                				//obj.dataPoints.push(dasetdata);
				                				instance.render();
				                			}
				                		}
			                		});*/
			                		// then add new comment 
			                		for(var j = 0; j <= comments.length - 1; j++){
			                			let dasetdata = {x : new Date(comments[j].xaxis), y : parseFloat(comments[j].yaxis), indexLabel: comments[j].comment, indexLabelFontColor: "black", comment_id: comments[j].id, click:deleteComment};
			                			dataset.push(dasetdata);
			                		}
			                		var new_data = {type: "scatter", color: '#696969', type_name: "show_comment", markerSize: 5, chart_id: chart_id, dataPoints: dataset};
			                		instance.options.data.push(new_data);
			                		instance.render();
			                	}
			                })
			            }
			        }
                }
			})
			.fail(function(xhr) {
			    console.log('error callback ', xhr);
			});
		}
	}

	// delete chart comment
	function deleteComment(e){
		var chart_id = e.dataSeries.chart_id;
		var comment_id = e.dataSeries.dataPoints[e.dataPointIndex].comment_id;
		var xvalue   = new Date(e.dataSeries.dataPoints[e.dataPointIndex].x).toISOString();
		var yvalue   = e.dataSeries.dataPoints[e.dataPointIndex].y;
		var cmnt     = e.dataSeries.dataPoints[e.dataPointIndex].indexLabel;
        if($('#'+chart_id+'_activity_delete').hasClass('active')){
            swal({
		       title: "Are you sure?",
		       text: "You will not be able to recover this Comment!",
		       type: "warning",
		       showCancelButton: true,
		       confirmButtonClass: "btn-danger",
		       confirmButtonText: "Yes, delete it!",
		       closeOnConfirm: false
		   	}).then(function(isConfirm){
		       if (isConfirm.value) {
		            var data = {'_token' : '{{ csrf_token() }}', 'comment_id':comment_id};
					makeAjaxRequest('POST', '/charts/delete_comment', data)
					.done(function(response) {
					    if(response.status == 'success'){
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The comment was deleted successfully.',
	                            type: 'success'
	                        });

	                        // after delete display all other data
	                        var comments = response.comments;
			                if(charts.length > 0){
				                charts.forEach(function(instance) {
				                	if(instance.container.id == 'mychart_'+chart_id){
				                		instance.options.data.forEach(function(obj, i){
				                			if(obj.type != undefined){
					                			if(obj.type == 'scatter' && obj.type_name == 'show_comment'){
					                				obj.dataPoints.splice(e.dataPointIndex, 1);
					                				instance.render();
					                			}
					                		}
				                		});
				                	}
				                })
				                showComments(chart_id);
				            }
	                    }else{
	                        swal({
	                           title: 'Deleted!', 
	                           text: 'The comment could not be deleted.',
	                           type: 'error'
	                        });
	                    }
					})
					.fail(function(xhr) {
					    console.log('error callback ', xhr);
					});
		       } 
		    });
        }
	}

	//delete the signal line operation on click
	function signalLineOperation(chart_id, value, instance, index){
		if(chart_id && value){
    		swal({
		       title: "Are you sure?",
		       text: "You will not be able to recover this Signal!",
		       type: "warning",
		       showCancelButton: true,
		       confirmButtonClass: "btn-danger",
		       confirmButtonText: "Yes, delete it!",
		       closeOnConfirm: false
		   	}).then(function(isConfirm){
		        if (isConfirm.value) {
					var data = {'_token' : '{{ csrf_token() }}', 'chart_id':chart_id, 'value':value};
					makeAjaxRequest('POST', '/charts/delete_signal', data)
					.done(function(response) {
					    if(response.status == 'success'){
	                        swal({
	                           title: 'Deleted!', 
	                           text: 'The Signal was deleted successfully.',
	                           type: 'success'
	                        });

	                        instance.options.axisY.stripLines.splice(index, 1);
	                        instance.options.axisY2.stripLines.splice(index, 1);
				      		instance.render();
	                    }else{
	                        swal({
	                           title: 'Deleted!', 
	                           text: 'The Signal could not be deleted.',
	                           type: 'error'
	                        });
	                   }
					})
					.fail(function(xhr) {
					    console.log('error callback ', xhr);
					});
		        } 
		   	});
    	}
	}

	//show signal line above or below based on condition
	function showSignalAboveBelow(chart_id, level, remove=0){
		if(chart_id != '' && level != ''){
	        makeAjaxRequest('GET', '/charts/getChartSignal/'+chart_id, '')
	        .done(function(response) {
			    if(response.status == 'success'){
                    if(charts.length > 0){
						charts.forEach(function(instance) {
							if(instance.container.id == 'mychart_'+chart_id){
								
								var highest_bound = instance.axisY[0].get('maximum');
								var lowest_bound = instance.axisY[0].get('minimum');
								console.log(highest_bound + '-' + lowest_bound);
								var hasLines = 0;
								if(level == 1){
									if(response.above_count > 0){
										
										for(var i=0; i <= response.above_count -1; i++){	
											hasLines = 1;
											var new_signal = {                
												                value:response.above_data[i].value,
												              	label : response.above_data[i].title,
												                labelFontColor: '#000000',
																color: '#A9A9A9',
																thickness: 3,
																markerType: 'dot',
												              	lineDashType: 'longDash',
												              	labelAlign: 'center',
												              	nametype:'above',
												              	click:function(){alert('signal clciked')}
															 };
															 
											instance.options.axisY.stripLines.push(new_signal);
											instance.options.axisY2.stripLines.push(new_signal);
											if( highest_bound < response.above_data[i].value )
												highest_bound = parseFloat(response.above_data[i].value)+10;

											if( lowest_bound > response.above_data[i].value )
												lowest_bound = parseFloat(response.above_data[i].value)-10;
											
										}
										
										
								    }	
								}
								if(level == 2){
									if(response.below_count > 0){
										for(var i=0; i <= response.below_count -1; i++){
											hasLines = 1;
											var new_signal = {                
												                value: response.below_data[i].value,
												              	label: response.below_data[i].title,
												                labelFontColor: '#000000',
												                thickness: 3,
																color: '#A9A9A9',
																markerType: 'dot',
												              	lineDashType: 'longDash',
												              	labelAlign: 'center',
												              	nametype:'below',
												              	click:function(){alert('signal clciked')}
															};
											instance.options.axisY.stripLines.push(new_signal);
											instance.options.axisY2.stripLines.push(new_signal);
											if( highest_bound < response.below_data[i].value )
												highest_bound = parseFloat(response.below_data[i].value)+10;

											if( lowest_bound > response.below_data[i].value )
												lowest_bound = parseFloat(response.below_data[i].value)-10;
										    
										}
									}
								}
								if( hasLines == 1){
									console.log(highest_bound + '-' + lowest_bound);
									instance.options.axisY.maximum = highest_bound;
									instance.options.axisY2.maximum = highest_bound;
									instance.options.axisY.minimum = lowest_bound;
									instance.options.axisY2.minimum = lowest_bound;
									instance.render();
								}
							}
						});
					}
               	}else{
               		swal({
	                   title: 'Error!', 
	                   text: 'Some internal error occured please try again latter.',
	                   type: 'error'
	                });
					return false;
               	} 
			})
			.fail(function(xhr) {
			    console.log('error callback ', xhr);
			});
		}
	}

	//submit add signal model form 
	$(document).on('click', '#submit_signal', function() {
		var signaling   = $("#signaling").val();
		var id          = $("#chart_id").val();
		var signal_type = new Array();
		$(".signal_type:checked").each(function(i){
		    signal_type.push($(this).attr("value"));
		});
		var value  = $('#value').val();
		if (signaling == "" || signal_type == "" || id == "" || value == "") {
			alert('All field must be filled/selected.');
			return false;
		}else{
			var data = {'_token': $('input[name=_token]').val(), 'signal_type':signal_type, 'signaling':signaling, 'id':id, 'value':value};
			
			makeAjaxRequest('POST', '/charts/addsignal', data)
		    .done(function(response) {
			    if (response.status == 'success') {
					$('.modal').modal('hide');
					$("body").removeClass('modal-open');
					$(".modal-backdrop").fadeOut( "slow" );
					showSignalAboveBelow(id,signaling);
				} else {
					swal({
					   title: 'error!', 
					   text: 'The Signal could not be update.',
					   type: 'error'
					});
				} 
			})
			.fail(function(xhr) {
			    console.log('error callback ', xhr);
			});
		}
	});
 
	// function to call add update signal from
	function addSignal(chart_id, level){
		if(chart_comment_pos.length > 0){
			var current_value = chart_comment_pos[0].y;
		}else{
			var current_value = 0;
		}
		if(chart_id != '' && level != ''){
		    makeAjaxRequest('GET', '/charts/getSignalForm/'+chart_id+'/'+level+'/'+current_value, '')
		    .done(function(response) {
			    if (response.status == 'success') {
	            	$('#add_chart_signal_model .modal-body').html(response.view);
	            	$('#add_chart_signal_model').modal('show');
	            } 
			})
			.fail(function(xhr) {
			    console.log('error callback ', xhr);
			});
		}
	}

	//show chart cross hair
	function showCrossMode(chart_id, type){
		if(charts.length > 0){
			charts.forEach(function(instance) {
				if(instance.container.id == 'mychart_'+chart_id){
					instance.options.axisX.crosshair.enabled = true;
					instance.options.axisY.crosshair.enabled = true;
					instance.options.axisY2.crosshair.enabled = true;
					if(type == 2){
						instance.options.axisX.crosshair.snapToDataPoint = false;
						instance.options.axisY.crosshair.snapToDataPoint = false;
						instance.options.axisY2.crosshair.snapToDataPoint = false;
					}else{
						instance.options.axisX.crosshair.snapToDataPoint = true;
						instance.options.axisY.crosshair.snapToDataPoint = true;
						instance.options.axisY2.crosshair.snapToDataPoint = true;
					}
					
					instance.render();
				}
			})
		}
	}

	//open model to add chart to group
	function addChartToGroup(group_id){
		$('#add_chart_group_model').modal('show');
		$('#group_id').val(group_id);
	}

	function chartOperationOnButton(chart_name, chart_id, chart_type, operation_type){
		
		var new_date_time = []; 
		if(operation_type == 'zoomin'){
			new_date_time = intZoomIn(chart_id);
			document.getElementById("chart_operation_type").value = 'zoomin';
		}else if(operation_type == 'zoomout'){
			new_date_time = intZoomOut(chart_id);
			document.getElementById("chart_operation_type").value = 'zoomout';
		}else{
			new_date_time = createNewTimeRangeForOperation(chart_id, operation_type);
			document.getElementById("chart_operation_type").value = 'panning';
		}
		if(new_date_time['new_end'] != undefined && new_date_time['new_start'] != undefined){
			charts.length = 0;
			document.getElementById("chart_drawn").value = 0;
			document.getElementById("chart_operation_start").value = new_date_time['new_start'];
			document.getElementById("chart_operation_end").value   = new_date_time['new_end'];
			getChartView();
		}
	}
	
	function intZoomIn(chart_id){
		var current_start_dt = document.getElementById("c_s_d_"+chart_id).value;
		var get_start_micro = current_start_dt.split( '.' );
		var startTimeInt = new Date(get_start_micro[0]+'Z').getTime();
		
		var current_end_dt   = document.getElementById("c_e_d_"+chart_id).value;
		var get_end_micro    = current_end_dt.split( '.' );
		var endTimeInt       = new Date(get_end_micro[0]+'Z').getTime();
		
		var uStartTimeInt = get_start_micro[1].slice(0, -1);// get micro second for end time
		var uEndTimeInt = get_end_micro[1].slice(0, -1);// get micro second for end time

		var mid = (endTimeInt - startTimeInt)/2;
		
	    if ( mid == 0 ) { // then operationg in microseconds
	        var umid = ( uEndTimeInt - uStartTimeInt ) / 2;
	        if ( umid != 0 ){ 
	            var result   = prepareNewRangeZoomIn ( uStartTimeInt, uEndTimeInt, chart_id, 'micro');

	            result['new_start'] = get_start_micro[0]+'.'+result['new_start']+'Z';
        		result['new_end']   = get_end_micro[0]+'.'+result['new_end']+'Z';

        		document.getElementById("c_s_d_"+chart_id).value  = result['new_start'];
				document.getElementById("c_e_d_"+chart_id).value  = result['new_end'];
	        	return result;
	        }
	    } else  { // then operationg in seconds
	        var result = prepareNewRangeZoomIn ( startTimeInt, endTimeInt, chart_id, 'date');
	        var new_start_date = result['new_start'];
            var new_end_date   = result['new_end'];

            var new_get_start_micro = new_start_date.split( '.' );
            var new_get_end_micro = new_end_date.split( '.' );
			result['new_start'] = new_get_start_micro[0]+'.'+get_start_micro[1];
        	result['new_end']   = new_get_end_micro[0]+'.'+get_end_micro[1];
        	document.getElementById("c_s_d_"+chart_id).value  = result['new_start'];
			document.getElementById("c_e_d_"+chart_id).value  = result['new_end'];
	        	
	        return result;
	    }

	}

	function prepareNewRangeZoomIn( startTimeInt, endTimeInt, chart_id, $type ){
		var rangeMid = (endTimeInt - startTimeInt)/2;
		var mid      = endTimeInt - rangeMid;
		var newBegin = mid - (rangeMid/2);
        var newEnd   = mid + (rangeMid/2);
        var return_array = [];
        if($type == 'date'){
        	return_array['new_start'] = new Date(newBegin).toISOString();
        	return_array['new_end']   = new Date(newEnd).toISOString();
        }else{
        	return_array['new_start'] = Math.round(newBegin);
        	return_array['new_end']   = Math.round(newEnd);
        }

        document.getElementById("c_s_d_"+chart_id).value  = return_array['new_start'];
		document.getElementById("c_e_d_"+chart_id).value  = return_array['new_end'];
		return return_array;
	}

	function intZoomOut(chart_id){
		var current_start_dt = document.getElementById("c_s_d_"+chart_id).value;
		var get_start_micro = current_start_dt.split( '.' );
		var startTimeInt = new Date(get_start_micro[0]+'Z').getTime();
		
		var current_end_dt   = document.getElementById("c_e_d_"+chart_id).value;
		var get_end_micro    = current_end_dt.split( '.' );
		var endTimeInt       = new Date(get_end_micro[0]+'Z').getTime();
		
		var uStartTimeInt = get_start_micro[1].slice(0, -1);// get micro second for end time
		var uEndTimeInt = get_end_micro[1].slice(0, -1);// get micro second for end time

		var mid = (endTimeInt - startTimeInt);
	    if ( mid == 0 ) { // then operating in microseconds (1/1 000 000 [s])
	    	//console.log('comming to microsecond loop');
	        if ( (uStartTimeInt <= 0) && (uEndTimeInt >= 999999) )    { // then edges reached.
                console.log(endTimeInt);
                var newEnd   = endTimeInt + 1;
                console.log(newEnd);
                var newBegin = startTimeInt - 1;

                var result = [];
                var generate_new_start = new Date(newBegin).toISOString();
                var generate_new_end   = new Date(newEnd).toISOString();
                var get_start_micro_new = generate_new_start.split( '.' );
                var get_end_micro_new   = generate_new_end.split( '.' );
        		result['new_start'] = get_start_micro_new[0]+'.000001Z';
        		result['new_end']   = get_end_micro_new[0]+'.999998Z';
        		document.getElementById("c_s_d_"+chart_id).value  = result['new_start'];
				document.getElementById("c_e_d_"+chart_id).value  = result['new_end'];

				return result;
            } else  {
            	var result = prepareNewRangeZoomOut ( uStartTimeInt, uEndTimeInt, chart_id, 'micro' );
            	var uStartTimeIntNew = result['new_start'];
            	var uEndTimeIntNew   = result['new_end'];
            	
            	if ( uStartTimeIntNew < 0 )
                    uStartTimeIntNew = 0;

                if ( uEndTimeIntNew > 999999 )
                    uEndTimeIntNew = 999999;

	            result['new_start'] = get_start_micro[0]+'.'+uStartTimeIntNew+'Z';
        		result['new_end']   = get_end_micro[0]+'.'+uEndTimeIntNew+'Z';

        		document.getElementById("c_s_d_"+chart_id).value  = result['new_start'];
				document.getElementById("c_e_d_"+chart_id).value  = result['new_end'];

	        	return result;
	        } 
	    } else  { // operating on seconds
	        var result = prepareNewRangeZoomOut ( startTimeInt, endTimeInt, chart_id, 'date');
	        var new_start_date = result['new_start'];
            var new_end_date   = result['new_end'];

            var new_get_start_micro = new_start_date.split( '.' );
            var new_get_end_micro = new_end_date.split( '.' );
			result['new_start'] = new_get_start_micro[0]+'.'+get_start_micro[1];
        	result['new_end']   = new_get_end_micro[0]+'.'+get_end_micro[1];
        	document.getElementById("c_s_d_"+chart_id).value  = result['new_start'];
			document.getElementById("c_e_d_"+chart_id).value  = result['new_end'];
	        	
	        return result;
	    }
	}

	function prepareNewRangeZoomOut( startTimeInt, endTimeInt, chart_id, $type ){
		var rangeMid = (endTimeInt - startTimeInt)/4;
		if ( rangeMid <= 0 )
        	rangeMid = 1;

        var newBegin = startTimeInt - rangeMid;
    	var newEnd   = endTimeInt + rangeMid;
		
        var return_array = [];
        if($type == 'date'){
        	return_array['new_start'] = new Date(newBegin).toISOString();
        	return_array['new_end']   = new Date(newEnd).toISOString();
        }else{
        	return_array['new_start'] = Math.round(newBegin);
        	return_array['new_end']   = Math.round(newEnd);
        }
        
        document.getElementById("c_s_d_"+chart_id).value  = return_array['new_start'];
		document.getElementById("c_e_d_"+chart_id).value  = return_array['new_end'];
		return return_array;
	}

	function getMicroTime(start_dt, end_dt){
		$.ajax({
            type:'POST',
            url: APP_URL+'/charts/getMicroTimeDate',
            data: {'_token':'{{ csrf_token() }}', 'start_dt':start_dt, 'end_dt':end_dt},
            success:function(response){
              	if(response.status == 'success'){
              		return response.data;
              	}
            }
        });
	}

	function createNewTimeRangeForOperation(chart_id, operation){
		var current_start_dt = document.getElementById("c_s_d_"+chart_id).value;
		var start_time_stamp = new Date(current_start_dt).getTime();

		var current_end_dt   = document.getElementById("c_e_d_"+chart_id).value;
		var end_time_stamp   = new Date(current_end_dt).getTime();
		
		var rangeMid = (end_time_stamp - start_time_stamp)/2;
		
		var mid      = end_time_stamp - rangeMid;
		
		var newBegin = mid - (rangeMid/2);
        var newEnd   = mid + (rangeMid/2);

        newBegin = new Date(newBegin).toISOString();
        newEnd   = new Date(newEnd).toISOString();
		
		var mid_range_mili = parseInt((rangeMid % 1000) / 100),
   			mid_range_sec  = parseInt((rangeMid / 1000) % 60),
    		mid_range_min  = parseInt((rangeMid / (1000 * 60)) % 60),
    		mid_range_hour = parseInt((rangeMid / (1000 * 60 * 60)) % 24);

    		mid_range_hour = (mid_range_hour < 10) ? "0" + mid_range_hour : mid_range_hour;
  			mid_range_min  = (mid_range_min < 10) ? "0" + mid_range_min : mid_range_min;
            mid_range_sec  = (mid_range_sec < 10) ? "0" + mid_range_sec : mid_range_sec;	
			
		var duration = moment.duration({hours:mid_range_hour, minutes: mid_range_min, seconds:mid_range_sec, milliseconds:mid_range_mili});
			
		var return_array       = [];
		if(operation == 'scroolleft'){
			return_array['new_start'] = moment(current_start_dt, 'YYYY-MM-DDTHH:mm:ss.SSS[Z]').subtract(duration).format("YYYY-MM-DDTHH:mm:ss.SSS[Z]");
       
        	return_array['new_end'] = moment(current_end_dt, 'YYYY-MM-DDTHH:mm:ss.SSS[Z]').subtract(duration).format("YYYY-MM-DDTHH:mm:ss.SSS[Z]");
        
        	document.getElementById("c_s_d_"+chart_id).value  = return_array['new_start'];
			document.getElementById("c_e_d_"+chart_id).value  = return_array['new_end'];
		}else if(operation == 'scroolright'){
			return_array['new_start'] = moment(current_start_dt, 'YYYY-MM-DDTHH:mm:ss.SSS[Z]').add(duration).format("YYYY-MM-DDTHH:mm:ss.SSS[Z]");
       
        	return_array['new_end']   = moment(current_end_dt, 'YYYY-MM-DDTHH:mm:ss.SSS[Z]').add(duration).format("YYYY-MM-DDTHH:mm:ss.SSS[Z]");
        
        	document.getElementById("c_s_d_"+chart_id).value  = return_array['new_start'];
			document.getElementById("c_e_d_"+chart_id).value  = return_array['new_end'];
		}
		return return_array;
	}


</script>