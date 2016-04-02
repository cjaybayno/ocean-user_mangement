<a href="{{ URL::route('members.show', $encryptID) }}">
	<button class="btn btn-xs btn-primary"><span class="fa fa-eye"></span> View</button>
</a>
<a href="{{ URL::route('members.edit', $encryptID) }}">
	<button class="btn btn-xs btn-info"><span class="fa fa-edit"></span> Edit</button>
</a>
