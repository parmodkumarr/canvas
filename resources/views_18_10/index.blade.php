<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('includes.head')
    <style>
    .canvas-modal-label{text-align: left; float: left;}
    </style>
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
    <input type="hidden" name="socket_connected" id="socket_connected" value="0">
    <input type="hidden" name="socket_data" id="socket_data" value="">
    <input type="hidden" name="chart_drawn" id="chart_drawn" value="0">
    <!-- JavaScript files-->
    <!-- <script type="text/javascript" src="{{asset('public/js/jquery-2.1.3.min.js')}}"></script> -->
    <script src="{{ asset('public/js/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('public/js/popper.js/umd/popper.min.js')}}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('public/js/jquery.cookie/jquery.cookie.js')}}"></script>
    <script src="{{ asset('public/js/chart.js/moment.js')}}"></script>
    <script src="{{ asset('public/js/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('public/js/chart.js/Chart.Financial.js')}}"></script>
    <script src="{{ asset('public/js/chart.js/chartjs-plugin-annotation.min.js')}}"></script>
    <script src="{{ asset('public/js/jquery-validation/jquery.validate.min.js')}}"></script>
	<script src="{{ asset('public/js/sweetalert.min.js')}}"></script>
	<script src="{{ asset('public/js/spectrum.js')}}"></script>
	<!--<script src="{{ asset('public/js/canvasjs.min.js')}}"></script>-->
	<!--<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>-->
    
<script type="text/javascript">
	var APP_URL = {!! json_encode(url('/')) !!}
	//initialise color picker for chart
	//var colorpickerInput = $("#chart_color");
	$("#chart_color").spectrum({
	    color: "#ECC",
	    showInput: true,
	    className: "full-spectrum",
	    showInitial: true,
	    showPaletteOnly: true,
	    showPalette: true,
	    showSelectionPalette: true,
	    maxSelectionSize: 10,
	    preferredFormat: "hex",
	    localStorageKey: "spectrum.demo",
	    move: function (color) {},
	    show: function () {},
	    beforeShow: function () {},
	    hide: function () {},
	    change: function() {},
	    palette: [
	        ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
	        ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
	        ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
	        ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
	        ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
	        ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
	        ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
	        ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
	    ]
    });
	$(document).ready(function(){
		//open update chart data model
		$(document).on('click', '.update_chart_data', function(){
	   		$('#myModalNorm').modal('show');
	   		$('#chart_title').val($(this).attr('chart_title'));
	   		$('#chart_type').val($(this).attr('chart_type'));
	   		$('#chart_id').val($(this).attr('request_id'));
	    }); 
	    //submit update chart data model form 
		$(document).on('click', '#submit_chart', function() {
			//alert('thanks for click me');
			var title      = document.getElementById("chart_title").value;
			var id         = document.getElementById("chart_id").value;
			var chart_type = document.getElementById("chart_type").value;
		    $.ajax({
		        type: 'post',
		        url: APP_URL+'/charts/updatechart',
		        data: {'_token': $('input[name=_token]').val(), 'title':title,    'chart_type':chart_type,
		            'id':id
		        },
		        success: function(response) {
		            if (response.status == 'success') {
							location.reload();
		            } else {
						swal({
						   title: 'error!', 
						   text: 'The Chart could not be update.',
						   type: 'error'
						});
		            }
		        },
		    });
		});
		//add signal to chart
		$(document).on('click', '.chart_add_signal', function(){
			$('#add_chart_signal_model').modal('show');
			if($(this).attr('new_signal') == 'false'){
				$('#value').val($(this).attr('value'));
	   			$('#signaling').val($(this).attr('level'));
	   			if($(this).attr('signal_type') == 1){
	   				$('input:radio[name=signal_type]:nth(0)').attr('checked',true);
	   			}else if($(this).attr('signal_type') == 2){
	   				$('input:radio[name=signal_type]:nth(1)').attr('checked',true);
	   			}else{
	   				$('input:radio[name=signal_type]:nth(2)').attr('checked',true);
	   			}
	   			$('#chart_id').val($(this).attr('request_id'));
			}else{
				$('#chart_id').val($(this).attr('request_id'));
			}
		})
		//submit add signal model form 
		$(document).on('click', '#submit_signal', function() {
			//alert('thanks for click me');
			var signaling   = $("#signaling").val();
			var id          = $("#chart_id").val();
			var signal_type = $("input[name='signal_type']:checked").val();
			var value       = $('#value').val();
		    $.ajax({
		        type: 'post',
		        url: APP_URL+'/charts/addsignal',
		        data: {'_token': $('input[name=_token]').val(), 'signal_type':signal_type, 'signaling':signaling, 'id':id, 'value':value},
		        success: function(response) {
		            if (response.status == 'success') {
							location.reload();
		            } else {
						swal({
						   title: 'error!', 
						   text: 'The Chart could not be update.',
						   type: 'error'
						});
		            }
		        },
		    });
		});

		//get select base on change in data group

		$('#data_group').on('change',function(){
			var selectValues = {
				    'red' : 'Red',
				    'blue' : 'Blue',
				    'green' : 'Green',
				    'yellow' : 'Yellow'
				};
			$.each(selectValues, function(key, value) {
			     $('#data_group_option')
			         .append($("<option></option>")
			         .attr("value",key)
			         .text(value));
			});
			$('#data_group_option_div').show();
		})
	});

</script>
<script>
	(function(){
	    // do some stuff
	    if($('#chart_drawn').val() != 1){
	    	setInterval(getChartView, 6000);
	    }
	})();

	function getChartView(){
		//alert($('#chart_drawn').val());
		var workchart_id = $('#workchart_id').val();
		if($('#socket_connected').val() == 1 && $('#chart_drawn').val() == 0){
			if($('#socket_data').val() != ''){
			    $.ajax({
			        type: 'GET',
			        url: APP_URL+'/charts/getCreateChart/'+workchart_id,
			        success: function(response) {
			        	$('#chart_drawn').val(1);
			            if (response.status == 'success') {
							$('#content_div').html('');
							$('#content_div').html(response.view);
			            } else {
							
			            }
			        },
			    });
			}
		}
	}
	
</script>
 <script type="text/javascript">
function deleteWorkchart(id, obj)
{	
   swal({
       title: "Are you sure?",
       text: "Your will not be able to recover this data!",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-danger",
       confirmButtonText: "Yes, delete it!",
       closeOnConfirm: false
   }).then(function(isConfirm){
	   
       if (isConfirm.value) {
           $.ajax({
               url: APP_URL+'/workcharts/delete/'+id,
               type: 'GET',
               success: function(response){
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
               }
           });
       } 
   });
}

function chartdelete(id)
{
   swal({
       title: "Are you sure?",
       text: "Your will not be able to recover this data!",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-danger",
       confirmButtonText: "Yes, delete it!",
       closeOnConfirm: false
   }).then(function(isConfirm){
       if (isConfirm.value) {
           $.ajax({
               url: APP_URL+'/charts/delete/'+id,
               type: 'GET',
               success: function(response){
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
               }
           });
       } 
   });
}

function signaldelete(id)
{
   swal({
       title: "Are you sure?",
       text: "Your will not be able to recover this data!",
       type: "warning",
       showCancelButton: true,
       confirmButtonClass: "btn-danger",
       confirmButtonText: "Yes, delete it!",
       closeOnConfirm: false
   }).then(function(isConfirm){
	   //console.log(isConfirm);
       if (isConfirm.value) {
           $.ajax({
               url: APP_URL+'/charts/deletesignal/'+id,
               type: 'GET',
               success: function(response){
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
               }
           });
       } 
   });
}
</script>
 	
  @stack('script-footer')
</body>
</html>
