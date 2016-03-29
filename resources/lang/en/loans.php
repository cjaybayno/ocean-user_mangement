<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Loan Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines for loan module
    |
    */

	/* === Loan Products === */
	'successLoanProductCreation' => 'Success Creation! <br> Great, We have a new product.',
	
	/* === Loan general message === */
	'digit'  		  	 => "This must be digits.",
	'email'  		  	 => "This must be a valid email address.",
	'min'  			  	 => "This must be at least :min characters",
	'required'		  	 => "This field is required.",
	'passwordConfirm'    => "Password not match.",
	'amount'		     => 'This must be valid amount',
	'percentage'		 => 'This must be valid percentage',
	
	/* === Loan Application === */
	'validateMemberId' 	 		 => 'Member ID not exist',
	'validateLoanAmount' 		 => 'Loan amount exceed',
	'ValidateCurrentApplication' => 'This Member has current application for this Loan Type',
	'successLoanApplication'	 => 'Success Application!, Greate we have our new application',
	
	/* === Loan Payment === */
	'successLoanPayment' => 'Success made of payment!',
	'validatePaymentOR'  => 'This OR already process',
	'paymentRequired'    => 'Required',
	'paymentAmount'		 => 'This amount is lower than amortization OR higher than outstanding balance.',
	'validatePaymentORSameField' => 'This OR is already used to other fields',
];
