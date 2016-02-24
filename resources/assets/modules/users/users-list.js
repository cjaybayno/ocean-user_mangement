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
			responsive: true,
			processing: true,
			serverSide: true,
			//'iDisplayLength': 2,
			ajax: url+'/users/paginate',
		});
	}