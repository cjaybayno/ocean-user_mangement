@extends('layouts.gentelella')
@section('title', 'Loan Payments')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2 id="header-title">Payments Form</h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="#">
							<button type="button" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-th-list"></i> Show List of Payments</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div id="loan-payments-make-result"></div>
				
				<form id="loan-payments-make-form" class="form-horizontal form-label-left">
					<div class="form-group">
						<div class="col-md-4 col-sm-4 col-xs-12">
							{!! Form::select('loan_type', $loanTypes, null, [
								'class' => 'form-control select2 col-md-7 col-xs-12', 
								'id'    => 'loan_type', 
							]) !!}
						</div>
					</div>
					<br>
					<table id="loan-payments-make-table"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
						<thead>
							 <tr class="headings">
								<th>Member Name</th>
								<th>Payment Amount</th>
								<th>OR No.</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</form>

			</div>
		</div>
	</div>
</div>
@endsection