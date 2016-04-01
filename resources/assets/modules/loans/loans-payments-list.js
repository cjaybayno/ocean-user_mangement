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
		$('#loan-payment-list').DataTable({
			order : [[ 0, "desc" ]],
			columns : [
				{"searchable" : false},
				{"searchable" : true}, 
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false},
			],
			oLanguage : {
				"sSearch": "Member "
			},
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: url+'/loan/payments/paginate-payment-list',
		});
	}