/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var formId    = '#loan-products-create-form';
	var resultDiv = '#loan-products-creation-result';
	
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.select2').select2();
		disabledInput();
		onBlurPrincipalAmount();
		formSubmit();
	}
	
	function disabledInput() {
		/* === disabled entity === */
		$(formId+' #entity').attr('disabled', true);
	}
	
	function onBlurPrincipalAmount() {
		$('#principal_amount').blur(function () {
			$(this).val(addTwoZero($(this).val()));
		});
		
		$(document).ready(function () {
			var selector = '#principal_amount';
			$(selector).val(addTwoZero($(selector).val()));
		});
	}
	
	function formSubmit() {
		 $('#form-submit').on('click', function () {
			if(formValidation()) {
				loadingModal('show','Saving ....');
				ajaxCsrfToken();
				$.ajax({
					url: route+'/update',
					type: "post",
					data: $('form').serialize(),
					dataType: 'json',
					complete: function() {	
						loadingModal('close');
					},
					error: function(result) {
						notifier('danger', resultDiv, oops);
					},
					success: function(result) {
						$('form .btn').hide();
						$('input, textarea').attr('readonly', true);
						$('#entity, select').attr('disabled', true);
						notifier('success', resultDiv, result.message);
						editBtn(route+'/show', 'Edit');
					}
				});
			}
			return false;
		});
		
		$('.clear-btn').click(function() { $(formId).parsley().reset() });
	}
	
	function formValidation() {
		$(formId).parsley().validate();
		return $(formId).parsley().isValid();
	}
		  