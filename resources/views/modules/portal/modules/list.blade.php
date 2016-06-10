@extends('layouts.gentelella')
@section('title', 'Modules')

@section('addStylesheets')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	 <style>
  
  .ui-state-highlight { height: 3em; line-height: 2em; }
  </style>
@endsection

@section('addScripts')
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		var validateModuleNameMessage = "{{ trans('modules.validateModuleName') }}";
		var validateModuleLabelMessage = "{{ trans('modules.validateModuleLabel') }}";
	</script>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Modules List</h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="#add-module-modal" data-toggle="modal">
							<button type="button" class="btn btn-block btn-sm btn-primary" id="add-module-btn"><i class="glyphicon glyphicon-plus"></i> Add Modules</button>
						</a>
					</div>
					<div class="btn-group">
						<a href="#reorder-module-modal" data-toggle="modal">
							<button type="button" class="btn btn-block btn-sm btn-warning" id="reorder-module-btn"><i class="glyphicon glyphicon-sort-by-order"></i> Re-order</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table id="modules-list"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
                    <thead>
						 <tr class="headings">
							<th>Name</th>
							<th>Label</th>
							<th>Role</th>
							<th>Order</th>
							<th>Status</th>
							<th></th>
						</tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>

<!-- edit module modal --->
<form id="edit-module-form" data-parsley-validate= "">
<div class="modal fade" id="edit-module-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Edit Module</h4>
	  </div>
	  <div class="modal-body">
	   <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
			<input type="hidden" name="encryptId" id="encryptId">
			<div class="form-group">
				<label class="control-label">Name <span class="required">*</span></label>
				<input type="text" name="name" class="form-control action-input replace-space" id="name"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%">
			</div>
			<br>
			<div class="form-group">
				<label class="control-label">Label <span class="required">*</span></label>
				<input type="text" name="label" class="form-control action-input" id="label"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%; text-transform:uppercase;">
			</div>
			<br>
			<div class="form-group">
				<label class="control-label">Role</label>
				<br>
				{!! Form::select('role', config('modules.select_role'), null, ['class' => 'form-control select2 action-input', 'id' => 'role', 'style' => 'width:50%']) !!}
			</div>
			<br>
			<div class="form-group">
				<label class="control-label">Status</label>
				<br>
				{!! Form::select('active', config('modules.select_status'), null, ['class' => 'form-control select2 action-input', 'id' => 'active', 'style' => 'width:50%']) !!}
			</div>
		</center>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-sm btn-default pull-left action-btn close-btn" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-sm btn-default pull-left close-btn-done" data-dismiss="modal" style="display:none">Close</button>
		<button type="button" class="btn btn-sm btn-danger action-btn" id="confirm-btn" style="display:none">Confirm</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>

<!-- add module modal --->
<form id="add-module-form" data-parsley-validate= "">
<div class="modal fade" id="add-module-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Add Module</h4>
	  </div>
	  <div class="modal-body">
	   <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
			<div class="form-group">
				<label class="control-label">Name <span class="required">*</span></label>
				<input type="text" name="name" class="form-control action-input replace-space" id="name"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%">
			</div>
			<br>
			<div class="form-group">
				<label class="control-label">Label <span class="required">*</span></label>
				<input type="text" name="label" class="form-control action-input" id="label"
					required 
					data-parsley-required-message= "{{ trans('general.required') }}"
					style="width:50%; text-transform:uppercase;">
			</div>
			<br>
			<div class="form-group">
				<label class="control-label">Role <span class="required">*</span></label>
				<br>
				{!! Form::select('role', config('modules.select_role'), null, ['class' => 'form-control select2 action-input required', 'id' => 'role', 'style' => 'width:50%']) !!}
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

<!-- reorder module modal --->
<form id="reorder-module-form" data-parsley-validate= "">
<div class="modal fade" id="reorder-module-modal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title"> Reorder Module</h4>
	  </div>
	  <div class="modal-body">
	   <center>
		<h5><span class="load-bar-notif"></span></h5>
		<div class="load-bar"></div>
			<ul id="sortable" class="to_do">
				@foreach ($modules as $module)
					<li class="ui-state-default" id="{{ $module->id }}">{{ $module->label }}</li>
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
@endsection
