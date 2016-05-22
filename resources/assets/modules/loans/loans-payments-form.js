/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var table;
	var formNAme = '#payments-make-form';
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		disabledEnterKey();
		$('.select2').select2();
		onChangeLoanTypeHandler();
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
		$("#product_type").change(function() {
			var headerTitleSelector  = $("#header-title");
			var paymentTableSelector = $("#payments-make-table");
			var payBtnSelector 		   = $(".btn-submit-field");
			if ($(this).val() != '') {
				paymentTableSelector.show(); 
				dataTables();
				$.ajax({
					url: route+'/get-product-type-name',
					data: {product_id : $(this).val()},
					dataType: 'json',
					success: function(productName) {
						headerTitleSelector.empty().text(productName+'  Payments ');
						table.ajax.reload();
					}
				});
			} else {
				headerTitleSelector.empty().text('Payments Form');
				paymentTableSelector.hide();
				payBtnSelector.hide();
				table.destroy();
			}
			
		});
	}
	
	function dataTables() {
		//$.fn.dataTableExt.sErrMode = 'throw';
		table = $('#payments-make-table').DataTable({
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
			bRetrieve : true,
			ajax: {
				url: route+'/paginate-payment-form',
				data : function (d) {
					d.product_id = $("#product_type").val();
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
					url: route+'/store',
					type: "post",
					data: {data: paymentFormData() },	
					dataType: 'json',
					complete: function() {
						loadingModal('close');
					},
					error: function(result) {
						notifier('danger','#payments-make-result', oops);
					},
					success: function(result) {
						$('form .btn-submit-field').hide();
						$('input, textarea').attr('readonly', true);
						$('.flat, select').attr('disabled', true);
						notifier('success','#payments-make-result', result.message);
						addBtn(route+'/form', 'Make Another Payment');
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
		}, 	route+'/validate-or');
		
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
		var IdSelector = $(".id");
		var data = [];
		for(var i = 0; i < datableRowCount; i++) {
			var rowData = {
				id 				: IdSelector.eq(i).val(),
				type 			: $('.type').val(),
				payment_amount 	: IdSelector.eq(i).closest('tr').find('#payment_amount').val(),
				payment_or     	: IdSelector.eq(i).closest('tr').find('#payment_or').val(),
			}
			data.push(rowData);
		}
		
		return data;
	}