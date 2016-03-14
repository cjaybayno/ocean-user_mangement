@extends('layouts.gentelella')
@section('title', 'Users')

@section('addStylesheets')
	<style>
		.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
			margin: 0;
			padding: 0;
			border: none;
			box-shadow: none;
			text-align: center
			max-width: 100px;
		}
		.kv-avatar .file-input {
			display: table-cell;
			max-width: 220px;
		}
		
	</style>
	
	@if ($viewType === 'view')
		<style>
			#expiry {
				cursor: pointer;
			}
			
			.daterangepicker{
				z-index: 1100 !important;
			}
		</style>
	@endif
	
@endsection

@section('addScripts')
	<script> 
		var itemImages 	= '<img src="{!! !empty($user->avatar) ? $user->avatar : url('resources/assets/gentellela-alela/images/user.png') !!}" style="height:120px; width:136px"/>' 
	</script>
	
	@if ($viewType === 'edit' OR $viewType === 'view')
		<script>
			var dateRangeStart = "{{ $user->dateRangeStart }}";
			var dateRangeEnd   = "{{ $user->dateRangeEnd }}";
			var encrptyId      = "{{ $user->encrptyID }}";
		</script>
	@endif
	
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				@if ($viewType === 'create') 
					<h2>User Registration</h2>
				@elseif ($viewType === 'view')
					<h2>User Information</h2>
				@elseif ($viewType === 'edit')
					<h2>Users Update Profile</h2>
				@endif 
				<div class="pull-right">
					@if ($viewType === 'create') 
						<div id="add-btn"  class="btn-group"></div> &nbsp
						<div id="edit-btn" class="btn-group"></div> &nbsp
					@elseif ($viewType === 'view')
						<div class="btn-group">
							<a href="{{ URL::route('users.register') }}">
								<button type="button" class="btn btn-block btn-sm btn-primary"><i class="fa fa-plus-circle"></i> New user</button>
							</a>
						</div> &nbsp
						
						<!-- Split button -->
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Actions</button>
							<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<i class="caret"></i>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="{{ URL::route('users.editProfile', $user->encrptyID) }}">Edit Profile</a>
								</li>
								
								@if ($user->status === Config::get('users.status.expired'))
									<li><a href="#extend-expiry-user-modal" data-toggle="modal">Extend Expiry</a></li>
								@endif
								
								@if ($user->status !== Config::get('users.status.expired') AND $user->status !== Config::get('users.status.temporary_password') AND $isCurrentUser === false)
									<li><a href="#change-status-user-modal" data-toggle="modal">Change Status</a></li>
								@endif
								
								@if ($isCurrentUser === false)
									<li><a href="#change-group-user-modal" data-toggle="modal">Change Group</a></li>
								@endif
								
								@if ($user->status !== Config::get('users.status.terminated') AND $isCurrentUser === false)
									<li><a href="#terminate-user-modal" data-toggle="modal">Terminated</a></li>
								@endif
								
								<li class="divider"></li>
								<li><a href="#change-password-user-modal" data-toggle="modal">Change Password</a>
								@if ($user->status !== Config::get('users.status.expired') AND $user->status !== Config::get('users.status.temporary_password') AND $isCurrentUser === false)
									<li><a href="#reset-password-user-modal" data-toggle="modal">Reset Password</a>
								@endif
								</li>
							</ul>
						</div> &nbsp
					@elseif ($viewType === 'edit')
						<div id="view-btn" class="btn-group"></div> &nbsp
						<div id="edit-btn"  class="btn-group"></div> &nbsp
					@endif 
					<div class="btn-group">
						<a href="{{ URL::route('users') }}">
							<button type="button" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-th-list"></i> Show List</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form id="user-register-form" class="form-horizontal form-label-left">
					<div id="user-creation-result" class="col-sm-12"></div>
					
					
					<!-- view notification -->
					@if ($viewType === 'view')
						<div class="col-md-offset-1 col-xs-10">
						@if ($user->status ===  Config::get('users.status.disabled'))
							<div class="alert alert-danger"><i><center>Note: This user is <b>Disabled</b></center></i></div>
						@elseif ($user->status ===  Config::get('users.status.expired'))
							<div class="alert alert-warning"><i><center>Note: This user is <b>Expired</b></center></i></div>
						@elseif ($user->status ===  Config::get('users.status.terminated'))
							<div class="alert alert-danger"><i><center>Note: This user is <b>Terminated</b></center></i></div>
						@elseif ($user->status ===  Config::get('users.status.temporary_password'))
							<div class="alert alert-info"><i><center>Note: This user is in <b>Temporary Password</b></center></i></div>
						@endif
						</div>
					@endif
					
					<!-- left side form -->
					<div class="col-sm-6">
					
						<div class="form-group" id="form-group-image">
						  <label for="avatar" class="col-sm-4 control-label">Image</label>
						  <div class="col-sm-1">
							<div class="kv-avatar center-block">
								@if ($viewType !== 'view')
									<input type="file" id="avatar" name="avatar"  class="file-loading">
								@else
									<img src="{!! !empty($user->avatar) ? $user->avatar : url('resources/assets/gentellela-alela/images/user.png') !!}" style="height:110px; max-width:200px" class="img-thumbnail" >
								@endif
							</div>
						  </div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-4">Username <span class="required">*</span></label>
							<div class="col-md-8 form-group has-feedback">
								@if($viewType === 'create')
									<input type="text" name="username" class="form-control has-feedback-left" id="username" placeholder="Username"
										data-parsley-remote 
										data-parsley-remote-options='{
											"type": "POST", 
											"dataType": "jsonp", 
											"data": { 
												"_token": "{!! csrf_token() !!}" 
											} 
										}' 
										data-parsley-remote-validator='validateUsername' 
										data-parsley-remote-message="The username has already been taken"
										minlength="6" 
										data-parsley-minlength-message= "{{ trans('users.min', ['min' => 6]) }}"
										required
										data-parsley-required-message= "{{ trans('users.required') }}"
										value="{{ $user->username or '' }}">
								@else
									<input type="text" name="username" class="form-control has-feedback-left" id="username" value="{{ $user->username or '' }}">
								@endif
								<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>
						</div>
						
						@if ($viewType === 'create')
						<div class="form-group">
							<label class="control-label col-md-4">Password <span class="required">*</span></label>
							<div class="col-md-8 form-group has-feedback">
								<input type="password" name="password" class="form-control has-feedback-left" id="password" placeholder="Password" 
									minlength="8"
									data-parsley-minlength-message= "{{ trans('users.min', ['min' => 8]) }}"
									required 
									data-parsley-required-message= "{{ trans('users.required') }}">
								<span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-4">Re-Password <span class="required">*</span></label>
							<div class="col-md-8 form-group has-feedback">
								<input type="password" name="confirm-password" class="form-control has-feedback-left" id="confirm-password" placeholder="Retype Password"
									data-parsley-equalto="#password" 
									data-parsley-equalto-message="{{ trans('users.passwordConfirm') }}" 
									required 
									data-parsley-required-message= "{{ trans('users.required') }}">
								<span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
							</div>
						</div>
						@endif 
						
						<div class="form-group">
							<label class="control-label col-md-4">Expiry</label>
							<div class="col-md-8 form-group has-feedback">
								<input type="text" name="expiry" class="form-control has-feedback-left" id="expiry" readonly>
								<span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
							</div>
						</div>
						
						@if ($viewType === 'view')
						<div class="form-group">
							<label class="control-label col-md-4">Is Login</label>
							<div class="col-md-8 form-group has-feedback">
								<input type="checkbox" name="is_login" id="is_login" class="flat" {{ ($user->is_login == 1) ? 'checked' : '' }}> Yes
							</div>
						</div>
						@endif
						
						@if ($viewType === 'edit')
							<input type="hidden" name="userId" id="userId" value="{{ $user->id or '' }}">
						@endif
						
						<div class="form-group">
							<label class="control-label col-md-4">Remarks</label>
							<div class="col-md-8 form-group has-feedback">
								<textarea name="remarks" id="remarks" class="form-control" rows="3">{{ $user->remarks or '' }}</textarea>
							</div>
						</div>
					
						
					</div>
					<!-- right side form -->
					<div class="col-sm-6">
						
						<div class="form-group">
							<label class="control-label col-md-3">Full Name <span class="required">*</span>
							</label>
							<div class="col-md-7 form-group has-feedback">
								<input type="text" name="full_name" class="form-control has-feedback-left" id="full_name" placeholder="Full Name" 
									minlength="2"
									data-parsley-minlength-message= "{{ trans('users.min', ['min' => 2]) }}"
									required 
									data-parsley-required-message= "{{ trans('users.required') }}"
									style="text-transform:capitalize;"
									value="{{ $user->name or '' }}">
								<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Contact No <span class="required">*</label>
							<div class="col-md-7 form-group has-feedback">
								<input type="text" name="contact_number" class="form-control has-feedback-left" id="contact_number" placeholder="Contact Number" 
									required 
									data-parsley-required-message= "{{ trans('users.required') }}"
									data-parsley-type="digits"
									value="{{ $user->contact_number or '' }}">
								<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Email</label>
							<div class="col-md-7 form-group has-feedback">
								<input type="email" name="email" class="form-control has-feedback-left" id="email" placeholder="Email" 
								data-parsley-trigger="change"
								data-parsley-error-message= "{{ trans('users.email') }}"
								value="{{ $user->email or  '' }}">
								<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
							</div>
						</div>
						
						@if ($viewType === 'create' OR $viewType === 'view')
							<div class="form-group">
								<label class="control-label col-md-3">Status</label>
								<div class="col-md-7 form-group has-feedback">
									@if ($viewType === 'create')
										<input type="checkbox" name="status" id="status" class="flat" checked> Active
									@elseif ($viewType === 'view')
										@if ($user->status === Config::get('users.status.disabled'))
											<span class="label label-default">Disabled</span>
										@elseif ($user->status === Config::get('users.status.active'))
											<span class="label label-success">Active</span>
										@elseif ($user->status === Config::get('users.status.expired'))
											<span class="label label-warning">Expired</span>
										@elseif ($user->status === Config::get('users.status.terminated'))
											<span class="label label-danger">Terminated</span>
										@elseif ($user->status === Config::get('users.status.temporary_password'))
											<span class="label label-info">Temporary Password</span>
										@endif
									@endif
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3">Role</label>
								<div class="col-md-7 form-group has-feedback">
									<?php $role = (isset($user->role)) ? $user->role : null ?>
									{!! Form::select('role', Config::get('users.inverted_role'), $role, ['class' => 'form-control select2', 'id' => 'role']) !!}
								</div>
							</div>
							
							<div class="form-group" id="entity-input">
								<label class="control-label col-md-3">Entity</label>
								<div class="col-md-7 form-group has-feedback">
									<?php $entityId = (isset($user->entity_id)) ? $user->entity_id : null ?>
									{!! Form::select('entity', $entities, $entityId, ['class' => 'form-control select2', 'id' => 'entity', 'required']) !!}
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-md-3">Group Access</label>
								<div class="col-md-7 form-group has-feedback">
									<?php  $groupAccessId    = (isset($user->group_access_id)) ? $user->group_access_id : null ?> 
									<?php  $groupAccesSelect = ($viewType === 'create') ? ['' => '(select entity first)'] : $userGroup ?>
									{!! Form::select('group_access', $groupAccesSelect, $groupAccessId, ['class' => 'form-control select2', 'id' => 'group_access', 'required']) !!}
								</div>
							</div>
						@endif
						
						@if ($viewType !== 'view')
						<div class="form-group">
							<div class="col-md-offset-3 col-md-5">
								<button type="submit" class="btn btn-default clear-btn">Clear</button>
								<button type="submit" id="form-submit" class="btn btn-success">Submit</button>
							</div>
							@if ($viewType === 'edit')
							<div class="col-md-4">
								<a href="{{ URL::route('users.show', $user->encrptyID) }}">
									<div class="btn btn-danger cancel-edit-btn">Cancel</button>
								</a>
							</div>
							@endif
						</div>
						@endif
					
					</div>
						
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>

@if ($viewType === 'view')
	<!-- add Extend Expiry view -->
	{!! $extendExpiry !!}

	<!-- add Change Status view -->
	{!! $changeStatus !!}

	<!-- add Change Group view -->
	{!! $changeGroup !!}

	<!-- add terminate view -->
	{!! $terminate !!}
	
	<!-- add Change Password view -->
	{!! $changePassword !!}

	<!-- add Change Reset view -->
	{!! $changeReset !!}
@endif

@endsection

