@extends('layouts.gentelella')
@section('title', 'Users')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Users List</h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ URL::route('users.register') }}">
							<button type="button" class="btn btn-block btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Add User</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table id="user-list"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
                    <thead>
						 <tr class="headings">
							<th>Avatar</th>
							<th>Username</th>
							<th>Full Name</th>
							<th>Groups</th>
							<th>Login State</th>
							<th>Status</th>
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
