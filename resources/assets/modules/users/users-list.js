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
	
	/* === Click Delete Button === */
	function clickTerminateBtnHandler(id) {
		loadingBar('#terminate-user-result-'+id, 'Termination in proccess...');
		$('#terminate-user-close-'+id).hide();
		$('#terminate-user-confirm-'+id).hide();
		ajaxCsrfToken();
		$.ajax({
			url: url+"/users/terminate",
			type: "post",
			data:{userId: id},
			dataType: 'json',
			error: function(result) {
				$('#terminate-user-confirm-'+id).show();
				$('#terminate-user-close-after-'+id).show();
				notifier('danger','#terminate-user-result-'+id, oops);
			},
			success: function(result) {
				$('#terminate-user-confirm-'+id).hide();
				$('#terminate-user-close-after-'+id).show();
				notifier('success', '#terminate-user-result-'+id, result.message);
			}
		});
	}
	
	/* === Click Close Button=== */
	function clickCloseBtnAfterHandler() {
		window.location.reload()
	}
	
	