/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var formNAme = '#user-register-form';
 
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		disabledinputs();
		dateRange('#expiry');
		fileInput('#avatar');
		formSubmit();
	}
	
	function disabledinputs() {
		$('#username').attr('readonly', true);
		$('#status, #group_access').attr('disabled', true);
	}
	
	function dateRange(selector) {
		/* === default date in input === */
		$(selector).val( moment(dateRangeEnd).format('D MMMM YYYY') );
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
					url: url+'/users/update-profile',
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
						notifier('danger','#user-creation-result', opps);
					},
					success: function(result) {
						$('form .btn').hide();
						$('input, textarea').attr('readonly', true);
						$('#status, select').attr('disabled', true);
						notifier('success','#user-creation-result', result.message);
						editBtn(url+'/users/edit-profile/'+encrptyId, 'Edit');
						
						// add back to profile btn
						$('#view-btn').empty().html(''+
							'<a href="'+url+'/users/show/'+encrptyId+'">'+
								'<button type="button" class="btn btn-block btn-sm btn-primary"><i class="fa fa-arrow-left"></i> back to profile</button>'+
							'</a>'
						);
					}
				});
			}
			return false;
		});
		
		$('.clear-btn').click(function() { $(formNAme).parsley().reset() });
	}
	
	function formData() {
		var data = new FormData();
		var inputNames = [
				'userId',
				'full_name',
				'contact_number',
				'email',
				'remarks'
			];
		
		/* === add input file in FormData === */
		$.each($('#avatar')[0].files, function(i, file) {
			data.append('avatar', file);
		});
		
		/* === add input text in FormData === */
		$.each(inputNames, function(i, name) {	
			data.append(name, $('#'+name).val());
		})

		return data;
	}
	
	function formValidation() {
		$(formNAme).parsley().validate();
		return $(formNAme).parsley().isValid();
	}
		  