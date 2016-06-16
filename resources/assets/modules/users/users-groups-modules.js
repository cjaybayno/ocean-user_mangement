/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	menusUlDivId = $('#group-module-access-list');
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		slidesModules();
		checkedModules();
		onCheckHndlr();
		UpdateModule();
	}
	
	function onCheckHndlr() {
		$('[type=checkbox]').on('ifChecked', function(event) {
			var parentId  = $('#'+$(this).attr('parent-id'));
				parentId.iCheck('check');
				
			// var childId  = $('[parent-id='+$(this).attr('id')+']');
				// childId.iCheck('check');
		});
		
	}
	
	function checkedModules() {
		$.each(menusId, function(i, val) {
			menusUlDivId.find('#'+val).iCheck('check'); 
		}); 
	}
	
	function slidesModules() {
		menusUlDivId.find('li').click(function(e) {
			if( $(this).find('>ul').hasClass('active') ) {
				$(this).children('ul').removeClass('active').children('li').slideUp();
				e.stopPropagation();
			} else {
				$(this).children('ul').addClass('active').children('li').slideDown();
				e.stopPropagation();
			}
		});
	}
	
	function UpdateModule() {
		$('#update-btn').on('click', function () {
			var resultSlctor = '#user-group-modules-modify-result';
			loadingModal('show','Processing ....');
			ajaxCsrfToken();
			$.ajax({
				url: route+'/update-group-module',
				type: "post",
				data: {
					encryptId : $('#encryptId').val(),
					update_menusId  : checkedData(),
				},
				dataType: 'json',
				complete: function() {
					loadingModal('close');
					scrollTop();
				},
				error: function(result) {
					notifier('danger',resultSlctor, oops);
				},
				success: function(result) {
					$('input, textarea').attr('readonly', true);
					notifier('success',resultSlctor, result.message);
				}
			});
			return false;
		});
	}
	
	
	function checkedData() {
		var data = [];
		$('[type=checkbox]').each(function() {
			if ( $(this).iCheck('update')[0].checked ) {
				data.push( $(this).attr('id') );
			}
		});
		
		return data.sort(function(a, b){return a-b});
	}