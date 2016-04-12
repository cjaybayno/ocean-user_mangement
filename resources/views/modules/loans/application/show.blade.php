@extends('layouts.gentelella')
@section('title', 'Loan Application')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Member : {{$application->member_name}}</h2>
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
				<form id="loan-application-create-form" class="form-horizontal form-label-left">
					<p class="well well-sm">Loan summary information </p>
					
					<div class="form-group" id="outstanding_balance_field">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">OUTSTANDING BALANCE</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="outstanding_balance" id="outstanding_balance" class="form-control col-md-7 col-xs-12"
							value="{{ number_format($application->outstanding_balance, 2)}}" readonly>
						</div>
					</div>
					<br>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Number of Payments Made</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="num_made_payments" id="num_made_payments" class="form-control col-md-7 col-xs-12" 
							value="{{ $application->num_made_payments }}" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Total Payments</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="total_made_payments" id="total_made_payments" class="form-control col-md-7 col-xs-12" 
							value="{{ number_format($application->total_made_payments, 2) }}" readonly>
						</div>
					</div>
					
					
					<br>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Applied Date</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="applied_date" id="applied_date" class="form-control col-md-7 col-xs-12" 
							value="{{ date('m/d/Y', strtotime($application->applied_date)) }}" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Application Type</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="application_type" id="application_type" class="form-control col-md-7 col-xs-12" 
							value="{{ $application->application_type }}" readonly>
						</div>
					</div>
					
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" >Loan Type</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="loan_type" id="loan_type" class="form-control col-md-7 col-xs-12" 
							value="{{ $application->loan_product_name }}" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Loan Amount </label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="loan_amount" id="loan_amount" class="form-control col-md-7 col-xs-12" 
							value="{{ number_format($application->amount, 2) }}" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Advance Interest</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="advance_interest" id="advance_interest" class="form-control col-md-7 col-xs-12" 
							value="{{ number_format($application->advance_interest, 2)}}" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Processing Fee</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="processing_fee" id="processing_fee" class="form-control col-md-7 col-xs-12" 
							value="{{ number_format($application->processing_fee, 2) }}" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Capital Build-Up</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="capital_build_up" id="capital_build_up" class="form-control col-md-7 col-xs-12"
							value="{{ number_format($application->capital_build_up, 2)}}" readonly>
						</div>
					</div>
					
					<div class="form-group" id="rebate_field">
						<p class="control-label col-md-3 col-sm-3 col-xs-12">Rebate</p>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="rebate" id="rebate" class="form-control col-md-7 col-xs-12" 
							value="{{ number_format($application->rebate, 2) }}" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Total Deductions</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="total_deduction" id="total_deduction" class="form-control col-md-7 col-xs-12" 
							value="{{ number_format($application->total_deduction, 2)}}" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Net Proceeds</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="net_proceeds" id="net_proceeds" class="form-control col-md-7 col-xs-12"
							value="{{ number_format($application->net_proceeds, 2) }}" readonly>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Monthly Amortizaton</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" name="monthly_amortization" id="monthly_amortization" class="form-control col-md-7 col-xs-12" 
							value="{{ number_format($application->amortization, 2)}}" readonly>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

