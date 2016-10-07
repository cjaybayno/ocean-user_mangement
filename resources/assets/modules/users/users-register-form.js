/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var formNAme = '#user-register-form';
	
	var groupAccessDefaultValue = [{ id: ' ', text: '(select entity first)' }];
 
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.select2').select2();
		datePicker('#expiry');
		fileInput('#avatar');
		selectRole();
		selectEntity();
		formSubmit();
		
	}
	
	
	function datePicker(selector) {
		/* === default date in input === */
		$(selector).val( moment().format('MM/DD/YYYY')+' - '+moment().add(6, 'M').format('MM/DD/YYYY') );
		$(selector).daterangepicker({
			ranges: {
			   '1 Day': [moment(), moment().add(1, 'd')],
			   '7 Days': [moment(), moment().add(1, 'w')],
			   '30 Days': [moment(), moment().add(1, 'M')],
			   '3 Months': [moment(), moment().add(3, 'M')],
			   '6 Months': [moment(), moment().add(6, 'M')],
			   '1 Year': [moment(), moment().add(1, 'y')],
			},
		},
		function(start, end, label) {
			$(selector).val(end.format('D MMMM YYYY')+' / '+label);  
       });
		
		$('.calendar.left').hide();
         $('.calendar.right').hide();
         $('.ranges li:last-child' ).hide();
         $('.range_inputs' ).hide();
	}
	
	function fileInput(selector) {
		$(selector).fileinput({
			overwriteInitial: true,
			maxFileSize: 1500,
			showClose: false,
			showCaption: false,
			browseLabel: '',
			removeLabel: '',
			browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
			removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
			removeTitle: 'Cancel or reset changes',
			elErrorContainer: '#kv-avatar-errors',
			msgErrorClass: 'alert alert-block alert-danger',
			layoutTemplates: {main2: '{preview} {remove} {browse}'},
			defaultPreviewContent: typeof itemImages !== 'undefined' ? itemImages : '',
			allowedFileExtensions: ["jpg", "png", "gif"]
		});
	}
	
	function formSubmit() {
		 $('#form-submit').on('click', function () {
			if(formValidation()) {
				loadingModal('show','Saving ....');
				ajaxCsrfToken();
				$.ajax({
					url: route+'/store',
					type: "post",
					data: formData(),
					dataType: 'json',
					cache:false,
					contentType: false,
					processData: false,
					complete: function() {	
						loadingModal('close');
						scrollTop();
					},
					error: function(result) {
						notifier('danger','#user-creation-result', oops);
					},
					success: function(result) {
						$('form .btn').hide();
						$('input, textarea').attr('readonly', true);
						$('#status, select').attr('disabled', true);
						notifier('success','#user-creation-result', result.message);
						editBtn(url+'/users/register', 'New User');
						addBtn(url+'/users/register', 'Edit');
					}
				});
			}
			return false;
		});
		
		$('.clear-btn').click(function() { $(formNAme).parsley().reset() });
	}
	
	function selectRole() {
		$('#role').change(function() {
			var groupAccessSelector = $('#group_access');
			var entitySelector      = $('#entity');
			var entityInputSelector = $('#entity-input');
			var entityId = $('#entity').val();
			groupAccessSelector.empty().attr('disabled', true);
			
			if ($('#role').val() == 0) {
				// role is admin, hide entity input
				entityInputSelector.hide();
				// remove required validation to entity
				entitySelector.removeAttr('required');
				// get group access for admin
				$.ajax({
					url: route+'/get-group-access',
					dataType: 'json',
					success: function(result) {
						groupAccessSelector.select2({data: selec2DataFormat(result)}).removeAttr('disabled');
					}
				});
			} else {
				// role is client, show entity input
				entityInputSelector.show();
				// remove required validation to entity
				entitySelector.attr('required', true);
				if (entityId != '') {
					// get group access for this entity
					$.ajax({
					url: route+'/get-group-access/'+entityId,
					dataType: 'json',
					success: function(result) {
						groupAccessSelector.select2({data: selec2DataFormat(result)}).removeAttr('disabled');
					}
				});
				} else {
					groupAccessSelector.select2({data: groupAccessDefaultValue}).removeAttr('disabled');
				}
				
			}
		});
	}
	
	function selectEntity() {
		$('#entity').change(function() {
			var groupAccessSelector = $('#group_access');
			var entityId = $('#entity').val();
			var urlRequest = '';
			groupAccessSelector.empty().attr('disabled', true);
			
			if (entityId != '') {
				$.ajax({
					url: route+'/get-group-access/'+entityId ,
					dataType: 'json',
					success: function(result) {
						groupAccessSelector.select2({data: selec2DataFormat(result)}).removeAttr('disabled');
					}
				});
			} else {
				groupAccessSelector.select2({data: groupAccessDefaultValue}).removeAttr('disabled');
			}
		});
	}
	
	function formData() {
		var data = new FormData();
		
		/* === add input file in FormData === */
		$.each($('#avatar')[0].files, function(i, file) {
			data.append('avatar', file);
		});
		/* === add input text in FormData === */
		$('input, select, textarea').each(function(){
			var 
				currentSelector = $(this),
				value;
			
			if (currentSelector.attr('type') === 'checkbox') {
				value = ($("#"+currentSelector.attr('name')).is(':checked')) ? true : false; 
			} else {
				value = currentSelector.val();
			}
			
			data.append(currentSelector.attr('name'), value);
		})

		return data;
	}
	
	function formValidation() {
		/* === validate username availability === */
		window.Parsley.addAsyncValidator('validateUsername', function (xhr) {
			return xhr.status !== 422;
		}, route+'/validate-username');
		
		$(formNAme).parsley().validate();
		
		return $(formNAme).parsley().isValid();
	}
		  