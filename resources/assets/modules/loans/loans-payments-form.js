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
				}
			}
		});
	}
