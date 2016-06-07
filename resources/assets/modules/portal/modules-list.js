/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var formId  = '#edit-module-form';
	var modalId = '#edit-module-modal';
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.select2').select2();
		dataTables();
		clickConfirmEdit();
	}
	 
	/* === dataTables === */
	function dataTables() {
		$('#modules-list').DataTable({
			columns : [
				{"searchable" : true},
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false, "orderable" : false},
			],
			oLanguage : {
				"sSearch": "Modules "
			},
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: route+'/paginate',
		});
	}
	
	function clickEditModuleModal(encryptId) {
		$('input .action-input').empty();
		$.ajax({
			url: route+'/get-module-info/'+encryptId,
			dataType: 'json',
			success: function(result) {
				$.each(result, function( index, value ) {
				  $('#'+index).val(value);
				});
				$('#encryptId').val(encryptId);
			}
		});
	}
	
	function clickConfirmEdit() {
		$(modalId+' #confirm-btn').on('click', function () {
			var formData = $(formId).serialize();
			$(formId).parsley().validate();
			if ($(formId).parsley().isValid()) {
				loadingBar(modalId+' .load-bar', 'Modify In process...');
				$(modalId+' .action-input').attr('disabled', true);
				$(modalId+' .action-btn').hide();
				ajaxCsrfToken();
				$.ajax({
					url: route+"/update-module",
					type: "post",
					data: formData,
					dataType: 'json',
					complete: function() {
						loadingBarClose(modalId+' .load-bar');
					},
					error: function(result) {
						$(modalId+' .action-btn').show();
						$(modalId+' .action-input').removeAttr('disabled');
						notifier('danger',modalId+' .load-bar-notif', oops);
					},
					success: function(result) {
						$(modalId+' .close-btn-done').show();
						$(modalId+' .action-input').attr('disabled', true);
						notifier('success', modalId+' .load-bar-notif', result.message);
					}
				});
			}
		});
	}	
	
	function formValidation() {
		$(formId).parsley().validate();
		return $(formId).parsley().isValid();
	}