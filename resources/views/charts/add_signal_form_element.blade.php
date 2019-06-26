{{ Form::open(array('files' => true, 'id' => 'add_signal_form')) }}
	<div class="form-group">
		<label for="type" class="form-control-label canvas-modal-label">Signaling:</label>
		<select name="signaling" id="signaling" class="form-control"  required>
			<option value="">Choose an option</option>
			<option value="1" @if($level == 1) selected @endif>Above</option>
			<option value="2" @if($level == 2) selected @endif>Below</option>
		</select>
	</div>
	<div class="form-group">
		<label for="title" class="form-control-label canvas-modal-label">Value:</label>
		<input type="text" class="form-control" name="value" id="value" value="{{$value}}" placeholder="Signal Value" required />
		<input type="hidden" name="id" id="chart_id" value="{{$chart_id}}">	
	</div>
	<div class="form-group">
	    <label for="signal_type" class="form-control-label canvas-modal-label">Signal Type:</label>
	    <div class="row">
			<label class="radio-inline col-sm-4">
		      <input type="checkbox" name="signal_type[]" class="signal_type" @if(in_array(1, $signal_type)) checked @endif value="1">SMS
		    </label>
		    <label class="radio-inline col-sm-4">
		      <input type="checkbox" name="signal_type[]" class="signal_type" @if(in_array(2, $signal_type)) checked @endif value="2">E-Mail
		    </label>
		    <label class="radio-inline col-sm-4">
		      <input type="checkbox" name="signal_type[]" class="signal_type" @if(in_array(3, $signal_type)) checked @endif value="3">IVR
		    </label>
	    </div>
	</div>
  <button type="button" id="submit_signal" class="btn btn-default">Submit</button>
  <button type="button" class="btn btn-danger text-right" data-dismiss="modal">Cancel</button>
{{ Form::close() }} 