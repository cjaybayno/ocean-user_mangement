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
		dataTables();
		clickConfirmEdit();
		keyupInputHndlr();
	}
	
	function keyupInputHndlr() {
		$('input').on('keyup', function() {
			formValidation();
		});
		
		$("#name").keyup(function () {
			this.value = this.value.replace(/ /g, "_");
		});
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
		$(formId).parsley().destroy();
		$('#confirm-btn').hide();
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
			if (formValidation()) {
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
			return false;
		});
	}	
	
	function formValidation() {
		validateModuleName();
		$(formId).parsley().validate();
		var valid = $(formId).parsley().isValid();
		if (valid || valid == null) {
			$('#confirm-btn').show();
		} else {
			$('#confirm-btn').hide();
		}
		
		return $(formId).parsley().isValid();
	}
	
	function validateModuleName() {
		var selector = $("#name");
		var valid;
		selector.attr('data-parsley-remote', '');
		selector.attr('data-parsley-remote-validator', 'validateModuleName');
		selector.attr('data-parsley-remote-message', validateModuleNameMessage);
		window.Parsley.addAsyncValidator('validateModuleName', function (xhr) {
			return xhr.status !== 404;
			}, route+'/validate-module-name', {
				"dataType" : "jsonp", 
				"data": {
						"encryptId"  : $('#encryptId').val(),
						"name"      : $('#name').val(),
				}
			}
		);
	}