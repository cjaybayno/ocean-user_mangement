@extends('layouts.gentelella')
@section('title', 'Loan Application')
@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Apply Loan Forms</h2>
				<div class="pull-right">
					
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form id="loan-application-create-form" class="form-horizontal form-label-left">
					<div id="loan-application-creation-result" class="col-sm-12"></div>
					<p>Fill-out the following information to create an application/renewal per member</p>
					
					</br>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Member ID <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="member_id" id="member_id" required="required" class="form-control col-md-7 col-xs-12"
								required
								data-parsley-required-message= "{{ trans('users.required') }}">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Member Name<span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="member_name" id="member_name" required="required" class="form-control col-md-7 col-xs-12" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Application Type<span class="required"> *</span></label>
						<div class="form-group has-feedback">
							 <div class="radio">
								<label><input type="radio" class="flat" name="application_type"> New Application </label>
								<label><input type="radio" class="flat" name="application_type"> Renewal </label>
							</div>
						</div>
					</div>
					
					</br>
					<p>Enter Loan Details</p>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Loan Amount <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="loan_amount" id="loan_amount" required="required" class="form-control col-md-7 col-xs-12">
						</div>
					</div>
					
					</br>
					<p>Deductions</p>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Advance Interest</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="advance_interest" id="advance_interest" class="form-control col-md-7 col-xs-12" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Processing Fee</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="processing_fee" id="processing_fee" class="form-control col-md-7 col-xs-12" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Capital Build-Up <span class="required">*</span></p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="capital_buil_up" id="capital_buil_up" class="form-control col-md-7 col-xs-12"
								required
								data-parsley-required-message= "{{ trans('users.required') }}">
						</div>
					</div>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Outstanding Balance</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="outstanding_balance" id="outstanding_balance" class="form-control col-md-7 col-xs-12" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Rebate</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="rebate" id="rebate" class="form-control col-md-7 col-xs-12" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Deductions</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="total_deduction" id="total_deduction" class="form-control col-md-7 col-xs-12" readonly>
						</div>
					</div>
					
					</br>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Net Proceeds</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="net_proceeds" id="net_proceeds" class="form-control col-md-7 col-xs-12" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Monthly Ammortizaton</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="monthly_ammortizaton" id="monthly_ammortizaton" class="form-control col-md-7 col-xs-12" readonly>
						</div>
					</div>
					
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

