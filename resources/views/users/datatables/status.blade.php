@if ($user['status'] == $status['disabled'])
	<span class="label label-default">Disabled</span>
@elseif ($user['status'] == $status['active'])
	<span class="label label-success">Active</span>
@elseif ($user['status'] == $status['expired'])
	<span class="label label-warning">Expired</span>
@elseif ($user['status'] == $status['terminated'])
	<span class="label label-danger">Terminated</span>
@elseif ($user['status'] == $status['temporary_password'])
	<span class="label label-info">Temporary Password</span>
@endif