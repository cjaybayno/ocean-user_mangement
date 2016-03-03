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
		$('#loan-products-list').DataTable({
			columns : [
				{"searchable" : false},
				{"searchable" : true},
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false},
			],
			oLanguage : {
				"sSearch": "Search Product Name"
			},
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: url+'/loan/products/paginate',
		});
	}