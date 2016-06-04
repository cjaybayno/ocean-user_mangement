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
				 <div class="" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#tab_content1" id="loan-tab" role="tab" data-toggle="tab" aria-expanded="true">
									Loan
								</a>
							</li>
							<li role="presentation" class="">
								<a href="#tab_content2" role="tab" id="capital-tab" data-toggle="tab"  aria-expanded="false">
									Capital
								</a>
							</li>
							<li role="presentation" class="">
								<a href="#tab_content3" role="tab" id="savings-tab" data-toggle="tab" aria-expanded="false">
									Savings
								</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="loan-tab">
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
							<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="capital-tab">
								<table id="capital-payment-list"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
									<thead>
										 <tr class="headings">
											<th>Date</th>
											<th>Member Name</th>
											<th>Amount</th>
											<th>OR</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="savings-tab">
								<table id="savings-payment-list"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
									<thead>
										 <tr class="headings">
											<th>Date</th>
											<th>Member Name</th>
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
			
		</div>
	</div>
</div>
@endsection
