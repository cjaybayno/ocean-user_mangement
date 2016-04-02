@extends('layouts.gentelella')
@section('title', 'Members')
@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Modify Member Name : {{ $member->first_name.' '.$member->middle_name.' '.$member->last_name }}</h2>
				<div class="pull-right">
					<div id="add-btn" class="btn-group"></div> &nbsp
					<div class="btn-group">
						<a href="{{ URL::route('members') }}">
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
					
					<input type="hidden" name="encryptId" id="encryptId" value="{{ $encryptId }}">
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">First Name<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="first_name" id="first_name" required="required" class="form-control col-md-7 col-xs-12" 
								style="text-transform:capitalize"
								data-parsley-required-message= "{{ trans('members.required') }}"
								value="{{ $member->first_name }}">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="middle_name" id="middle_name" required="required" class="form-control col-md-7 col-xs-12" 
								style="text-transform:capitalize"
								data-parsley-required-message= "{{ trans('members.required') }}"
								value="{{ $member->middle_name }}">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="last_name" id="last_name" required="required" class="form-control col-md-7 col-xs-12" 
								style="text-transform:capitalize"
								data-parsley-required-message= "{{ trans('members.required') }}"
								value="{{ $member->last_name }}">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							{!! Form::select('gender',config('members.gender'), $member->gender, [
								'class' => 'form-control select2',
								'id'    => 'gender',
							]) !!}
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Marital Status</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							{!! Form::select('marital_status', config('members.marital_status'), $member->marital_status, [
								'class' => 'form-control select2',
								'id'    => 'marital_status',
							]) !!}
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Birth Date<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="birth_date" id="birth_date" required="required" class="form-control col-md-7 col-xs-12" readonly 
								style="cursor:pointer;"
								placeholder="click to select birth date"
								data-parsley-required-message= "{{ trans('members.required') }}"
								value="{{ date('m/d/Y', strtotime($member->birth_date)) }}">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Birth Place<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="birth_place" id="birth_place" required="required" class="form-control col-md-7 col-xs-12"
								style="text-transform:capitalize"
								data-parsley-required-message= "{{ trans('members.required') }}"
								value="{{ $member->birth_place }}">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Mothers Maiden Name<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="mother_maiden_name" id="mother_maiden_name" required="required" class="form-control col-md-7 col-xs-12"
								style="text-transform:capitalize"
								data-parsley-required-message= "{{ trans('members.required') }}"
								value="{{ $member->mother_maiden_name }}">
						</div>
					</div>
					
					<p class="well well-sm">Contact Information</p>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="contact_number" id="contact_number" required="required" class="form-control col-md-7 col-xs-12"
								style="text-transform:capitalize"
								data-parsley-required-message= "{{ trans('members.required') }}"
								value="{{ $member->contact_number }}">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="email" name="email_address" id="email_address"  class="form-control col-md-7 col-xs-12"
							value="{{ $member->email_address }}">
						</div>
					</div>
					
					<p class="well well-sm">Address Information</p>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Province/City <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							{!! Form::select('province_city', $provinceCity, $member->province_city_address, [
								'class' => 'form-control select2',
								'id'    => 'province_city',
							]) !!}
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Barangay/Town<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							{!! Form::select('brgy_town', $brgyTown, $member->brgy_town_address, [
								'class'    => 'form-control select2',
								'id'       => 'brgy_town',
							]) !!}
						</div>
					</div>
					
					<div class="form-group"> 
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Zipcode</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="zipcode" id="zipcode" required="required" class="form-control col-md-7 col-xs-12" 
								value = "{{ $member->zipcode_address }}"
								readonly>
						</div>
					</div>
					
					<div class="form-group"> 
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Street<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="street" id="street" required="required" class="form-control col-md-7 col-xs-12"
								style="text-transform:capitalize"
								data-parsley-required-message= "{{ trans('members.required') }}"
								value="{{ $member->street_address }}">
						</div>
					</div>
					
					<div class="form-group btn-submit-field">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<button type="submit" id="form-submit" class="btn btn-info"><i class="fa fa-edit"></i> Modify</button> (double click to send)
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

