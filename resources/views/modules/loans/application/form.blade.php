@extends('layouts.gentelella')
@section('title', 'Loan Application')

@section('addScripts')
<script> 
	var ValidateCurrentAppMessage   = "{{ trans('loans.ValidateCurrentApplication')}}"; 
	var ValidateRenewalAppMessage   = "{{ trans('loans.ValidateRenewalApplication')}}"; 
	var ValidateLoanAmountMessage   = "{{ trans('loans.validateLoanAmount') }}";
	var applicationTypeValueNew 	= "{{ config('loans.applicationType.new') }}";
	var applicationTypeValueRenewal = "{{ config('loans.applicationType.renewal') }}";
</script>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Application Form</h2>
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
				<div id="loan-application-creation-result"></div>
				
				<form id="loan-application-create-form" class="form-horizontal form-label-left">
					<input type="text" name="renewal_application_id" id="renewal_application_id">

					<p class="well well-sm">Fill-out the following information to create an application/renewal per member</p>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Applied Date</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="applied_date" id="applied_date" required="required" class="form-control col-md-7 col-xs-12" readonly style="cursor:pointer;" title="click to select date">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Search Member Last Name </span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="member_last_name" id="member_last_name" class="form-control col-md-7 col-xs-12" data-parsley-type='alphanum'>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Member Full Name<span class="required">*</span></label>
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
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Application Type<span class="required"> *</span></label>
						<div class="form-group has-feedback">
							 <div class="radio">
								<label><input type="radio" class="flat" name="application_type" value="{{config('loans.applicationType.new')}}" checked> New Application </label>
								<label><input type="radio" class="flat" name="application_type" value="{{config('loans.applicationType.renewal')}}"> Renewal </label>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Loan Type</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							{!! Form::select('loan_type', $loanTypes, null, [
								'class' => 'form-control select2', 
								'id'    => 'loan_type', 
								'required',
								'data-parsley-required-message="This field is required."'
							]) !!}
						</div>
					</div>
					
					<p class="text-muted well well-sm no-shadow">Enter Loan Details</p>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Loan Amount <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="loan_amount" id="loan_amount" class="form-control col-md-7 col-xs-12" placeholder ="(select loan type first)"
								required
								data-parsley-required-message= "{{ trans('loans.required') }}"
								data-parsley-pattern="{{ config('loans.amountRegex') }}"
								data-parsley-pattern-message="{{ trans('loans.amount') }}"
								disabled
							 >
						</div>
					</div>
					
					<p class="text-muted well well-sm no-shadow">Deductions</p>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Advance Interest</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="advance_interest" id="advance_interest" class="form-control col-md-7 col-xs-12"  placeholder ="0.00" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Processing Fee</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="processing_fee" id="processing_fee" class="form-control col-md-7 col-xs-12" placeholder ="0.00" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Capital Build-Up <span class="required">*</span></p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="capital_build_up" id="capital_build_up" class="form-control col-md-7 col-xs-12" placeholder ="0.00"
								required
								data-parsley-required-message= "{{ trans('users.required') }}"
								data-parsley-pattern="{{ config('loans.amountRegex') }}"
								data-parsley-pattern-message="{{ trans('loans.amount') }}"
								>
						</div>
					</div>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Outstanding Balance</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="outstanding_balance" id="outstanding_balance" class="form-control col-md-7 col-xs-12"  placeholder ="0.00"
								required
								data-parsley-required-message= "{{ trans('users.required') }}"
								data-parsley-pattern="{{ config('loans.amountRegex') }}"
								data-parsley-pattern-message="{{ trans('loans.amount') }}">
						</div>
					</div>
					
					<div class="form-group" id="rebate_field" style="display:none">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Rebate</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="rebate" id="rebate" class="form-control col-md-7 col-xs-12" placeholder ="0.00" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Deductions</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="total_deduction" id="total_deduction" class="form-control col-md-7 col-xs-12" placeholder ="0.00" readonly>
						</div>
					</div>
					
					</br>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Net Proceeds</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="net_proceeds" id="net_proceeds" class="form-control col-md-7 col-xs-12" placeholder ="0.00" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Monthly Amortizaton</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="monthly_amortization" id="monthly_amortization" class="form-control col-md-7 col-xs-12" placeholder ="0.00"
								required
								data-parsley-required-message= "{{ trans('users.required') }}"
								data-parsley-pattern="{{ config('loans.amountRegex') }}"
								data-parsley-pattern-message="{{ trans('loans.amount') }}">
						</div>
					</div>
					
					<div class="form-group btn-submit-field">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<button type="submit" id="form-submit" class="btn btn-success"><i class="fa fa-upload"></i> Apply</button> (double click to send)
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

