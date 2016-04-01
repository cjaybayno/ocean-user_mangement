@extends('layouts.gentelella')
@section('title', 'Current Application')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>List of Payments</h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ URL::route('loan.payments.form') }}">
							<button type="button" class="btn btn-block btn-sm btn-info"><i class="fa fa-upload"></i> Make Payments</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table id="loan-payment-list"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
                    <thead>
						 <tr class="headings">
							<th>Date</th>
							<th>Member Name</th>
							<th>Loan Products</th>
							<th>Amount</th>
							<th>OR</th>
						</tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
			</div>
			
		</div>
	</div>
</div>
@endsection
