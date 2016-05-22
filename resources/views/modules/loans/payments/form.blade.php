@extends('layouts.gentelella')
@section('title', 'Loan Payments')

@section('addScripts')
<script> 
	var ValidatePaymentOrSameFieldMessage = "{{ trans('loans.validatePaymentORSameField')}}"; 
</script>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2 id="header-title">Payments Form</h2>
				<div class="pull-right">
					<div id="add-btn" class="btn-group"></div>
					<div class="btn-group">
						<a href="{{ URL::route('payments.list')}}">
							<button type="button" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-th-list"></i> Show List of Payments</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div id="payments-make-result"></div>
				<form id="payments-make-form" class="form-horizontal form-label-left">
					<div class="form-group">
						<div class="col-md-4 col-sm-4 col-xs-12">
							{!! Form::select('product_type', $payementType, null, [
								'class' => 'form-control select2 col-md-7 col-xs-12', 
								'id'    => 'product_type', 
							]) !!}
						</div>
					</div>
					<br>
					<table id="payments-make-table"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%" style="display:none">
						<thead>
							 <tr class="headings">
								<th>Member Name</th>
								<th>Payment Amount</th>
								<th>OR No.</th>
								<th> </th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<div class="form-group btn-submit-field" style="display:none">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<button type="submit" id="form-submit" class="btn btn-info"><i class="fa fa-dollar"></i> Paid</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection