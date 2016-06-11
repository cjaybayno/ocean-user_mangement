/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var addMenuFormId  = '#add-menu-form'; 
	var addMenuModalId = '#add-menu-modal'
	
	var editMenuFormId  = '#edit-menu-form'; 
	var editMenuModalId = '#edit-menu-modal';
	
	var reorderFormId   = '#reorder-module-form';
	var reorderModalId  = '#reorder-module-modal';
	
	var addSubMenuFormId  = '#add-submenu-form';
	var addSubMenuModalId = '#add-submenu-modal';
	
	var editSubMenuFormId  = '#edit-submenu-form';
	var editSubMenuModalId = '#edit-submenu-modal';
	
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		sortable();
		clickIconSlctionHndlr();
		inputAddMenuHdlr();
		inputEditMenuHdlr();
		inputAddSubMenuHdlr();
		inputEditSubMenuHdlr();
		keyupInputHndlr();
		clickAddMenuBtn();
		clickConfirmReorder();
		clickConfirmAddMenu();
		clickConfirmEditMenu();
		clickConfirmAddSubMenu();
		clickConfirmEditSubMenu();
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
	
	
	function keyupInputHndlr() {
		$(".replace-space").keyup(function () {
			this.value = this.value.replace(/ /g, "_");
		});
	}
	
	function clickIconSlctionHndlr() {
		$('.fa-hover').click(function() {
			var selectedIcon = $(this).find('i').attr('class');
			$('.route').val(selectedIcon);
			$('.select-icon-btn').html('<i class="'+selectedIcon+'"></i> <code>'+selectedIcon+'</code>');
			$('#list-icon-modal').modal('hide');
		});
	}
	
	function inputAddMenuHdlr() {
		$(addMenuFormId+' #name').on('blur', function() {
			validateModuleName(addMenuFormId);
			singleInputValidation(this);
		});
		
		$(addMenuFormId+' #label').on('blur', function() {
			validateModuleLabel(addMenuFormId);
			singleInputValidation(this);
		});
		
		$(addMenuFormId+' #route').on('blur', function() {
			validateModuleRoute(addMenuFormId);
			singleInputValidation(this);
		});
	}
	
	function inputEditMenuHdlr() {
		$(editMenuFormId+' #name').on('keyup', function() {
			editMenuValidation();
		});
		
		$(editMenuFormId+' #label').on('keyup', function() {
			editMenuValidation();
		});
		
		$(editMenuFormId+' #route').on('blur', function() {
			editMenuValidation();
		});
		
		$(editMenuFormId+' #route').on('keyup', function() {
			editMenuValidation();
		});
		
		$(editMenuFormId+' #active').on('change', function() {
			editMenuValidation();
		});
		
		$(editMenuFormId+' .select-icon-btn').on('click', function() {
			editMenuValidation();
		});
	}
	
	function inputAddSubMenuHdlr() {
		$(addSubMenuFormId+' #name').on('blur', function() {
			validateModuleName(addSubMenuFormId);
			singleInputValidation(this);
		});
		
		$(addSubMenuFormId+' #label').on('blur', function() {
			validateModuleLabel(addSubMenuFormId);
			singleInputValidation(this);
		});
		
		$(addSubMenuFormId+' #route').on('blur', function() {
			validateModuleRoute(addSubMenuFormId);
			singleInputValidation(this);
		});
	}
	
	function inputEditSubMenuHdlr() {
		$(editSubMenuFormId+' #name').on('keyup', function() {
			editSubMenuValidation();
		});
		
		$(editSubMenuFormId+' #label').on('keyup', function() {
			editSubMenuValidation();
		});
		
		$(editSubMenuFormId+' #route').on('blur', function() {
			editSubMenuValidation();
		});
		
		$(editSubMenuFormId+' #route').on('keyup', function() {
			editSubMenuValidation();
		});
		
		$(editSubMenuFormId+' #active').on('change', function() {
			editSubMenuValidation();
		});
	}
	
	function clickAddMenuBtn() {
		$('#add-menu-btn').click(function(){
			$(addMenuFormId).parsley().destroy();
			$(addMenuFormId+' .action-input').val(' ');
			$('.select-icon-btn').html('<span class="fa fa-location-arrow"></span>');
		});
	}
	
	function clickEditMenuBtn(encryptId) {
		$(editMenuFormId).parsley().destroy();
		$(editMenuFormId+' #confirm-btn').hide();
		$(editMenuFormId+' input .action-input').empty();
		$.ajax({
			url: route+'/get-menu-info/'+encryptId,
			dataType: 'json',
			success: function(result) {
				$.each(result, function( index, value ) {
				  $(editMenuFormId+' #'+index).val(value);
				});
				$(editMenuFormId+' #menuEncryptId').val(encryptId);
				
				$('.select-icon-btn').html('<i class="'+result.icon+'"></i> <code>'+result.icon+'</code>');
			}
		});
	}
	
	function clickEditSubMenuBtn(encryptId) {
		$(editSubMenuFormId).parsley().destroy();
		$(editSubMenuFormId+' #confirm-btn').hide();
		$(editSubMenuFormId+' input .action-input').empty();
		$.ajax({
			url: route+'/get-menu-info/'+encryptId,
			dataType: 'json',
			success: function(result) {
				$.each(result, function( index, value ) {
				  $(editSubMenuFormId+' #'+index).val(value);
				});
				$(editSubMenuFormId+' #menuEncryptId').val(encryptId);				
			}
		});
	}
	
	function clickAddSubMenuBtn(encryptId) {
		$(addSubMenuFormId+' #encryptId').val(encryptId);
		$(addSubMenuFormId+' .action-input').val(' ');
		$(addSubMenuFormId).parsley().destroy();
	}
	
	function clickConfirmAddMenu() {
		$(addMenuFormId+' #confirm-btn').on('click', function () {
			var formData = $(addMenuFormId).serialize();
			if (addMenuValidation()) {
				loadingBar(addMenuModalId+' .load-bar', 'in progess...');
				$(addMenuModalId+' .action-input').attr('disabled', true);
				$(addMenuModalId+' .action-btn').hide();
				ajaxCsrfToken();
				$.ajax({
					url: route+"/store-menu",
					type: "post",
					data: formData,
					dataType: 'json',
					complete: function() {
						loadingBarClose(addMenuModalId+' .load-bar');
					},
					error: function(result) {
						$(addMenuModalId+' .action-btn').show();
						notifier('danger',addMenuModalId+' .load-bar-notif', oops);
					},
					success: function(result) {
						$(addMenuModalId+' .close-btn-done').show();
						notifier('success', addMenuModalId+' .load-bar-notif', result.message);
					}
				});
			}
			return false;
		});
	}
	
	function clickConfirmEditMenu() {
		$(editMenuFormId+' #confirm-btn').on('click', function () {
			var formData = $(editMenuFormId).serialize();
			if (editMenuValidation()) {
				loadingBar(editMenuModalId+' .load-bar', 'in progess...');
				$(editMenuModalId+' .action-input').attr('disabled', true);
				$(editMenuModalId+' .action-btn').hide();
				ajaxCsrfToken();
				$.ajax({
					url: route+"/update-menu",
					type: "post",
					data: formData,
					dataType: 'json',
					complete: function() {
						loadingBarClose(editMenuModalId+' .load-bar');
					},
					error: function(result) {
						$(editMenuModalId+' .action-input').removeAttr('disabled');
						$(editMenuModalId+' .action-btn').show();
						notifier('danger',editMenuModalId+' .load-bar-notif', oops);
					},
					success: function(result) {
						$(editMenuModalId+' .close-btn-done').show();
						notifier('success', editMenuModalId+' .load-bar-notif', result.message);
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
	
	function clickConfirmAddSubMenu() {
		$(addSubMenuFormId+' #confirm-btn').on('click', function () {
			var formData = $(addSubMenuFormId).serialize();
			if (addSubMenuValidation()) {
				loadingBar(addSubMenuModalId+' .load-bar', 'in progess...');
				$(addSubMenuModalId+' .action-input').attr('disabled', true);
				$(addSubMenuModalId+' .action-btn').hide();
				ajaxCsrfToken();
				$.ajax({
					url: route+"/store-menu",
					type: "post",
					data: formData,
					dataType: 'json',
					complete: function() {
						loadingBarClose(addSubMenuModalId+' .load-bar');
					},
					error: function(result) {
						$(addSubMenuModalId+' .action-input').removeAttr('disabled');
						$(addSubMenuModalId+' .action-btn').show();
						notifier('danger',addSubMenuModalId+' .load-bar-notif', oops);
					},
					success: function(result) {
						$(addSubMenuModalId+' .close-btn-done').show();
						notifier('success', addSubMenuModalId+' .load-bar-notif', result.message);
					}
				});
			}
			return false;
		});
	}
	
	function clickConfirmEditSubMenu() {
		$(editSubMenuFormId+' #confirm-btn').on('click', function () {
			var formData = $(editSubMenuFormId).serialize();
			if (editSubMenuValidation()) {
				loadingBar(editSubMenuModalId+' .load-bar', 'in progess...');
				$(editSubMenuModalId+' .action-input').attr('disabled', true);
				$(editSubMenuModalId+' .action-btn').hide();
				ajaxCsrfToken();
				$.ajax({
					url: route+"/update-menu",
					type: "post",
					data: formData,
					dataType: 'json',
					complete: function() {
						loadingBarClose(editSubMenuModalId+' .load-bar');
					},
					error: function(result) {
						$(editSubMenuModalId+' .action-input').removeAttr('disabled');
						$(editSubMenuModalId+' .action-btn').show();
						notifier('danger',editSubMenuModalId+' .load-bar-notif', oops);
					},
					success: function(result) {
						$(editSubMenuModalId+' .close-btn-done').show();
						notifier('success', editSubMenuModalId+' .load-bar-notif', result.message);
					}
				});
			}
			return false;
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
	
	function singleInputValidation(selector) {
		instance = $(selector).parsley();
		instance.validate();
		instance.isValid();
	}
	
	function addMenuValidation() {
		validateModuleName(addMenuFormId);
		validateModuleLabel(addMenuFormId);
		validateModuleRoute(addMenuFormId);
		$(addMenuFormId).parsley().validate();
		return $(addMenuFormId).parsley().isValid();
	}
	
	function addSubMenuValidation() {
		validateModuleName(addSubMenuFormId);
		validateModuleLabel(addSubMenuFormId);
		validateModuleRoute(addSubMenuFormId);
		$(addSubMenuFormId).parsley().validate();
		return $(addSubMenuFormId).parsley().isValid();
	}
	
	function editMenuValidation() {
		validateModuleName(editMenuFormId);
		validateModuleLabel(editMenuFormId);
		validateModuleRoute(editMenuFormId);
		$(editMenuFormId).parsley().validate();
		var valid = $(editMenuFormId).parsley().isValid();
		if (valid || valid == null) {
			$(editMenuFormId+' #confirm-btn').show();
		} else {
			$(editMenuFormId+' #confirm-btn').hide();
		}
		return valid;
	}
	
	function editSubMenuValidation() {
		validateModuleName(editSubMenuFormId);
		validateModuleLabel(editSubMenuFormId);
		validateModuleRoute(editSubMenuFormId);
		$(editSubMenuFormId).parsley().validate();
		var valid = $(editSubMenuFormId).parsley().isValid();
		if (valid || valid == null) {
			$(editSubMenuFormId+' #confirm-btn').show();
		} else {
			$(editSubMenuFormId+' #confirm-btn').hide();
		}
		return valid;
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
					"encryptId" : $(formId+' #menuEncryptId').val(),
					"name"      : $(formId+' #name').val()
				}
			}
		);
	}
	
	function validateModuleLabel(formId) {
		var selector = $(formId+" #label");
		var valid;
		selector.attr('data-parsley-remote', '');
		selector.attr('data-parsley-remote-validator', 'validateModuleLabel');
		selector.attr('data-parsley-remote-message', validateModuleLabelMessage);
		window.Parsley.addAsyncValidator('validateModuleLabel', function (xhr) {
			return xhr.status !== 404;
			}, route+'/validate-module-label', {
				"dataType" : "jsonp", 
				"data": {
						"encryptId" : $(formId+' #menuEncryptId').val(),
						"isMenu"	: true,
						"label"     : $(formId+' #label').val(),
				}
			}
		);
	}
	
	function validateModuleRoute(formId) {
		var selector = $(formId+" #route");
		var valid;
		selector.attr('data-parsley-remote', '');
		selector.attr('data-parsley-remote-validator', 'validateModuleRoute');
		selector.attr('data-parsley-remote-message', validateModuleRouteMessage);
		window.Parsley.addAsyncValidator('validateModuleRoute', function (xhr) {
			return xhr.status !== 404;
			}, route+'/validate-module-route', {
				"dataType" : "jsonp", 
				"data": {"route"  : selector.val()}
			}
		);
	}
