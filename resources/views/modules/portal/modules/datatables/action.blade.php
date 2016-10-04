<center>
	<button class="btn btn-xs btn-info" onclick='clickEditModuleModal("{{ $encryptID }}")'><span class="fa fa-edit"></span> Edit</button>
	<a href="{{ URL::route('portal.modules.show', $encryptID) }}">
		<button class="btn btn-xs btn-primary"><span class="fa fa-folder"></span> View Menus</button>
	</a>
</center>