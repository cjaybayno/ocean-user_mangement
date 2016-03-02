@extends('layouts.gentelella')
@section('title', 'User Groups')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>User Groups List </h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="#add-users-group-modal" data-toggle="modal">
							<button type="button" class="btn btn-block btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Add Groups</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table id="user-group-list"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
                    <thead>
						 <tr class="headings">
							<th>Groups Name</th>
							<th>Entity</th>
							<th>Description</th>
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

<!--  Edit User Groups view -->
{!! $editUserGroupView !!}

<!-- Add User Groups view -->
{!! $addUserGroupView !!}
@endsection
