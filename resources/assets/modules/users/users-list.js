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
			lengthMenu : [ 5, 10, 25, 50, 75, 100 ],
			iDisplayLength : 5,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: url+'/users/paginate',
		});
	}