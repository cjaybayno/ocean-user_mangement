@extends('layouts.gentelella')
@section('title', 'Consolidation')

@section('addScripts')
	<script src="https://cdn.datatables.net/buttons/1.2.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.0/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.0/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.0/js/buttons.print.min.js"></script>
@endsection

@section('addStylesheets')
	<link rel="stylesheet"  href="https://cdn.datatables.net/buttons/1.2.0/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2 id="header-title">Savings Consolidation</h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ URL::route('loan.conso.savings.contribution')}}">
							<button type="button" class="btn btn-block btn-sm btn-primary"><i class="glyphicon glyphicon-th-list"></i> View Contribution Table</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">				
				<div class="form-horizontal">
					<div class="form-group">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="btn-group">
								<a href="{{ URL::route('loan.conso.savings') }}">
									<button type="button" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
								</a>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" name="date_range" id="date_range" class="form-control col-md-7 col-xs-12" readonly style="cursor:pointer;" placeholder="click to select date">
						</div>
					</div>
					<br>
					<table id="conso-savings-table"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%" style="display:none">
						<thead>
							 <tr class="headings">
								<th>Member Name</th>
								<th>Current Balance</th>
								<th>Available Balance</th>
								<th>Pending Balance</th>
							</tr>
						</thead>
						<tfoot>
							<tr class="headings">
								<th>Total</th>
								<th>PHP </th>
								<th>PHP </th>
								<th>PHP </th>
							</tr>
						</tfoot>
					</table>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

