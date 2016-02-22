<!-- Change Password user modal --->
<div id="change-password-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Change Password</h4>
			</div>
			<div class="modal-body">
			<center>
				<h5><span class="load-bar-notif"></span></h5>
				<div class="load-bar"></div>
				<form id="change-password-form">
					<div class="form-group">
						<label class="control-label">New Password <span class="required">*</span></label>
						<input type="password" name="change_password" class="form-control action-input" id="change_password"
							minlength="8"
							data-parsley-minlength-message= "{{ trans('users.min', ['min' => 8]) }}"
							required 
							data-parsley-required-message= "{{ trans('users.required') }}"
							style="width:50%">
					</div>
					<br>
					<div class="form-group">
						<label class="control-label">Retype New Password <span class="required">*</span></label>
						<input type="password" name="confirm_change_password" class="form-control action-input" id="confirm_change_password"
							data-parsley-equalto="#change_password" 
							data-parsley-equalto-message="{{ trans('users.passwordConfirm') }}" 
							required 
							data-parsley-required-message= "{{ trans('users.required') }}"
							style="width:50%">
					</div>
				</form>
			</center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default pull-left action-btn close-btn" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-sm btn-default pull-left action-btn close-btn-done" data-dismiss="modal" style="display:none">Close</button>
				<button type="button" class="btn btn-sm btn-danger action-btn" id="confirm-btn">Confirm</button>
			</div>

		</div>
	</div>
</div>