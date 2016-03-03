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
		onBlurPrincipalAmount();
		formSubmit();
	}
	
	function onBlurPrincipalAmount() {
		$('#principal_amount').blur(function () {
			$(this).val(addTwoZero($(this).val()));
		});
	}
	
	function formSubmit() {
		 $('#form-submit').on('click', function () {
			if(formValidation()) {
				loadingModal('show','Saving ....');
				ajaxCsrfToken();
				$.ajax({
					url: url+'/loan/products/store',
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
						addBtn(url+'/loan/products/create', 'New Product');
						editBtn(url+'/loan/products/show', 'Edit');
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
		  