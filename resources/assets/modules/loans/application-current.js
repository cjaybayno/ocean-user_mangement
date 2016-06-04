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
			order : [[ 0, "desc" ]],
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
				"sSearch": "Member "
			},
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: route+'/paginate',
		});
	}