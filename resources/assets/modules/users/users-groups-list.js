/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.select2').select2();
		dataTables();
		clickConfirmAdd();
		clickConfirmEdit();
		clickModalCloseBtnDone();
	}
	
	/* === dataTables === */
	function dataTables() {
		$('#user-group-list').DataTable({
			columns : [
				{"searchable" : true},
				{"searchable" : false},
				{"searchable" : false},
				null
			],
			oLanguage : {
				"sSearch": "Search Group Name"
			},
			responsive: true,
			processing: false,
			serverSide: true,
			//'iDisplayLength': 2,
			ajax: url+'/user/groups/paginate',
		});
	}
	
	/* === this was an onclick function from edit button === */
	function clickEdit(encrptyId) {
		$('.load-bar-notif').empty();
		$('.load-bar').empty();
		var modalID = '#edit-users-group-modal';
		$.ajax({
			url: url+"/user/groups/get-group/"+encrptyId,
			type: "get",
			dataType: 'json',
			complete: function(result) {
				$(modalID).modal('show');
			},
			error: function(result) {
				notifier('danger',modalID+' .load-bar-notif', oops);
			},
			success: function(result) {
				$(modalID+' #encryptId').val(result.encryptId);
				$(modalID+' #group_name').val(result.groupNAme);
				$(modalID+' #group_desc').text(result.groupDesc);
			}
		});			
	}
	
	function clickConfirmEdit() {
		var modalID = '#edit-users-group-modal';
		var formID  = '#edit-user-group-form';
		$(modalID+' #confirm-btn').on('click', function () {
			$(formID).parsley().validate();
			if ($(formID).parsley().isValid()) {
				loadingBar(modalID+' .load-bar', 'Edit In process...');
				$(modalID+' .action-input').attr('disabled', true);
				$(modalID+' .action-btn').hide();
				ajaxCsrfToken();
				$.ajax({
					url: url+"/user/groups/update-group",
					type: "post",
					data: { 
						encryptId : $(modalID+' #encryptId').val(),
						group_name : $(modalID+' #group_name').val(),
						group_desc : $(modalID+' #group_desc').val()
					},
					dataType: 'json',
					complete: function() {
						loadingBarClose(modalID+' .load-bar');
					},
					error: function(result) {
						$(modalID+' .action-btn').show();
						$(modalID+' .action-input').removeAttr('disabled');
						notifier('danger',modalID+' .load-bar-notif', oops);
					},
					success: function(result) {
						$(modalID+' .close-btn-done').show();
						$(modalID+' .action-input').attr('disabled', true);
						notifier('success', modalID+' .load-bar-notif', result.message);
					}
				});
			}
		});
	}	
	
	function clickConfirmAdd() {
		var modalID = '#add-users-group-modal';
		var formID  = '#add-user-group-form';
		$(modalID+' #confirm-btn').on('click', function () {
			$(formID).parsley().validate();
			if ($(formID).parsley().isValid()) {
				loadingBar(modalID+' .load-bar', 'Saving In process...');
				$(modalID+' .action-input').attr('disabled', true);
				$(modalID+' .action-btn').hide();
				ajaxCsrfToken();
				$.ajax({
					url: url+"/user/groups/store-group",
					type: "post",
					data: { 
						group_name   : $(modalID+' #group_name').val(),
						group_entity : $(modalID+' #group_entity').val(),
						group_desc   : $(modalID+' #group_desc').val(),
					},
					dataType: 'json',
					complete: function() {
						loadingBarClose(modalID+' .load-bar');
					},
					error: function(result) {
						$(modalID+' .action-btn').show();
						$(modalID+' .action-input').removeAttr('disabled');
						notifier('danger',modalID+' .load-bar-notif', oops);
					},
					success: function(result) {
						$(modalID+' .close-btn-done').show();
						$(modalID+' .action-input').attr('disabled', true);
						notifier('success', modalID+' .load-bar-notif', result.message);
					}
				});
			}
		});
	}
	
	function clickModalCloseBtnDone() {
		$('.close-btn-done').on('click', function(){ location.reload() });
	}