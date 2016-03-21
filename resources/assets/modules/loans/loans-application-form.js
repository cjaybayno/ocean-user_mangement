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
		disabledEnterKey();
		$('.select2').select2();
		datePicker('#applied_date');
		onBlurAppliedDigits('#loan_amount');
		onBlurAppliedDigits('#capital_build_up');
		onKeyupMemberIdHandler();
		onClickApplicationTypeHandler();
		onChangeLoanTypeHandler();
		onBlurLoanAmountHandler();
		onBlurCapitalBuiildUpHandler();
		formSubmit();
	}
	
	function disabledEnterKey() {
		$(document).on('keypress', function(e) {
			if (e.charCode == 13) {
				return false;
			}
		});
	}
	
	function datePicker(selector) {
		$(selector).val(moment().format('MM/DD/YYYY'));
		$(selector).daterangepicker({
			singleDatePicker : true,
			calender_style : "picker_3",
			startDate : moment().format('MM/DD/YYYY'),
			maxDate :  moment().format('MM/DD/YYYY'),
		});
	}
	
	function onBlurAppliedDigits(selector) {
		$(selector).blur(function() {
			$(this).val(addTwoZero($(this).val()));
		});
	}
	
	function onClickApplicationTypeHandler() {
		$("input[name=application_type]").on('ifClicked', function(event) {
			var appTypeValue = $(this).val();
			if (appTypeValue == 'renewal') {
				$("#outstanding_balance_field").show();
				$("#rebate_field").show();
			}
			if (appTypeValue == 'new') {
				$("#outstanding_balance_field").hide();
				$("#rebate_field").hide();
			}
			if (! $("#loan_type").parsley().isValid()) {
				$(formNAme).parsley().reset();
			}
		});
	}
	
	function onKeyupMemberIdHandler() {
		$('#member_id').keyup(function() {
			if ($(this).val() != '') {
				$.ajax({
					url: url+'/loan/application/get-member-name/'+$(this).val(),
					dataType: 'json',
					success: function(result) {
						$("#member_name").val(result.member_name);
					}
				});
			}
		});
	}
	
	function onChangeLoanTypeHandler() {
		$("#loan_type").change(function() {
			var loanTypeSelector = $("#loan_amount");
			if ($(this).val() != '') {
				loanTypeSelector.removeAttr('disabled');
				loanTypeSelector.attr('placeholder', '0.00');
			} else {
				loanTypeSelector.attr('disabled', true);
				loanTypeSelector.attr('placeholder', '(note: select loan type first)');
				loanTypeSelector.val('');
			}
			if (! loanTypeSelector.parsley().isValid()) {
				$(formNAme).parsley().reset();
			}
		});
	}
	
	function onBlurLoanAmountHandler() {
		$("#loan_amount").blur(function() {
			calculateAdvanceInterest();
		});
	}
	
	function onBlurCapitalBuiildUpHandler() {
		$("#capital_build_up").blur(function() {
			calculateTotalDeduction();
		});
	}
	
	function calculateAdvanceInterest() {
		$.ajax({
			url: url+'/loan/application/cal-advance-interest',
			dataType: 'json',
			data: {loan_amount : $("#loan_amount").val()},
			success: function(advanceInterest) {
				$("#advance_interest").val(addTwoZero(advanceInterest));
				calculateProcessingFee();
			}
		});
	}
	
	function calculateProcessingFee() {
		$.ajax({
			url: url+'/loan/application/cal-processing-fee',
			dataType: 'json',
			data: {
				loan_amount 	: $("#loan_amount").val(),
				loan_product_id : $("#loan_type").val()
			},
			success: function(processingFee) {
				$("#processing_fee").val(addTwoZero(processingFee));
				calculateTotalDeduction();
			}
		});
	}
	
	
	function calculateTotalDeduction() {
		$.ajax({
			url: url+'/loan/application/cal-total-deduction',
			dataType: 'json',
			data: {
				advance_interest : $("#advance_interest").val(),
				processing_fee   : $("#processing_fee").val(),
				capital_build_up  : $("#capital_build_up").val(),
			},
			success: function(totalDeduction) {
				$("#total_deduction").val(addTwoZero(totalDeduction));
				calculateNetProceeds();
			}
		});
	}
	
	function calculateNetProceeds() {
		$.ajax({
			url: url+'/loan/application/cal-net-proceeds',
			dataType: 'json',
			data: {
				loan_amount     : $("#loan_amount").val(),
				total_deduction : $("#total_deduction").val(),
			},
			success: function(netProceeds) {
				$("#net_proceeds").val(addTwoZero(netProceeds));
			}
		});
	}
	
	function formSubmit() {
		$('#form-submit').on('click', function () {
			if(formValidation()) {
				alert('submit');
			}
			return false;
		});
		$('.clear-btn').click(function() { $(formNAme).parsley().reset() });
	}
	
	function formValidation() {
		validateMemberId();
		validateLoanAmount();
		validateCurrentApplication();
		$(formNAme).parsley().validate();
		return $(formNAme).parsley().isValid();
	}
	
	function validateMemberId() {
		window.Parsley.addAsyncValidator('validateMemberId', function (xhr) {
			return xhr.status !== 404;
		}, url+'/loan/application/validate-member-id');
	}
	
	function validateLoanAmount() {
		if ($("#loan_amount").val() != '') {
			var loanAmountSelector = $("#loan_amount");
			loanAmountSelector.attr('data-parsley-remote', '');
			loanAmountSelector.attr('data-parsley-remote-validator', 'validateLoanAmount');
			loanAmountSelector.attr('data-parsley-remote-message', ValidateLoanAmountMessage);
			window.Parsley.addAsyncValidator('validateLoanAmount', function (xhr) {
				return xhr.status !== 404;
			}, 	url+'/loan/application/validate-loan-amount', {
					"dataType" : "jsonp", 
					"data": 
					{ "loan_product_id": $('#loan_type').val() }
				}
			);
		}
	}
	
	function validateCurrentApplication() {
		if ($('input[name=application_type]:checked').val() == 'new') {
			var loanTypeSelector = $("#loan_type");
			loanTypeSelector.attr('data-parsley-remote', '');
			loanTypeSelector.attr('data-parsley-remote-validator', 'validateCurrentApplication');
			loanTypeSelector.attr('data-parsley-remote-message', ValidateCurrentAppMessage);
			/* === validate loan type current application === */
			window.Parsley.addAsyncValidator('validateCurrentApplication', function (xhr) {
				return xhr.status !== 404;
			}, url+'/loan/application/validate-current-application', {
					"dataType" : "jsonp", 
					"data": 
						{ "member_id": $('#member_id').val() }
				}
			);
		}
	}
