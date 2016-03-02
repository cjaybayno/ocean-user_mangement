<!-- Edit Users Group modal --->
<div class="modal fade" id="add-users-group-modal" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Add Group Details</h4>
	  </div>
	  <div class="modal-body">
	  <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
		<form id="add-user-group-form">
			<div class="form-group">
				<label class="control-label">Group Name</label>
				<input type="text" name="group_name" class="form-control action-input" id="group_name"
					minlength="3"
					data-parsley-minlength-message= "{{ trans('users.min', ['min' => 3]) }}"
					required
					data-parsley-required-message= "{{ trans('users.required') }}"
					style="width:50%; text-transform:capitalize;">
			</div><br>
			<div class="form-group">
				<label class="control-label">Entity</label><br>
				{!! Form::select('group_entity', $entities, null, ['class' => 'form-control select2 action-input', 'id' => 'group_entity', 'style' => 'width:50%', 'required']) !!}
			</div><br>
			<div class="form-group">
				<label class="control-label">Description</label>
				<textarea name="group_desc" id="group_desc" class="form-control action-input" rows="3" style="width:50%"></textarea>
			</div>
		</form>
	  </center>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-sm btn-default pull-left action-btn close-btn" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-sm btn-default pull-left close-btn-done" data-dismiss="modal" style="display:none">Close</button>
		<button type="button" class="btn btn-sm btn-danger action-btn" id="confirm-btn">Confirm</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->