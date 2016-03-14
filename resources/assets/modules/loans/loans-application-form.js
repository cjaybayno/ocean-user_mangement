/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var formNAme = '#loan-application-create-form';
	
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.select2').select2();
		datePicker('#applied_date'); 
		onBlurAppliedDigits('#loan_amount');
		onBlurAppliedDigits('#capital_buil_up');
		formSubmit();
	}
	
	function onBlurAppliedDigits(selector) {
		$(selector).blur(function () {
			$(this).val(addTwoZero($(this).val()));
		});
	}
	
	function datePicker(selector) {
		/* === default date in input === */
		$(selector).val(moment().format('MM/DD/YYYY'));
		$(selector).daterangepicker({
			singleDatePicker : true,
			calender_style : "picker_3",
			startDate : moment().format('MM/DD/YYYY'),
			maxDate :  moment().format('MM/DD/YYYY'),
		});
	}
	
	function formSubmit() {
		$('#form-submit').on('click', function () {
			if(formValidation()) {
				
			}
			return false;
		});

		$('.clear-btn').click(function() { $(formNAme).parsley().reset() });
	}
	
	
	function formValidation() {
		/* === validate member id === */
		window.Parsley.addAsyncValidator('validateMemberId', function (xhr) {
			return xhr.status !== 404;
		}, url+'/loan/application-validate-member-id');
		
		$(formNAme).parsley().validate();
		
		return $(formNAme).parsley().isValid();
	}
