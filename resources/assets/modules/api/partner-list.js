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
		$('#api-partners-list').DataTable({
			order : [[ 1, "asc" ]],
			columns : [
				{"searchable" : false, "orderable" : false},
				{"searchable" : true},
				{"searchable" : true},
				{"searchable" : true},
				{"searchable" : false, "orderable" : false},
			],
			oLanguage : {
				"sSearch": "Partners "
			},
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: route+'/paginate',
		});
	}