@if ($role == config('modules.role.client'))
	<button type="button" class="btn btn-default btn-xs">CLIENT</button>
@elseif($role == config('modules.role.admin'))
	<button type="button" class="btn btn-primary btn-xs">ADMIN</button>
@endif