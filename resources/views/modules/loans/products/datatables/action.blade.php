<center>
	<a href="{{ URL::route('loan.products.show', $encryptID)  }}">
		<button class="btn btn-xs btn-primary"><span class="fa fa-folder"></span> View</button>
	</a>
	<a href="{{ URL::route('loan.products.edit', $encryptID)  }}">
		<button class="btn btn-xs btn-info"><span class="fa fa-pencil"></span> Edit</button>
	</a>
</center>