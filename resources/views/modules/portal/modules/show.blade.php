@extends('layouts.gentelella')
@section('title', 'Modules Show')

@section('addStylesheets')
	<style>
		.ui-state-highlight { height: 3em; line-height: 2em; }
	</style>
@endsection

@section('addScripts')
	<script>
		var validateModuleNameMessage  = "{{ trans('modules.validateModuleName') }}";
		var validateModuleLabelMessage = "{{ trans('modules.validateModuleLabel') }}";
		var validateModuleRouteMessage = "{{ trans('modules.validateModuleRoute') }}";
	</script>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2> Modules : {{ $modules->label }}</h2>
				<div class="pull-right">	
					<div class="btn-group">
						<a href="#add-menu-modal" data-toggle="modal">
							<button type="button" class="btn btn-block btn-sm btn-primary" id="add-menu-btn"><i class="glyphicon glyphicon-plus"></i> Add Menu</button>
						</a>
					</div>
					<div class="btn-group">
						<a href="#reorder-menu-modal" data-toggle="modal">
							<button type="button" class="btn btn-block btn-sm btn-warning" id="reorder-module-btn"><i class="glyphicon glyphicon-sort-by-order"></i> Re-order Menu</button>
						</a>
					</div>
					<div class="btn-group">
						<a href="{{ URL::route('portal.modules') }}">
							<button type="button" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-th-list"></i> Show List of Modules</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="col-xs-3">
					<ul class="nav nav-tabs tabs-left">
						<?php $flag = 0 ?>
						@foreach ($selected_menus as $menu)
							<li class=<?php if ($flag <= 0) echo 'active'?>>
								<a href="#{{ $menu['name'] }}" data-toggle="tab">{{ $menu['label'] }}</a>
							</li>
							<?php $flag++ ?>
						@endforeach
					</ul>
				</div>
				<div class="col-xs-9">
					<!-- Tab panes -->
					<div class="tab-content">
						<?php $flag = 0 ?>
						@foreach ($selected_menus as $menu)
							<div class="tab-pane <?php if ($flag <= 0) echo 'active'?>" id="{{ $menu['name'] }}">
								<div class="pull-left">
									<p class="lead">{{ $menu['label'] }}  Menu</p>
								</div>
								<div class="pull-right">
									
								</div>
								<table class="table table-hover table-striped">
									<thead>
										<tr>
											<th>Name</th>
											<th>Label</th>
											<th>Order</th>
											<th>Status</th>
											<th>Route</th>
											<th>Icon</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{{ $menu['name'] }}</td>
											<td>{{ $menu['label'] }}</td>
											<td>{{ $menu['order_list'] }}</td>
											<td>
												@if ($menu['active'])
													<span class="label label-success">Active</span>
												@else
													<span class="label label-danger">Deactivated</span>
												@endif
											</td>
											<td>
												@if (empty($menu['route']))
													<span class="label label-default">None</span>
												@else
													{{ $menu['route'] }}
												@endif
											</td>
											<td><i class="{{ $menu['icon'] }}"></i> <code>{{ $menu['icon'] }}</code></td>
											<td>
												<a href="#edit-menu-modal" data-toggle="modal">
													<button class="btn btn-xs btn-info" onclick='clickEditMenuBtn("{{ Crypt::encrypt($menu['id']) }}")'><span class="fa fa-edit"></span> Edit</button>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
								<?php $flag++ ?>
								@if (empty($menu['route']) AND $menu['active'] != config('modules.status.deactive'))
								<div class="pull-left">
									<p class="lead">Sub Menus</p>
								</div>
								<div class="pull-right">
									<div class="btn-group">
										<a href="#add-submenu-modal" data-toggle="modal">
											<button type="button" class="btn btn-block btn-sm btn-primary" onclick='clickAddSubMenuBtn("{{ Crypt::encrypt($menu['id']) }}")'><i class="glyphicon glyphicon-plus"></i> Add Sub-Menu</button>
										</a>
									</div>
									@if (! empty($menu['child']))
										<div class="btn-group">
											<a href="#reorder-submenu-modal" data-toggle="modal">
												<button type="button" class="btn btn-block btn-sm btn-warning" onclick='clickReorderSubMenuBtn("{{ Crypt::encrypt($menu['id']) }}")'><i class="glyphicon glyphicon-sort-by-order"></i> Re-order Sub-Menu</button>
											</a>
										</div>
									@endif
								</div>
								<table class="table table-hover table-striped">
									<thead>
										<tr>
											<th>Name</th>
											<th>Label</th>
											<th>Order</th>
											<th>Status</th>
											<th>Route</th>
											<th></th>
										</tr>
									</thead>
									@if (! empty($menu['child']))
										<tbody>
											@foreach ($menu['child'] as $menu)
												<tr>
													<td>{{ $menu['name'] }}</td>
													<td>{{ $menu['label'] }}</td>
													<td>{{ $menu['order_list'] }}</td>
													<td>
														@if ($menu['active'])
															<span class="label label-success">Active</span>
														@else
															<span class="label label-danger">Deactivated</span>
														@endif
													</td>
													<td>{{ $menu['route'] }}</td>
													<td>
														<a href="#edit-submenu-modal" data-toggle="modal">
															<button class="btn btn-xs btn-info" onclick='clickEditSubMenuBtn("{{ Crypt::encrypt($menu['id']) }}")'><span class="fa fa-edit"></span> Edit</button>
														</a>
													</td>
												</tr>
											@endforeach
										</tbody>
									@else
										<tbody>
											<tr>
												<td colspan="6">No Sub-Menus</td>
											</tr>
										</tbody>
									@endif
								</table>
								@endif
							</div>
						@endforeach
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<!-- reorder menu modal --->
<form id="reorder-menu-form" data-parsley-validate= "">
<div class="modal fade" id="reorder-menu-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Reorder Menu</h4>
	  </div>
	  <div class="modal-body">
	   <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
			<ul class="to_do sortable">
				@foreach ($selected_menus as $menu)
					<li class="ui-state-default" id="{{ $menu['id'] }}">{{ $menu['label'] }}</li>
				@endforeach
			</ul>
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
</form>

<!-- reorder submenu modal --->
<form id="reorder-submenu-form" data-parsley-validate= "">
<div class="modal fade" id="reorder-submenu-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Reorder Sub-Menu</h4>
	  </div>
	  <div class="modal-body">
	   <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
			<ul class="to_do sortable"></ul>
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
</form>

<!-- add menu modal --->
<form id="add-menu-form" data-parsley-validate= "">
<div class="modal fade" id="add-menu-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Add Menu</h4>
	  </div>
	  <div class="modal-body">
	   <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
			<input type="hidden" name="encryptId" id="encryptId" value="{{ $menuId }}">
			<!-- <div class="form-group">
				<label class="control-label">Name <span class="required">*</span></label>
				<input type="text" name="name" class="form-control action-input replace-space" id="name"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%">
			</div> will replace this as a backend process, automated-->
			<div class="form-group">
				<label class="control-label">Label <span class="required">*</span></label>
				<input type="text" name="label" class="form-control action-input" id="label"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%; text-transform:capitalize;">
			</div>
			<div class="form-group">
				<label class="control-label">Route (optional)</label>
				<input type="text" name="route" class="form-control action-input" id="route"style="width:50%;">
			</div>
			<div class="form-group">
				<label class="control-label">Select Icon <span class="required">*</span></label>
				<br>
				<div class="btn-group">
					<a href="#list-icon-modal" data-toggle="modal">
						<div class="btn btn-app select-icon-btn"><span class="fa fa-location-arrow"></span></div>
					</a>
				</div>
				<input type="text" name="icon" class="form-control action-input route" id="icon"
					required
					readonly
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%;">
			</div>
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
</form>


<!-- add menu modal --->
<form id="edit-menu-form" data-parsley-validate= "">
<div class="modal fade" id="edit-menu-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Edit Menu</h4>
	  </div>
	  <div class="modal-body">
	   <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
			<input type="hidden" name="menuEncryptId" id="menuEncryptId">
			<!--<div class="form-group">
				<label class="control-label">Name <span class="required">*</span></label>
				<input type="text" name="name" class="form-control action-input replace-space" id="name"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%">
			</div> will replace this as a backend process, automated-->
			<div class="form-group">
				<label class="control-label">Label <span class="required">*</span></label>
				<input type="text" name="label" class="form-control action-input" id="label"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%; text-transform:capitalize;">
			</div>
			<div class="form-group">
				<label class="control-label">Status </label>
					{!! Form::select('active', config('modules.select_status'), null, ['class' => 'form-control select2 action-input', 'id' => 'active', 'style' => 'width:50%']) !!}
			</div>
			<div class="form-group">
				<label class="control-label">Route (optional)</label>
				<input type="text" name="route" class="form-control action-input" id="route"style="width:50%;">
			</div>
			<div class="form-group">
				<label class="control-label">Select Icon <span class="required">*</span></label>
				<br>
				<div class="btn-group">
					<a href="#list-icon-modal" data-toggle="modal" disabled>
						<div class="btn btn-app select-icon-btn action-input"><span class="fa fa-location-arrow"></span></div>
					</a>
				</div>
				<input type="text" name="icon" class="form-control action-input route" id="icon"
					required
					readonly
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%;">
			</div>
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
</form>

<!-- add submenu modal --->
<form id="add-submenu-form" data-parsley-validate= "">
<div class="modal fade" id="add-submenu-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Add Sub-Menu</h4>
	  </div>
	  <div class="modal-body">
	   <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
			<input type="hidden" name="encryptId" id="encryptId">
			<!-- <div class="form-group">
				<label class="control-label">Name <span class="required">*</span></label>
				<input type="text" name="name" class="form-control action-input replace-space" id="name"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%">
			</div> will replace this as a backend process, automated-->
			<div class="form-group">
				<label class="control-label">Label <span class="required">*</span></label>
				<input type="text" name="label" class="form-control action-input" id="label"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%; text-transform:capitalize;">
			</div>
			<div class="form-group">
				<label class="control-label">Route <span class="required">*</span></label>
				<input type="text" name="route" class="form-control action-input" id="route"style="width:50%;"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}">
			</div>
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
</form>

<!-- edit submenu modal --->
<form id="edit-submenu-form" data-parsley-validate= "">
<div class="modal fade" id="edit-submenu-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Add Sub-Menu</h4>
	  </div>
	  <div class="modal-body">
	   <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
			<input type="hidden" name="menuEncryptId" id="menuEncryptId">
			<!-- <div class="form-group">
				<label class="control-label">Name <span class="required">*</span></label>
				<input type="text" name="name" class="form-control action-input replace-space" id="name"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%">
			</div> will replace this as a backend process, automated-->
			<div class="form-group">
				<label class="control-label">Label <span class="required">*</span></label>
				<input type="text" name="label" class="form-control action-input" id="label"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%; text-transform:capitalize;">
			</div>
			<div class="form-group">
				<label class="control-label">Status </label>
					{!! Form::select('active', config('modules.select_status'), null, ['class' => 'form-control select2 action-input', 'id' => 'active', 'style' => 'width:50%']) !!}
			</div>
			<div class="form-group">
				<label class="control-label">Route <span class="required">*</span></label>
				<input type="text" name="route" class="form-control action-input" id="route"style="width:50%;"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}">
			</div>
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
</form>

<!-- add icon list view -->
{!! $iconList !!}

@endsection

