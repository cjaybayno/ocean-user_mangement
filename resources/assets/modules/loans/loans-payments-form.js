/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var table;
	var formNAme = '#loan-payments-make-form';
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		disabledEnterKey();
		$('.select2').select2();
		onChangeLoanTypeHandler();
		dataTables();
		validateOr();
		formSubmit();
	}
	
	function disabledEnterKey() {
		$(document).on('keypress', function(e) {
			if (e.charCode == 13) {
				return false;
			}
		});
	}
	
	function onChangeLoanTypeHandler() {
		$("#loan_type").change(function() {
			$.ajax({
				url: url+'/loan/payments/get-loan-type-name',
				data: {loan_product_id : $(this).val()},
				dataType: 'json',
				success: function(loanProductName) {
					$("#header-title").empty().text(loanProductName);
					 table.ajax.reload();
				}
			});
		});
	}
	
	function dataTables() {
		table = $('#loan-payments-make-table').DataTable({
			columns : [
				{"searchable" : true},
				{"searchable" : false, "orderable" : false},
				{"searchable" : false, "orderable" : false},
				{"searchable" : false, "orderable" : false},
			],
			oLanguage : {
				"sSearch": "Member "
			},
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url: url+'/loan/payments/paginate',
				data : function (d) {
					d.loan_product_id = $("#loan_type").val();
				},
				complete : function (result) {
					var resultCount = table.rows().data().length;
					var payBtnSelector = $(".btn-submit-field");
					if (resultCount > 0) {
						payBtnSelector.show();
					} else {
						payBtnSelector.hide();
					}
				}
			}
		});
	}
	
	function formSubmit() {
		$('#form-submit').on('click', function () {	
			if(formValidation()) {
				loadingModal('show','Processing Payment....');
				ajaxCsrfToken();
				$.ajax({
					url: url+'/loan/payments/store',
					type: "post",
					data: {data: paymentFormData() },	
					dataType: 'json',
					complete: function() {
						loadingModal('close');
					},
					error: function(result) {
						notifier('danger','#loan-payments-make-result', oops);
					},
					success: function(result) {
						console.log(result);
						$('form .btn-submit-field').hide();
						$('input, textarea').attr('readonly', true);
						$('.flat, select').attr('disabled', true);
						notifier('success','#loan-payments-make-result', result.message);
					}
				});
			}
			return false;
		});
		$('.clear-btn').click(function() { $(formNAme).parsley().reset() });
	}
	
	function formValidation() {
		$(formNAme).parsley().validate();
		return $(formNAme).parsley().isValid();
	}
	
	function validateOr() {
		window.Parsley.addAsyncValidator('validateOR', function (xhr) {
			return xhr.status !== 404;
		}, 	url+'/loan/payments/validate-or');
		
		window.Parsley
			.addValidator('notEqual', {
				requirementType: 'string',
				validateString: function(value, requirement) {
					var datableRowCount = table.rows().data().length;
					var counter = 0;
					for(var i = 0; i < datableRowCount; i++) {
						if (value == $(requirement).eq(i).val()) {
							counter++;
						}
					}
					
					if (counter >= 2) return false;
				},
				messages: {
					en: ValidatePaymentOrSameFieldMessage
				}
		  });
	}
	

	function paymentFormData() {
		var datableRowCount   = table.rows().data().length;
		var paymentIdSelector = $(".payment_id");
		var data = [];
		for(var i = 0; i < datableRowCount; i++) {
			var rowData = {
				payment_id     : paymentIdSelector.eq(i).val(),
				payment_amount : paymentIdSelector.eq(i).closest('tr').find('#payment_amount').val(),
				payment_or     : paymentIdSelector.eq(i).closest('tr').find('#payment_or').val(),
			}
			data.push(rowData);
		}
		
		return data;
	}