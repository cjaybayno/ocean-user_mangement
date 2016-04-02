@extends('layouts.gentelella')
@section('title', 'Member List')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>List of Members</h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ URL::route('members.register') }}">
							<button type="button" class="btn btn-block btn-sm btn-info"><i class="fa fa-plus-circle"></i> Add New Member</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table id="member-list"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
                    <thead>
						 <tr class="headings">
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Last Name</th>
							<th>Contact Number</th>
							<th>Email Address</th>
							<th>Action</th>
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
