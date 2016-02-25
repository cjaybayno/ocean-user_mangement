/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		dataTables();
	}
	
	/* === dataTables === */
	function dataTables() {
		$('#user-group-list').DataTable({
			columns : [
				{"searchable" : true},
				{"searchable" : false},
				null,
			],
			oLanguage : {
				"sSearch": "Search Group Name"
			},
			responsive: true,
			processing: false,
			serverSide: true,
			//'iDisplayLength': 2,
			ajax: url+'/user/groups/paginate',
		});
	}
	
	