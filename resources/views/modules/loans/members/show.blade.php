@extends('layouts.gentelella')
@section('title', 'Members')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Show Member Name: {{ $member->first_name.' '.$member->middle_name.' '.$member->last_name }}</h2>
				<div class="pull-right">
					<div id="add-btn" class="btn-group"></div> &nbsp
					<div class="btn-group">
						<a href="{{ URL::route('loan.members.edit', $encryptId) }}">
							<button type="button" class="btn btn-block btn-sm btn-info"><i class="fa fa-edit"></i>Edit</button>
						</a>
					</div>
					&nbsp
					<div class="btn-group">
						<a href="{{ URL::route('loan.members') }}">
							<button type="button" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-th-list"></i> Show List of Member</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div id="member-registration-result"></div>
				
				<form id="member-registration-form" class="form-horizontal form-label-left">
					<p class="well well-sm">Basic information of member</p>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="first_name" id="first_name" class="form-control col-md-7 col-xs-12" 
								value="{{ $member->first_name }}"
								readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="middle_name" id="middle_name" class="form-control col-md-7 col-xs-12" 
								value="{{ $member->middle_name }}"
								readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="last_name" id="last_name" class="form-control col-md-7 col-xs-12" 
								value="{{ $member->last_name }}"
								readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							{!! Form::select('gender',config('members.gender'), $member->gender, [
								'class' => 'form-control select2',
								'id'    => 'gender',
								'disabled',
							]) !!}
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Marital Status</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							{!! Form::select('marital_status', config('members.marital_status'), $member->marital_status, [
								'class' => 'form-control select2',
								'id'    => 'marital_status',
								'disabled'
							]) !!}
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Birth Date</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="birth_date" id="birth_date" class="form-control col-md-7 col-xs-12"
								value="{{ date('m/d/Y', strtotime($member->birth_date)) }}"
								readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Birth Place</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="birth_place" id="birth_place" class="form-control col-md-7 col-xs-12"
								value="{{ $member->birth_place }}"
								readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Mothers Maiden Name</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="mother_maiden_name" id="mother_maiden_name" class="form-control col-md-7 col-xs-12"
								value="{{ $member->mother_maiden_name }}"
								readonly>
						</div>
					</div>
					
					<p class="well well-sm">Contact Information</p>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="contact_number" id="contact_number" class="form-control col-md-7 col-xs-12"
								value="{{ $member->contact_number }}"
								readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="email" name="email_address" id="email_address"  class="form-control col-md-7 col-xs-12"
								value="{{ $member->email_address }}"
								readonly>
						</div>
					</div>
					
					<p class="well well-sm">Address Information</p>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Province/City</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="province_city" id="province_city" class="form-control col-md-7 col-xs-12"
								value="{{ $member->province_city_address }}"
								readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Barangay/Town</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="brgy_town" id="brgy_town" class="form-control col-md-7 col-xs-12"
								value="{{ $member->brgy_town_address }}"
								readonly>
						</div>
					</div>
					
					<div class="form-group"> 
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Zipcode</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="zipcode" id="zipcode" required="required" class="form-control col-md-7 col-xs-12" 
								value="{{ $member->zipcode_address }}"
								readonly>
						</div>
					</div>
					
					<div class="form-group"> 
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Street</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="street" id="street" required="required" class="form-control col-md-7 col-xs-12"
								value="{{ $member->street_address }}"
								readonly>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

