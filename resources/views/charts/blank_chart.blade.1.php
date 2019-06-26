<div class="col-md-12">
	<div id="new_chart" class="chart_line_draw right_context_menu" style=" width:100%;height: 370px; margin: 0px auto;">&nbsp;</div>
	<input type="hidden" name="eventCount" id="eventCount" value="0">
</div>
<div class="clearfix"></div>
<script type="text/javascript">
	var chart_id = @$group_id;
	    $('#new_chart').contextMenu( {
			selector: "div",
			items: {
			    "add": {
	                name: "Add Chart", 
			      	callback: function() {		      		
			      		addChartMain(chart_id);
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
	

</script>
