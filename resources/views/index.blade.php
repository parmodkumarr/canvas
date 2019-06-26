<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('includes.head')
    <style>
    	.canvas-modal-label{text-align: left; float: left;}
    	/*.canvasjs-chart-tooltip{margin-bottom: 10px; text-align: center;}*/
    	.chart_container_class{background-color: #f1f1f1;}
    </style>
    <script src="{{ asset('public/js/jQuery_v3_3_1.js')}}"></script>
    <script src="{{ asset('public/js/chart.js/moment.js')}}"></script>
    <script src="{{ asset('public/js/chart.js/moment-precise-range.js')}}"></script>
    <script src="{{ asset('public/js/contextmenu/dist/jquery.contextMenu.js')}}"></script>
    <script src="{{ asset('public/js/contextmenu/dist/jquery.ui.position.min.js')}}"></script>
    <link href="{{ asset('public/js/contextmenu/dist/jquery.contextMenu.min.css') }}" rel="stylesheet">
    <script>
    	var APP_URL = {!! json_encode(url('/')) !!}
    	timeSeriesCaptions = []; 
    
		//format decimal number
		function formatNumber(number, decimalsLength, decimalSeparator, thousandSeparator) {
	       var n = number,
	           decimalsLength = isNaN(decimalsLength = Math.abs(decimalsLength)) ? 2 : decimalsLength,
	           decimalSeparator = decimalSeparator == undefined ? "," : decimalSeparator,
	           thousandSeparator = thousandSeparator == undefined ? "." : thousandSeparator,
	           sign = n < 0 ? "-" : "",
	           i = parseInt(n = Math.abs(+n || 0).toFixed(decimalsLength)) + "",
	           j = (j = i.length) > 3 ? j % 3 : 0;

	       return sign +
	           (j ? i.substr(0, j) + thousandSeparator : "") +
	           i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousandSeparator) +
	           (decimalsLength ? decimalSeparator + Math.abs(n - i).toFixed(decimalsLength).slice(2) : "");
		}

		function makeAjaxRequest(method, url, data){
			return $.ajax({
				           	type : method,
				           	url : APP_URL+url,
				           	data : data
							//url: APP_URL+'/charts/getChartSignal/'+chart_id,
				        })
		}
    </script>
</head>
<body>
    <div class="page">
        <!-- Main Navbar-->
        <header class="header">
            @include('includes.header')
        </header>
        <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
            @include('includes.sidebar')
            
            <div class="content-inner">
                @yield('content')
            </div>
        </div>
    </div>
   <!--  <script src="{{ asset('public/js/jquery/jquery.min.js')}}"></script> -->
    <script src="{{ asset('public/js/popper.js/umd/popper.min.js')}}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/js/jquery.cookie/jquery.cookie.js')}}"></script>
    <script src="{{ asset('public/js/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('public/js/jquery-validation/jquery.validate.min.js')}}"></script>
	<script src="{{ asset('public/js/sweetalert.min.js')}}"></script>
	<script src="{{ asset('public/js/canvasjs.min.js')}}"></script>
    <script src="{{ asset('public/js/spectrum.js')}}"></script>
	<script type="text/javascript">
	
		

	    (function(){
		    // do some stuff
		    if($('#chart_drawn').val() == 0){
				setInterval(getChartView, 6000);
		    }
		})();

		function getChartView(){
			var group_id = $('#group_id').val();
			if($('#chart_drawn').val() == 0){
				makeAjaxRequest('GET', '/charts/getCreateChart/'+group_id, '')
				.done(function(response) {
					
				    if (response.status == 'success') {
		            	$('#chart_drawn').val(1);
						$('#content_div').html('');
						$('#content_div').html(response.view);
		            }
				})
				.fail(function(xhr) {
				    console.log('error callback ', xhr);
				});
			}
		}

		function getTimesersiesDataOptions(type, series_no, selected_id){
			var url = 'ws://embeddedSoft.eu:7778';
			var socket = new WebSocket(url);
			var socket_data = ('{ "cmd":"get", "arg":"list", "type":"'+type+'" }\r\n');
			//console.log('request :'+socket_data);
			socket.onopen = function() {
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
						if(data[i].id == selected_id){
							selected = ' selected="selected" ';
						}
						options += '<option value="'+data[i].id+'" '+selected+'>'+data[i].name+'</option>';
					}
				}
				if(options.length > 0){
					$("#data_option"+series_no).html(options);
					$("#data_option"+series_no).val(selected_id);
				}else{
					$("#data_option"+series_no).append('<option value="">Option Unavailable</option>');
				}
			};

			socket.onerror = function(error) {
				console.log("error " + error.message);
			};
		}

		// delete workchart function

		function deleteWorkchart(id, obj){	
		   swal({
		       title: "Are you sure?",
		       text: "You will not be able to recover this data!",
		       type: "warning",
		       showCancelButton: true,
		       confirmButtonClass: "btn-danger",
		       confirmButtonText: "Yes, delete it!",
		       closeOnConfirm: false
		   }).then(function(isConfirm){
		       if (isConfirm.value) {
		          	makeAjaxRequest('GET', '/workcharts/delete/'+id, '')
					.done(function(response) {
					    if(response.status == 'success'){
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The User was deleted successfully.',
	                            type: 'success'
	                        });
						    location.reload();
	                    }else{
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The User could not be deleted.',
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

		function chartdeleteMain(id){
		   swal({
		       title: "Are you sure?",
		       text: "You will not be able to recover this data!",
		       type: "warning",
		       showCancelButton: true,
		       confirmButtonClass: "btn-danger",
		       confirmButtonText: "Yes, delete it!",
		       closeOnConfirm: false
		   }).then(function(isConfirm){
		       if (isConfirm.value) {
		            makeAjaxRequest('GET', '/workcharts/delete/'+id, '')
					.done(function(response) {
					    if(response.status == 'success'){
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The WorkChart was deleted successfully.',
	                            type: 'success'
	                        });
						    window.location.href = "{{ URL::to('workcharts') }}";
	                    }else{
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The WorkChart could not be deleted.',
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

		// delete chart function

		function chartdelete(id){
		   swal({
		       title: "Are you sure?",
		       text: "You will not be able to recover this data!",
		       type: "warning",
		       showCancelButton: true,
		       confirmButtonClass: "btn-danger",
		       confirmButtonText: "Yes, delete it!",
		       closeOnConfirm: false
		   }).then(function(isConfirm){
		       if (isConfirm.value) {
		            makeAjaxRequest('GET', '/charts/delete/'+id, '')
					.done(function(response) {
					    if(response.status == 'success'){
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The Chart was deleted successfully.',
	                            type: 'success'
	                        });
						    location.reload();
	                    }else{
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The Chart could not be deleted.',
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

		function correlationMatrix(id){
			$('#correlation_model').modal('toggle');
			$('.correlation_content').html('<p>Fetching the matrix ...</p>');

			var lineSeries = [];		

			var time_series_data = JSON.parse( document.getElementById("time_series_"+id).value );
			var start_time = moment(document.getElementById("c_s_d_"+id).value).toISOString();
			var end_time =moment(document.getElementById("c_e_d_"+id).value).toISOString();

			for( var ij=0; ij < time_series_data.length; ij++ ){
				lineSeries.push( time_series_data[ij].param_id );
			}
			      
	        var socket = new WebSocket('ws://embeddedSoft.eu:7778');
	        var socket_data = ('{"userId":77777, "msgId":1234567890101112, "cmd":"calc", "arg":"correl", "startDate":"'+start_time+'", "endDate":"'+end_time+'", "id":'+JSON.stringify(lineSeries)+' }\r\n');        
	        socket.onopen = function() {
	            socket.send(socket_data);            
	        };
	                 
	        socket.onmessage = function(event) {
	            var data = JSON.parse( event.data );
	            var result = data.result;
	            var matrix = [];       
	            for( var cnt=0; cnt < result.length; cnt++){
	            	matrix[result[cnt].idA +'-'+ result[cnt].idB] = result[cnt].val;
	            }
	            var matrix_html = '<table><tr><td></td>';

	            lineSeries.forEach( function( item, index){
	            	matrix_html += '<td>'+timeSeriesCaptions[item]+'</td>';
	            } );
	            matrix_html += '</tr>';	            

	            lineSeries.forEach( function( item, index){
	            	matrix_html += '<tr>';
	            	matrix_html += '<td>'+timeSeriesCaptions[item]+'</td>';
	            	lineSeries.forEach( function( item2, index2){
	            		if( matrix[item+'-'+item2] != undefined )
	            			matrix_html += '<td>'+matrix[item+'-'+item2]+'</td>';	
            			else  
            				matrix_html += '<td></td>';          	
	            	} );
	            	matrix_html += '</tr>';
	            } );
	            matrix_html += '</table>';

	            $('.correlation_content').html( matrix_html );
	            
	        };                  
		}

		//delete parent chart and its sub chart function

		function deleteChartParent(id){
		    swal({
		        title: "Are you sure?",
		        text: "Your All Chart Will Be Deleted!",
		        type: "warning",
		        showCancelButton: true,
		        confirmButtonClass: "btn-danger",
		        confirmButtonText: "Yes, delete it!",
		        closeOnConfirm: false
		    }).then(function(isConfirm){
		        if (isConfirm.value) {
		            makeAjaxRequest('GET', '/charts/deleteParent/'+id, '')
					.done(function(response) {
					    if(response.status == 'success'){
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The Charts was deleted successfully.',
	                            type: 'success'
	                        });
						    window.location = APP_URL+"/workcharts";
	                    }else{
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The Charts could not be deleted.',
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

		//delete workchart group

		function deleteWorkchartGroup(id, obj){
		    swal({
		        title: "Are you sure?",
		        text: "You will not be able to recover this data!",
		        type: "warning",
		        showCancelButton: true,
		        confirmButtonClass: "btn-danger",
		        confirmButtonText: "Yes, delete it!",
		        closeOnConfirm: false
		    }).then(function(isConfirm){
		       if (isConfirm.value) {
		            makeAjaxRequest('GET', '/workcharts/delete_group/'+id, '')
					.done(function(response) {
					    if(response.status == 'success'){
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The Group was deleted successfully.',
	                            type: 'success'
	                        });
						    location.reload();
						    //obj.parent().parent().remove();
	                    }else{
	                        swal({
	                            title: 'Deleted!', 
	                            text: 'The Group could not be deleted.',
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

	</script>
  {{--@stack('script-footer')--}}
</body>
</html>
