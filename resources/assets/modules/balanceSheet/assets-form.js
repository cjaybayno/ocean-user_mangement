/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var AssetsformNAme = '#balancesheet-assets-form';
	var LaeformNAme    = '#balancesheet-lae-form';
	$(initialPages);
/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.number-format').number(true, 2);
		getTotal(AssetsformNAme, '#total-assets');
		getTotal(LaeformNAme, '#total-lae');
	}
	
	function getTotal(formNAme, selector) {
		$('input').keyup(function() {
			var total = 0;
			$(formNAme+' input').each(function() {
				total += parseFloat($(this).val());
			});
			$(selector).text($.number(total, 2));
		});
	}
	