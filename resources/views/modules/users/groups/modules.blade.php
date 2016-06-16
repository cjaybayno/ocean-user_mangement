@extends('layouts.gentelella')
@section('title', 'User Groups Access')

@section('addScripts')
	<script>
		var menusId = JSON.parse("{{ $menusId }}");
	</script>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>User Group Module [{{ strtoupper($userGroup['name']) }}]</h2>
				<div class="pull-right">	
					<div class="btn-group">
						<a href="{{ URL::route('user.groups') }}">
							<button type="button" class="btn btn-block btn-sm btn-default"><i class="glyphicon glyphicon-th-list"></i> Show Group List</button>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div id="user-group-modules-modify-result"></div>
				<div id="group-module-access-list">{!! $menusUl !!}</div></br>
				<input type="hidden" id="encryptId" value="{{ $encryptId }}">
				<button type="submit" id="update-btn" class="btn btn-success">Update</button>
			</div>
		</div>
	</div>
</div>

@endsection
