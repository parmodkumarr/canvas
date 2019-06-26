
<div class="panel-heading">
	<div style="padding:15px;">
		<a class="btn btn-default btn-sm" href="javascript:;" title="Zoom-In" onclick='chartOperationOnButton({{$chart->uniquename}}, {{$chart->id }}, "{{$chart->chart_type}}", "zoomin")'>
			<i class="fa fa-search-plus" aria-hidden="true"></i>
		</a>
		<a class="btn btn-default btn-sm" href="javascript:;" title="Zoom-Out" onclick='chartOperationOnButton({{$chart->uniquename}}, {{$chart->id }}, "{{$chart->chart_type}}", "zoomout")'>
			<i class="fa fa-search-minus" aria-hidden="true"></i>
		</a> 
		<a class="btn btn-outline-dark btn-sm chart_top_button" chart_id="{{$chart->id}}" href="javascript:;">RTA</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" chart_id="{{$chart->id}}" href="javascript:;">AD</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" chart_id="{{$chart->id}}" id="{{$chart->id}}_chart_add_line" href="javascript:;" title="Add-Line">AL</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" chart_id="{{$chart->id}}" href="javascript:;" id="{{$chart->id}}_add_comment" title="Add-Comment" >AC</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" title="Add Signal Below" chart_id="{{$chart->id}}" id="{{$chart->id}}_add_signal_below" href="javascript:;">SB</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" title="Add Signal Above" chart_id="{{$chart->id}}" id="{{$chart->id}}_add_signal_above" href="javascript:;">SA</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" chart_id="{{$chart->id}}" href="javascript:;">RTA</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" title="Show Signal Below" id="{{$chart->id}}_show_sig_belo" chart_id="{{$chart->id}}" href="javascript:;">SSB</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" title="Show Signal Above" id="{{$chart->id}}_show_sig_abov" chart_id="{{$chart->id}}" href="javascript:;">SSA</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" chart_id="{{$chart->id}}" id="{{$chart->id}}_show_comment" href="javascript:;" title="Show Comment">SC</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button show_line" id="{{$chart->id}}_show_line" chart_id="{{$chart->id}}" href="javascript:;" title="Show Line">SL</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" chart_id="{{$chart->id}}" href="javascript:;">SOP</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" id="mychart_{{$chart->id}}_cross_mode1" chart_id="{{$chart->id}}" href="javascript:;" title="Cross-Mode 1">CM1</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" id="mychart_{{$chart->id}}_cross_mode2" chart_id="{{$chart->id}}" href="javascript:;" title="Cross-Mode 2">CM2</a>
		<a class="btn btn-outline-dark btn-sm chart_top_button" id="{{$chart->id}}_activity_delete" chart_id="{{$chart->id}}" title="Delete" href="javascript:;">D</a>
		<a class="btn btn-default btn-sm" href="javascript:;" title="Scrol-Left" onclick='chartOperationOnButton({{$chart->uniquename}}, {{$chart->id }}, "{{$chart->chart_type}}", "scroolleft")'>
			<i class="fa fa-step-backward" aria-hidden="true"></i>
		</a>
		<a class="btn btn-default btn-sm" href="javascript:;" title="Scrool-Right" onclick='chartOperationOnButton({{$chart->uniquename}}, {{$chart->id }}, "{{$chart->chart_type}}", "scroolright")'>
			<i class="fa fa-step-forward" aria-hidden="true"></i>
		</a>
	</div>		  
</div>
<div class="clearfix"></div> 
<div class="col-md-12">
	<div id="{{$chart->uniquename}}" class="chart_line_draw right_context_menu" style="@if($chart->type == 'M') height: 370px; @else height: 270px; @endif margin: 0px auto;"></div>
	<input type="hidden" name="c_s_d_{{$chart->id}}" id="c_s_d_{{$chart->id}}" value="{{$chart->start_date}}">
	<input type="hidden" name="c_e_d_{{$chart->id}}" id="c_e_d_{{$chart->id}}" value="{{$chart->end_date}}">
	<input type="hidden" name="c_c_id" id="c_c_id" value="{{$chart->id}}">
	<input type="hidden" name="c_c_uname" id="c_c_uname" value="{{$chart->uniquename}}">
	<input type="hidden" name="c_c_zi_{{$chart->id}}" id="c_c_zi_{{$chart->id}}" value="1">
	<input type="hidden" name="c_c_zo_{{$chart->id}}" id="c_c_zo_{{$chart->id}}" value="1">
	@if(count($chart->timeseries) > 0)
		<input type="hidden" name="time_series_{{$chart->id}}" id="time_series_{{$chart->id}}" value="{{$chart->timeseries}}">
	@else
	    <input type="hidden" name="time_series_{{$chart->id}}" id="time_series_{{$chart->id}}" value="0">
	@endif

	@if($chart->chart_mode == 1)
		<input type="hidden" name="data_mode_{{$chart->id}}" id="data_mode_{{$chart->id}}" value="1">
	@else
	    <input type="hidden" name="data_mode_{{$chart->id}}" id="data_mode_{{$chart->id}}" value="2">
	@endif

<input type="hidden" name="eventCount" id="eventCount" value="0">
</div>
<div class="clearfix"></div>

<script type="text/javascript">
//$(document).ready(function(){
 	var current_chart_id = {{$chart->id}};
 	var chart_name = 'mychart_'+{{$chart->id}};
 	var data_mode  = document.getElementById("data_mode_"+current_chart_id).value;
 	var chart_operation_type = document.getElementById("chart_operation_type").value;
 	if(chart_operation_type == ''){
		if(data_mode == 1){
			document.getElementById("c_s_d_"+current_chart_id).value = '2017-12-31T22:44:42.981992Z';//moment().format("YYYY-MM-DDTHH:mm:ss.SSS[Z]"); 
	    	document.getElementById("c_e_d_"+current_chart_id).value = '2018-01-12T16:48:22.971454Z';//moment().subtract(12, 'hours').format("YYYY-MM-DDTHH:mm:ss.SSS[Z]");
		}else{
			document.getElementById("c_s_d_"+current_chart_id).value = moment(document.getElementById("c_s_d_"+current_chart_id).value).toISOString();
			document.getElementById("c_e_d_"+current_chart_id).value = moment(document.getElementById("c_e_d_"+current_chart_id).value).toISOString();
		}
	}else{
		document.getElementById("c_s_d_"+current_chart_id).value = document.getElementById("chart_operation_start").value
		document.getElementById("c_e_d_"+current_chart_id).value = document.getElementById("chart_operation_end").value
	}
 	
	var chart = new CanvasJS.Chart("{{$chart->uniquename}}", {
		animationEnabled: true,
		theme: "light1",
		backgroundColor: "#f1f1f1",
		//exportEnabled: true,
		axisX:{
			valueFormatString: "YYYY-MM-DDTHH:mm:ss.SSS[Z]",
			labelFormatter: function(e) {
				return moment(e.value).toISOString();
			},
			tickLength: 7,
			title: ' ',
			interval: 1,
			intervalType: "day",
			gridColor: "#DCDCDC",
			labelAngle: 50,
			labelMaxWidth: 85,  
			labelWrap: true,
			crosshair: {
				enabled: false,
				snapToDataPoint: true,
				labelFormatter: function(e) {
					return moment(e.value).toISOString();
				}
			}
		},
		axisY: {
			logarithmic: false, //change it to false
			includeZero: false,
			valueFormatString: "0.00",
			gridColor: "#DCDCDC",
			crosshair: {
				enabled: false,
				snapToDataPoint: true,
				labelFormatter: function(e) {
					return formatNumber(e.value, 2, '.', '');
				}
			},
			//maximum: 45,
	        stripLines:[]//signals will be added from here

		},
		axisY2: {
			logarithmic: false, //change it to false
			includeZero: false,
			valueFormatString: "0.00",
			gridColor: "#DCDCDC",
			crosshair: {
				enabled: false,
				snapToDataPoint: true,
				labelFormatter: function(e) {
					return formatNumber(e.value, 2, '.', '');
				}
			},
			//minimum: 10,
			stripLines:[]
		},
		toolTip:{
			animationEnabled: true,
			backgroundColor: "#FFFFFF",
			borderColor: "#000000",
			cornerRadius: 5,
			fontSize: 12,
			contentFormatter: function (e) {

				var test = true;
				var content = " ";
				for (var i = 0; i < e.entries.length; i++) {
					content += "Date : " + "<strong>" + moment(e.entries[i].dataPoint.x).toISOString() + "</strong>";
					content += "<br/>";
					if(e.entries[i].dataPoint.volume != undefined){
						content += "Volume : " + "<strong>" + e.entries[i].dataPoint.volume + "</strong>";
						content += "<br/>";
					}
					if(e.chart.data[i].type == 'candlestick'){
						if(e.entries[i].dataPoint.y[0] != undefined && e.entries[i].dataPoint.y[1] != undefined && e.entries[i].dataPoint.y[2] != undefined && e.entries[i].dataPoint.y[3] != undefined){
							content += "Open : " + "<strong>" + e.entries[i].dataPoint.y[0] + "</strong>";
							content += "<br/>";
							content += "High : " + "<strong>" + e.entries[i].dataPoint.y[1] + "</strong>";
							content += "<br/>";
							content += "Low : " + "<strong>" + e.entries[i].dataPoint.y[2] + "</strong>";
							content += "<br/>";
							content += "Close : " + "<strong>" + e.entries[i].dataPoint.y[3] + "</strong>";
							content += "<br/>";
						}else{
							content += "Value : " + "<strong>" + e.entries[i].dataPoint.y + "</strong>";
							content += "<br/>";
						}
						
					}else{
						content += "Value : " + "<strong>" + e.entries[i].dataPoint.y + "</strong>";
						content += "<br/>";
					}
					
				}
				return content;
			}
		},
		rangeChanged: function (e) {
			console.log(e.chart.container.id);
			var chart_name = e.chart.container.id;
			var chart_id   = e.chart.container.id.split('_')[1];
	  		
  	 		var eventCountElement = document.getElementById("eventCount");
         	eventCountElement.setAttribute("value", parseInt(eventCountElement.getAttribute("value")) + 1);

         	var new_start_date = Math.round(e.axisX[0].viewportMinimum);
         	var new_end_date   = Math.round(e.axisX[0].viewportMaximum);
			new_start_date     = moment(new_start_date).toISOString();
			new_end_date       = moment(new_end_date).toISOString();
			document.getElementById("c_s_d_"+chart_id).value  = new_start_date;
			document.getElementById("c_e_d_"+chart_id).value  = new_end_date;
			console.log(new_start_date);
			console.log(new_end_date);
			if(e.trigger == 'zoom'){
				chartOperationOnButton(chart_name, chart_id, e.chart.type, 'zoomin');
			}else if(e.trigger == 'pan'){
				chartOperationOnButton(chart_name, chart_id, e.chart.type, 'zoomin');
			}else if(e.trigger == 'reset'){
				document.getElementById("chart_drawn").value = 0;
				getChartView();
			}
			
  		
     	},
		data: []
	});

	chart.render();
	// if chart has other time series
	if($('#time_series_'+current_chart_id).val() != 0){
		var time_series_data = document.getElementById("time_series_"+current_chart_id).value;
		time_series_data     = JSON.parse(time_series_data);
		console.log(time_series_data);
		var timeseries_count = time_series_data.length;
		var i = 1;
		for (var key in time_series_data) {
		  	if(time_series_data[key].chart_type == 'area'){
		  		//first get data for the time series
		  		var start_time = moment(document.getElementById("c_s_d_"+current_chart_id).value).toISOString();
				var end_time =moment(document.getElementById("c_e_d_"+current_chart_id).value).toISOString();

		  		let result = getDateForTimeSeries(start_time, end_time, time_series_data[key].param_id, 'area', chart, time_series_data[key], timeseries_count, i);

			}else if(time_series_data[key].chart_type == 'bar'){
				//first get data for the time series
		  		var start_time = moment(document.getElementById("c_s_d_"+current_chart_id).value).toISOString();
				var end_time =moment(document.getElementById("c_e_d_"+current_chart_id).value).toISOString();

		  		let result = getDateForTimeSeries(start_time, end_time, time_series_data[key].param_id, 'bar', chart, time_series_data[key], timeseries_count, i);

			}else if(time_series_data[key].chart_type == 'candle'){
				//first get data for the time series
		  		var start_time = moment(document.getElementById("c_s_d_"+current_chart_id).value).toISOString();
				var end_time =moment(document.getElementById("c_e_d_"+current_chart_id).value).toISOString();

		  		let result = getDateForTimeSeries(start_time, end_time, time_series_data[key].param_id, 'candle', chart, time_series_data[key], timeseries_count, i);

		  	}else if(time_series_data[key].chart_type == 'line'){
		  		//first get data for the time series
		  		var start_time = moment(document.getElementById("c_s_d_"+current_chart_id).value).toISOString();
				var end_time =moment(document.getElementById("c_e_d_"+current_chart_id).value).toISOString();

		  		let result = getDateForTimeSeries(start_time, end_time, time_series_data[key].param_id, 'line', chart, time_series_data[key], timeseries_count, i);
		  	}

		  	i++;
		}
		chart.render();
	} 

	
	$('#'+chart_name).contextMenu( {
		selector: "div",
		items: {
			"fold1": {
				"name": "Add", 
				"items": {
					"fold2": {
						"name": "Object", 
						"items": {
							"fold2-key1": {name: "Line", callback: function() {
											var chart_id = $(this).parent().attr('id').split('_')[1];
											$('#'+chart_id+'_chart_add_line').trigger( "click" );	        	
														}},
							"fold2-key2": {name: "Comment", callback: function() {
											var chart_id = $(this).parent().attr('id').split('_')[1];
											$('#'+chart_id+'_add_comment').trigger( "click" );	        	
														}}					      	
						}
					},
					"fold1-key1": {name: "Data", callback: function() {
													var chart_id = $(this).parent().attr('id').split('_')[1];
													window.location = APP_URL+'/charts/'+chart_id+'/edit';
														}},
					"fold1-key2": {name: "Chart", callback: function() {
															addChartToGroup($('#group_id').val());
														}},
					"fold3": {
						"name": "Signalling", 
						"items": {
							"fold2-key1": {name: "Above", callback: function() {
								var chart_id = $(this).parent().attr('id').split('_')[1];
														//addSignal(chart_id, 1);
														$('#'+chart_id+'_add_signal_above').trigger( "click" );	
														}},
							"fold2-key2": {name: "Below", callback: function() {
								var chart_id = $(this).parent().attr('id').split('_')[1];
															//addSignal(chart_id, 2);
																$('#'+chart_id+'_add_signal_below').trigger( "click" );	
														}}
						}
					}
				}
			},
			"correlate": {
				name: "Correlation Matrix", 
				callback: function() {			      		
					var chart_id = $(this).parent().attr('id').split('_')[1];			      		
					correlationMatrix(chart_id);			        	
				}
			},
			"delete": {
				name: "Delete Chart", 
				callback: function() {
					
					var chart_id = $(this).parent().attr('id').split('_')[1];			      		
					chartdelete(chart_id);
					
				}
			},
			"sep1": "---------",
			"cancel": {
				name: "Cancel", 
				callback: function() {
					return;
				}
			}
		}
	});
	charts.push(chart);
</script>
