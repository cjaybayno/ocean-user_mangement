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
		$('#user-list').DataTable({
			columns : [
				{"searchable" : false, "orderable" : false},
				{"searchable" : true},
				{"searchable" : true},
				{"searchable" : true},
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false, "orderable" : false},
			],
			oLanguage : {
				"sSearch": "Search "
			},
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: route+'/paginate',
		});
	}