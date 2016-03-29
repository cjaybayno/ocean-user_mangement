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
		$('#loan-application-current').DataTable({
			columns : [
				{"searchable" : false},
				{"searchable" : true},
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false, "orderable" : false},
			],
			oLanguage : {
				"sSearch": "Search Member Name"
			},
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: url+'/loan/application/paginate',
		});
	}