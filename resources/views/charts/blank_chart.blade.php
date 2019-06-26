<div class="clearfix"></div>
<div class="col-md-12" id="new_chart12">
	<div  class="chart_line_draw right_context_menu" style=" width:100%;height: 370px; margin: 0px auto;"></div>
	<input type="hidden" name="eventCount" id="eventCount" value="0">	
</div>
<div class="clearfix"></div>
<script type="text/javascript">
$(document).ready(function(){
	var chart_id = {{$group_id}};
	    $('#new_chart12').contextMenu( {
			selector: "div",
			items: {
			    "add": {
	                name: "Add Chart", 
			      	callback: function() {		      		
			      		window.location.href = "{{ URL::to('charts/' . $group_id . '/create') }}";
			      	}
	            },
			    "delete": {
			      	name: "Delete Workchart", 
			      	callback: function() {	      		
			      		chartdeleteMain(chart_id);	
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
});

</script>
