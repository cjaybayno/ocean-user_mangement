<center>
	<button class="btn btn-xs btn-info" onclick='clickEdit("{{ $encryptID }}")'><span class="fa fa-pencil"></span> Edit</button>
	<a href="{{ route('user.groups.access', $encryptID) }}">
		<button class="btn btn-xs btn-warning"><span class="fa fa-list-ul"></span> Modules</button>
	</a>
</center>