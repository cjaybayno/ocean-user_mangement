@extends('layouts.gentelella')
@section('title', 'Api Partners')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Partners</h2>
				<div class="pull-right">
					<div class="btn-group">
						<a href="#">
							<button type="button" class="btn btn-block btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i> Add Partners</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table id="api-partners-list"  class="table table-striped responsive-utilities jambo_table" cellspacing="0" width="100%">
                    <thead>
						 <tr class="headings">
							<th>Name</th>
							<th>Code</th>
							<th>Description</th>
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
