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
		formSubmit(AssetsformNAme, '#assets-result');
		formSubmit(LaeformNAme, '#lae-result');
		onclickTabBtn();
	}
	
	function onclickTabBtn() {
		$('.tab-btn').click(function(){
			$('.result-pane').empty();
			$('input').removeAttr('disabled').val(0);
			$('.total').text('0.00');
			$('#form-submit').show();
			$('#add-btn').empty();
		});
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
	
	function formSubmit(formNAme, resultSelector) {
		$(formNAme+' #form-submit').on('click', function () {
			loadingModal('show','Saving ....');
			ajaxCsrfToken();
			$.ajax({
				url: route+'/store',
				type: "post",
				data: $('input').serialize(),
				dataType: 'json',
				complete: function() {
					loadingModal('close');
					scrollTop();
				},
				error: function(result) {
					notifier('danger', resultSelector, oops);
				},
				success: function(result) {
					$('form .btn-submit-field').hide();
					$(formNAme+' input').attr('disabled', true);
					$(formNAme+' #form-submit').hide();
					notifier('success', resultSelector, result.message);
					addBtn('', 'Add Entry');
				}
			});
			return false;
		});
		$('.clear-btn').click(function() { $(formNAme).parsley().reset() });
	}
	