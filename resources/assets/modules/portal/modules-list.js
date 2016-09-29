/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var editFormId  = '#edit-module-form';
	var editModalId = '#edit-module-modal';
	
	var addFormId  = '#add-module-form';
	var addModalId = '#add-module-modal';
	
	var reorderFormId   = '#reorder-module-form';
	var reorderModalId  = '#reorder-module-modal';
	
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		dataTables();
		clickConfirmEdit();
		clickConfirmAdd();
		clickConfirmReorder();
		keyupInputHndlr();
		inputAddModuleHdlr();
		inputEditModuleHdlr();
		clickAddModuleBtn();
		sortable();
	}
	
	function sortable() {
		$('#reorder-module-btn').click(function() {
			$("#sortable").sortable('refreshPositions');
		});
		
		$('#sortable').sortable({
		  placeholder: "ui-state-highlight"
		});
		
		$('#sortable').disableSelection();
	}
	
	function inputAddModuleHdlr(){
		$(addFormId+' #name').on('blur', function() {
			validateModuleName(addFormId);
			singleInputValidation(this);
		});
		
		$(addFormId+' #label').on('blur', function() {
			validateModuleLabel(addFormId);
			singleInputValidation(this);
		});
	}
	
	function inputEditModuleHdlr() {
		$(editFormId+' input').on('keyup', function() {
			editFormValidation();
		});
		
		$(editFormId+' select').on('change', function() {
			editFormValidation();
		});
	}
	
	function keyupInputHndlr() {
		$(".replace-space").keyup(function () {
			this.value = this.value.replace(/ /g, "_");
		});
	}
	 
	function dataTables() {
		$('#modules-list').DataTable({
			columns : [
				{"searchable" : true, "orderable" : false},
				{"searchable" : false, "orderable" : false},
				{"searchable" : false, "orderable" : false},
				{"searchable" : false, "orderable" : false},
			],
			oLanguage : {
				"sSearch": "Label "
			},
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: route+'/paginate',
		});
	}
	
	function clickAddModuleBtn() {
		$('#add-module-btn').click(function(){
			$(addFormId).parsley().destroy();
			$(addFormId+' .action-input').val(' ');
		});
	}
	
	function clickEditModuleModal(encryptId) {
		$(editFormId).parsley().destroy();
		$(editFormId+' #confirm-btn').hide();
		$(editFormId+' input .action-input').empty();
		$.ajax({
			url: route+'/get-module-info/'+encryptId,
			dataType: 'json',
			success: function(result) {
				$.each(result, function( index, value ) {
				  $('#'+index).val(value);
				});
				$(editFormId+' #encryptId').val(encryptId);
			}
		});
	}
	
	function clickConfirmEdit() {
		$(editModalId+' #confirm-btn').on('click', function () {
			var formData = $(editFormId).serialize();
			if (editFormValidation()) {
				loadingBar(editModalId+' .load-bar', 'Modify In process...');
				$(editModalId+' .action-input').attr('disabled', true);
				$(editModalId+' .action-btn').hide();
				ajaxCsrfToken();
				$.ajax({
					url: route+"/update-module",
					type: "post",
					data: formData,
					dataType: 'json',
					complete: function() {
						loadingBarClose(editModalId+' .load-bar');
					},
					error: function(result) {
						$(editModalId+' .action-btn').show();
						$(editModalId+' .action-input').removeAttr('disabled');
						notifier('danger',editModalId+' .load-bar-notif', oops);
					},
					success: function(result) {
						$(editModalId+' .close-btn-done').show();
						$(editModalId+' .action-input').attr('disabled', true);
						notifier('success', editModalId+' .load-bar-notif', result.message);
					}
				});
			}
			return false;
		});
	}	
	
	function clickConfirmAdd() {
		$(addModalId+' #confirm-btn').on('click', function () {
			var formData = $(addFormId).serialize();
			if (addFormValidation()) {
				loadingBar(addModalId+' .load-bar', 'In process...');
				$(addModalId+' .action-input').attr('disabled', true);
				$(addModalId+' .action-btn').hide();
				ajaxCsrfToken();
				$.ajax({
					url: route+"/store-module",
					type: "post",
					data: formData,
					dataType: 'json',
					complete: function() {
						loadingBarClose(addModalId+' .load-bar');
					},
					error: function(result) {
						$(addModalId+' .action-btn').show();
						$(addModalId+' .action-input').removeAttr('disabled');
						notifier('danger',addModalId+' .load-bar-notif', oops);
					},
					success: function(result) {
						$(addModalId+' .close-btn-done').show();
						$(addModalId+' .action-input').attr('disabled', true);
						notifier('success', addModalId+' .load-bar-notif', result.message);
					}
				});
			}
			return false;
		});
	}
	
	function clickConfirmReorder() {
		$(reorderModalId+' #confirm-btn').on('click', function () {			
			loadingBar(reorderModalId+' .load-bar', 'In process...');
			$(reorderModalId+' .action-input').attr('disabled', true);
			$(reorderModalId+' .action-btn').hide();
			ajaxCsrfToken();
			$.ajax({
				url: route+"/reorder-module",
				type: "post",
				data: {data: reorderData() },
				dataType: 'json',
				complete: function() {
					loadingBarClose(reorderModalId+' .load-bar');
				},
				error: function(result) {
					$(reorderModalId+' .action-btn').show();
					notifier('danger',reorderModalId+' .load-bar-notif', oops);
				},
				success: function(result) {
					$(reorderModalId+' .close-btn-done').show();
					$(reorderModalId+' #sortable').sortable( "option", { disabled: true } );
					notifier('success', reorderModalId+' .load-bar-notif', result.message);
				}
			});
			
		});
	}
	
	function reorderData() {
		var data = [];
			$(reorderModalId+' #sortable').find('li').each(function(i, li) {
				var rowData = {
					id 	  : $(this).attr('id'),
					order : i,
				};
				data.push(rowData);
			})
			
		return data;
	}
	
	function editFormValidation() {
		validateModuleName(editFormId);
		validateModuleLabel(editFormId);
		$(editFormId).parsley().validate();
		var valid = $(editFormId).parsley().isValid();
		if (valid || valid == null) {
			$(editFormId+' #confirm-btn').show();
		} else {
			$(editFormId+' #confirm-btn').hide();
		}
		return valid;
	}
	
	function addFormValidation() {
		validateModuleName(addFormId);
		validateModuleLabel(addFormId);
		$(addFormId).parsley().validate();
		return $(addFormId).parsley().isValid();
	}
	
	function singleInputValidation(selector) {
		instance = $(selector).parsley();
		instance.validate();
		instance.isValid();
	}
	
	function validateModuleName(formId) {
		var selector = $(formId+" #name");
		var valid;
		selector.attr('data-parsley-remote', '');
		selector.attr('data-parsley-remote-validator', 'validateModuleName');
		selector.attr('data-parsley-remote-message', validateModuleNameMessage);
		window.Parsley.addAsyncValidator('validateModuleName', function (xhr) {
			return xhr.status !== 404;
			}, route+'/validate-module-name', {
				"dataType" : "jsonp", 
				"data": {
						"encryptId"  : $(formId+' #encryptId').val(),
						"name"      : $(formId+' #name').val(),
				}
			}
		);
	}
	
	function validateModuleLabel(formId) {
		// var selector = $(formId+" #label");
		// var valid;
		// selector.attr('data-parsley-remote', '');
		// selector.attr('data-parsley-remote-validator', 'validateModuleLabel');
		// selector.attr('data-parsley-remote-message', validateModuleLabelMessage);
		// window.Parsley.addAsyncValidator('validateModuleLabel', function (xhr) {
			// return xhr.status !== 404;
			// }, route+'/validate-module-label', {
				// "dataType" : "jsonp", 
				// "data": {
						// "encryptId"  : $(formId+' #encryptId').val(),
						// "label"       : $(formId+' #label').val(),
				// }
			// }
		// );
	}