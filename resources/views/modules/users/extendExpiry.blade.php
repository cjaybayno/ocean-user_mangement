<!-- Extend Expiry user modal --->
<div class="modal fade" id="extend-expiry-user-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Extend Expiry</h4>
	  </div>
	  <div class="modal-body">
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
		<center>
			<label class="action-input">Default is 6 months</label>
			<input type="text" name="extend_expiry" class="form-control has-feedback-left action-input" id="extend_expiry" readonly style="width:50%">
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