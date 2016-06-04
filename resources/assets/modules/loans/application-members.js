/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		onKeyupMemberIdHandler();
		onChangeMemberFullNameHandler();
	}
	
	function onKeyupMemberIdHandler() {
		$('#member_last_name').keyup(function() {
			memberNameSelector = $("#member_name");
			memberNameSelector.empty().removeAttr('disabled');
			if ($(this).val() != '') {
				$.ajax({
					url: route+'/get-member-in-last-name',
					data: {last_name : $(this).val()},
					dataType: 'json',
					success: function(result) {
						var formatDAta = selec2DataFormat(result, 'Select Member Name', '#member_name');
						memberNameSelector.select2({data: formatDAta});
					}
				});
			}
		});
	}
	
	function onChangeMemberFullNameHandler() {
		$('#member_name').change(function() {
			if ($(this).val() != ' ') {
				loadingModal('show', 'Please wait....')
				$.ajax({
					url: route+'/members-record',
					data: {member_id : $(this).val()},
					dataType: 'json',
					success: function(result) {
						loadingModal('close');
						$("#members-record-result").empty().html(result);
					}
				});
			} else {
				$("#members-record-result").empty();
			}
		});
	}
	