@extends('layouts.gentelella')
@section('title', 'Current Application')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Current Application</h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ URL::route('loan.application.form') }}">
							<button type="button" class="btn btn-block btn-sm btn-info"><i class="fa fa-upload"></i> Apply New Loan</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table id="loan-application-current"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
                    <thead>
						 <tr class="headings">
							<th>Date</th>
							<th>Member Name</th>
							<th>Loan Products</th>
							<th>Application Type</th>
							<th>Amount</th>
							<th>Net Proceeds</th>
							<th>Balance</th>
							<th> </th>
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
