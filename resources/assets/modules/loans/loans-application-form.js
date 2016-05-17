/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var formNAme = '#loan-application-create-form';
	var loanTypeCheckedValue = false;
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		numberFormat();
		disabledEnterKey();
		$('.select2').select2();
		datePicker('#applied_date');
		onBlurAppliedDigits('#loan_amount');
		onBlurAppliedDigits('#capital_build_up');
		onBlurAppliedDigits('#outstanding_balance');
		onBlurAppliedDigits('#monthly_amortization');
		onKeyupMemberIdHandler();
		onClickApplicationTypeHandler();
		onChangeLoanTypeHandler();
		onBlurLoanAmountHandler();
		onBlurCapitalBuiildUpHandler();
		onBlurAmortizationHandler();
		formSubmit();
	}
	
	function numberFormat() {
		$('.number-format').number(true, 2);
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
	
	function onKeyupMemberIdHandler() {
		$('#member_last_name').keyup(function() {
			memberNameSelector = $("#member_name");
			memberNameSelector.empty().removeAttr('disabled');
			if ($(this).val() != '') {
				$.ajax({
					url: url+'/loan/application/get-member-in-last-name',
					data: {last_name : $(this).val()},
					dataType: 'json',
					success: function(result) {
						var formatDAta = selec2DataFormat(result, 'Select Member Name', '#member_name');
						memberNameSelector.select2({data: formatDAta});
						$(formNAme).parsley().reset();
					}
				});
			}
		});
	}
	
	function onClickApplicationTypeHandler() {
		$("input[name=application_type]").on('ifClicked', function(event) {
			var appTypeValue = $(this).val();
			if (appTypeValue == applicationTypeValueRenewal) {
				$("#rebate_field").show();
			}
			if (appTypeValue == applicationTypeValueNew) {
				$("#rebate_field").hide();
			}
			if (! $("#loan_type").parsley().isValid()) {
				$(formNAme).parsley().reset();
			}
			
			var loanTypeSelector = $("#loan_type");
			loanTypeSelector.attr('data-parsley-remote', '');
			loanTypeSelector.attr('data-parsley-remote-validator', '');
			
			loanTypeCheckedValue = $(this).val();
			
			if (loanTypeSelector.val() != '') {
				autoCalculateProcess();
			}
			
		});
	}
	
	function onChangeLoanTypeHandler() {
		$("#loan_type").change(function() {
			$(formNAme).parsley().reset();
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
			autoCalculateProcess();
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
	
	function onBlurAmortizationHandler() {
		$("#monthly_amortization").blur(function() {
			$.ajax({
				url: url+'/loan/application/cal-new-application-outstanding-balance',
				dataType: 'json',
				data: {
					loan_product_id : $("#loan_type").val(),
					amortization    : $("#monthly_amortization").val(),
				},
				success: function(outstandingBalance) {
					$("#outstanding_balance").val(addTwoZero(outstandingBalance));
				}
			});
		});
	}
	
	function autoCalculateProcess() {
		loadingModal('show','Please wait, auto compute in process....');
		getApplicationId();
	}
	
	function getApplicationId() {
		if (loanTypeCheckedValue != false) {
			applicationType = loanTypeCheckedValue;
		} else {
			applicationType = $('input[name=application_type]:checked').val();
		}
		
		$.ajax({
			url: url+'/loan/application/get-application-id',
			dataType: 'json',
			data: { 
					member_id		 : $('#member_name').val(),
					application_type : applicationType,
					loan_product_id  : $('#loan_type').val()
			},
			success: function(applicationId) {
				$("#renewal_application_id").val(applicationId);
				getPrincipalLoanAmount();
			}
		});
	}
	
	function getPrincipalLoanAmount() {
		$.ajax({
			url: url+'/loan/application/get-principal-amount',
			dataType: 'json',
			data: { loan_product_id : $("#loan_type").val() },
			success: function(principalAmount) {
				$("#loan_amount").val(principalAmount);
				calculateAdvanceInterest();
			}
		});
	}
	
	function calculateAdvanceInterest() {
		$.ajax({
			url: url+'/loan/application/cal-advance-interest',
			dataType: 'json',
			data: {
				loan_amount 	: $("#loan_amount").val(),
				loan_product_id : $("#loan_type").val()
			},
			success: function(advanceInterest) {
				$("#advance_interest").val(advanceInterest);
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
				$("#processing_fee").val(processingFee);
				if ($('input[name=application_type]:checked').val() == applicationTypeValueNew) {
					calculateTotalDeduction();
				}
				if ($('input[name=application_type]:checked').val() == applicationTypeValueRenewal) {
					calculateRebate();
				}
			}
		});
	}
	
	function calculateRebate() {
		$.ajax({
			url: url+'/loan/application/cal-rebate',
			dataType: 'json',
			data: {
				advance_interest       : $("#advance_interest").val(),
				loan_amount     	   : $("#loan_amount").val(),
				renewal_application_id : $("#renewal_application_id").val(),
				loan_product_id 	   : $("#loan_type").val(),
			},
			success: function(rebate) {
				$("#rebate").val(rebate);
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
				capital_build_up : $("#capital_build_up").val(),
				application_type : $('input[name=application_type]:checked').val(),
			},
			success: function(totalDeduction) {
				$("#total_deduction").val(totalDeduction);
				$("#total_deduction").toggleClass('redBackground', $("#total_deduction").val() < 0);
				calculateOutstandingBalance();
			}
		});
	}
	
	function calculateOutstandingBalance() {
		$.ajax({
			url: url+'/loan/application/cal-outstanding-balance',
			dataType: 'json',
			data: { 
				loan_product_id     : $("#loan_type").val(),
				loan_application_id : $("#renewal_application_id").val(),
				application_type    : $('input[name=application_type]:checked').val(),
			},
			success: function(outstandingBalance) {
				$("#outstanding_balance").val(outstandingBalance);
				calculateNetProceeds();
			}
		});
	}
	
	function calculateNetProceeds() {
		$.ajax({
			url: url+'/loan/application/cal-net-proceeds',
			dataType: 'json',
			data: {
				application_type    : $('input[name=application_type]:checked').val(),
				loan_amount         : $("#loan_amount").val(),
				total_deduction     : $("#total_deduction").val(),
				rebate     			: $("#rebate").val(),
				outstanding_balance : $("#outstanding_balance").val(),
			},
			success: function(netProceeds) {
				$("#net_proceeds").val(netProceeds);
				getMonthlyAmortization();
			}
		});
	}
	
	function getMonthlyAmortization() {
		$.ajax({
			url: url+'/loan/application/get-amortization',
			dataType: 'json',
			data: { loan_product_id : $("#loan_type").val() },
			success: function(amortization) {
				$("#monthly_amortization").val(amortization);
				loadingModal('close');
			}
		});
	}
	
	function formSubmit() {
		$('#form-submit').on('click', function () {
			if(formValidation()) {
				loadingModal('show','Saving ....');
				ajaxCsrfToken();
				$.ajax({
					url: url+'/loan/application/store',
					type: "post",
					data: $('input, select').serialize(),
					dataType: 'json',
					complete: function() {
						loadingModal('close');
					},
					error: function(result) {
						notifier('danger','#loan-application-creation-result', oops);
					},
					success: function(result) {
						$('form .btn-submit-field').hide();
						$('input, textarea').attr('readonly', true);
						$('.flat, select').attr('disabled', true);
						notifier('success','#loan-application-creation-result', result.message);
						addBtn('', '');
					}
				});
			}
			return false;
		});
		$('.clear-btn').click(function() { $(formNAme).parsley().reset() });
	}
	
	function formValidation() {
		validateLoanAmount();
		validateApplicationType();
		$(formNAme).parsley().validate();
		return $(formNAme).parsley().isValid();
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
	
	function validateApplicationType() {
		var validateApplicationTypeMessage;
		if ($('input[name=application_type]:checked').val() == applicationTypeValueNew) {
			validateApplicationTypeMessage = ValidateCurrentAppMessage;
		}
		if ($('input[name=application_type]:checked').val() == applicationTypeValueRenewal) {
			validateApplicationTypeMessage = ValidateRenewalAppMessage;
		}
		var loanTypeSelector = $("#loan_type");
		loanTypeSelector.attr('data-parsley-remote', '');
		loanTypeSelector.attr('data-parsley-remote-validator', 'validateApplicationType');
		loanTypeSelector.attr('data-parsley-remote-message', validateApplicationTypeMessage);
		window.Parsley.addAsyncValidator('validateApplicationType', function (xhr) {
			return xhr.status !== 404;
			}, url+'/loan/application/validate-application-type', {
				"dataType" : "jsonp", 
				"data": {
						"member_id"		  : $('#member_name').val(),
						"application_type": $('input[name=application_type]:checked').val(),
				}
			}
		);
	}