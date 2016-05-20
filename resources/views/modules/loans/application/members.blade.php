@extends('layouts.gentelella')
@section('title', 'Loan Application')
@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Members Records <small>Select member record you want to view</small></h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ URL::route('loan.application.current') }}">
							<button type="button" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-th-list"></i> Show Current Application</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">				
				<div class="form-horizontal">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Search Last Name </span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="member_last_name" id="member_last_name" class="form-control col-md-7 col-xs-12" data-parsley-type='alphanum'>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Full Name</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							{!! Form::select('member_name', ['' => '(search member last name first)'], null, [
								'class' => 'form-control select2', 
								'id'    => 'member_name', 
								'required',
								'data-parsley-required-message="This field is required."',
								'disabled'
							]) !!}
						</div>
					</div>
					<div id="members-record-result"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

