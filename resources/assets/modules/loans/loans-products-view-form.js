/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var formId  = '#loan-products-create-form';
	
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.select2').select2();
		disabledInput();
	}
	
	function disabledInput() {
		$(formId+' input, '+formId+' textarea').attr('readonly', true);
		$(formId+' select').attr('disabled', true);
	}