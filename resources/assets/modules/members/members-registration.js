/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var formNAme  = '#member-registration-form';
	var resultDiv = '#member-registration-result';
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.select2').select2();
		birthDateHandler();
		selectProvinceCity();
		selectBrgyTown();
		formSubmit();
	}
	
	function birthDateHandler() {
		var selector = "#birth_date";
		$(selector).daterangepicker({
			singleDatePicker : true,
			calender_style : "picker_2",
			showDropdowns: true,
			startDate : moment().format('MM/DD/YYYY'),
			maxDate :  moment().format('MM/DD/YYYY'), //moment(moment().get('year')+'-01-01').subtract(80, 'years').format('MM/DD/YYYY'),
		});
	}
	
	function selectProvinceCity() {
		$('#province_city').change(function() {
			$('#brgy_town').empty().attr('disabled', true);
			$.ajax({url: url+"/members/brgy-town/"+$(this).val(),
				dataType: "json",
				success: function(result) {
					var selectData = [];
					$.each(result, function(key, value) {
						if (value == 'SELECT BARANGAY/TOWN') {
							selectData.push({'id': ' ', 'text': value});
						} else {
							selectData.push({'id': key, 'text': value});
						}
					});
					$('#brgy_town').select2({
						data: selectData
					}).removeAttr('disabled');
				}
			});
		});
	}
	
	function selectBrgyTown() {
		$('#brgy_town').change(function() {
			$('#zipcode').empty();
			$.ajax({url: url+"/members/zipcode/"+$(this).val(),
				dataType: "json",
				success: function(result) {
					$('#zipcode').val(result);
				}
			});
		});
	}
	
	function formSubmit() {
		$('#form-submit').on('click', function () {
			if(formValidation()) {
				loadingModal('show','Registration in process....');
				ajaxCsrfToken();
				$.ajax({
					url: url+'/members/store',
					type: "post",
					data: $('input, select').serialize(),
					dataType: 'json',
					complete: function() {
						loadingModal('close');
					},
					error: function(result) {
						notifier('danger',resultDiv, oops);
					},
					success: function(result) {
						$('form .btn-submit-field').hide();
						$('input, textarea').attr('readonly', true);
						$('.flat, select').attr('disabled', true);
						notifier('success',resultDiv, result.message);
						addBtn(url+'/members/register', 'Add New Member');
					}
				});
			}
			return false;
		});
		$('.clear-btn').click(function() { $(formNAme).parsley().reset() });
	}
	
	function formValidation() {
		$(formNAme).parsley().validate();
		return $(formNAme).parsley().isValid();
	}