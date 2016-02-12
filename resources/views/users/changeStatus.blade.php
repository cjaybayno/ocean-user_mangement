<!-- Change Status user modal --->
<div class="modal fade" id="change-status-user-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Change Status</h4>
	  </div>
	  <div class="modal-body">
	  <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
		{!! Form::select('change_status', $statusSelection, $userStatus, ['class' => 'form-control select2 action-input', 'id' => 'change_status', 'style' => 'width:50%']) !!}
	  </center>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-sm btn-default pull-left action-btn close-btn" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-sm btn-default pull-left action-btn close-btn-done" data-dismiss="modal" style="display:none">Close</button>
		<button type="button" class="btn btn-sm btn-danger action-btn" id="confirm-btn">Confirm</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->