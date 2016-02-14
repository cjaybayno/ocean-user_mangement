/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('#change_status').select2();
		disabledInput();
		expiryDateRange('#expiry');
		extendEXpiryDatePicker('#extend_expiry');
		clickConfirmExtend();
		clickConfirmTerminate();
		clickConfirmChangeStatus();
		clickConfirmChangeGroup();
		clickModalCloseBtnDone();
	}
	
	function disabledInput() {
		var formID = '#user-register-form';
		$(formID+' input, '+formID+' textarea').attr('readonly', true);
		$(formID+' #is_login, '+formID+' select').attr('disabled', true);
	}
	
	function expiryDateRange(selector) {
		$(selector).val(moment(dateRangeEnd).format('D MMMM YYYY'));
	}
	
	function extendEXpiryDatePicker(selector) {
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
	
	function clickConfirmExtend() {
		var modalID = '#extend-expiry-user-modal';
		$(modalID+' #confirm-btn').on('click', function () {
			loadingBar(modalID+' .load-bar', 'Extention In process...');
			$(modalID+' .action-input').hide();
			$(modalID+' .action-btn').hide();
			ajaxCsrfToken();
			$.ajax({
				url: url+"/users/extend-expiry",
				type: "post",
				data: {
					userId : encrptyId, 
					extend_expiry : $('input[name=daterangepicker_end]').val() 
				},
				dataType: 'json',
				error: function(result) {
					$(modalID+' .action-btn').show();
					notifier('danger',modalID+' .load-bar-notif', oops);
				},
				success: function(result) {
					$(modalID+' .close-btn-done').show();
					notifier('success', modalID+' .load-bar-notif', result.message);
				}
			});
			
		});
	}
	
	function clickConfirmTerminate() {
		var modalID = '#terminate-user-modal';
		$(modalID+' #confirm-btn').on('click', function () {
			loadingBar(modalID+' .load-bar', 'Termination In process...');
			$(modalID+' .action-input').hide();
			$(modalID+' .action-btn').hide();
			ajaxCsrfToken();
			$.ajax({
				url: url+"/users/terminate",
				type: "post",
				data: { userId : encrptyId },
				dataType: 'json',
				error: function(result) {
					$(modalID+' .action-btn').show();
					notifier('danger',modalID+' .load-bar-notif', oops);
				},
				success: function(result) {
					$(modalID+' .close-btn-done').show();
					notifier('success', modalID+' .load-bar-notif', result.message);
				}
			});
			
		});
	}
	
	function clickConfirmChangeStatus() {
		var modalID = '#change-status-user-modal';
		$(modalID+' #confirm-btn').on('click', function () {
			loadingBar(modalID+' .load-bar', 'Changing status in process...');
			$(modalID+' .action-input').attr('disabled', true);
			$(modalID+' .action-btn').hide();
			ajaxCsrfToken();
			$.ajax({
				url: url+"/users/change-status",
				type: "post",
				data: {
					userId : encrptyId,
					change_status : $('#change_status').val()
				},
				dataType: 'json',
				error: function(result) {
					$(modalID+' .action-btn').show();
					$(modalID+' .close-btn').hide();
					$(modalID+' .action-input').removeAttr('disabled');
					notifier('danger',modalID+' .load-bar-notif', oops);
				},
				success: function(result) {
					$(modalID+' .close-btn-done').show();
					notifier('success', modalID+' .load-bar-notif', result.message);
				}
			});
			
		});
	}
	
	function clickConfirmChangeGroup() {
		var modalID = '#change-group-user-modal';
		$(modalID+' #confirm-btn').on('click', function () {
			loadingBar(modalID+' .load-bar', 'Changing group in process...');
			$(modalID+' .action-input').attr('disabled', true);
			$(modalID+' .action-btn').hide();
			ajaxCsrfToken();
			$.ajax({
				url: url+"/users/change-group",
				type: "post",
				data: {
					userId : encrptyId,
					change_group : $('#change_group').val()
				},
				dataType: 'json',
				error: function(result) {
					$(modalID+' .action-btn').show();
					$(modalID+' .close-btn').hide();
					$(modalID+' .action-input').removeAttr('disabled');
					notifier('danger',modalID+' .load-bar-notif', oops);
				},
				success: function(result) {
					$(modalID+' .close-btn-done').show();
					notifier('success', modalID+' .load-bar-notif', result.message);
				}
			});
			
		});
	}
	
	function clickModalCloseBtnDone() {
		$('.close-btn-done').on('click', function(){ location.reload() });
	}