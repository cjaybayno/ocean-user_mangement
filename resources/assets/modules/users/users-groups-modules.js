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
		$('[type=checkbox]').on('ifClicked', function(event) {
			var parentId  = $('#'+$(this).attr('parent-id'));				
				parentId.iCheck('check');
				
			var currenCheckboxCount = 0;
			var currenCheckbox = $('[parent-id='+$(this).attr('parent-id')+']');
				
			currenCheckbox.on('ifChecked', function(event){
				currenCheckboxCount = $('[parent-id='+$(this).attr('parent-id')+']:checked').length;
				if (currenCheckboxCount == 0) {
					parentId.iCheck('uncheck');
				}
			});
			
			currenCheckbox.on('ifUnchecked', function(event){
				currenCheckboxCount = $('[parent-id='+$(this).attr('parent-id')+']:checked').length;
				if (currenCheckboxCount == 0) {
					parentId.iCheck('uncheck');
				}
			});
				
		});
		
		$('[type=checkbox]').on('ifChecked', function(event) {
			var childId  = $('[parent-id='+$(this).attr('id')+']');
				childId.iCheck('check');
		});
		
		$('[type=checkbox]').on('ifUnchecked', function(event) {
			var childId  = $('[parent-id='+$(this).attr('id')+']');
				childId.iCheck('uncheck');
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