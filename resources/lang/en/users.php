<?php

return [

	/* === Validation === */
	'digit'  		  	 => "This must be digits.",
	'email'  		  	 => "This must be a valid email address.",
	'min'  			  	 => "This must be at least :min characters",
	'required'		  	 => "This field is required.",
	'passwordConfirm'    => "Password not match.",
    
	/* === User Termination === */
	'questionTermination' => "Are you sure you want to terminate this user? <br> <i>Note:Once done user can no longer login!</i>",
	'successCreation' 	  => "Success Creation! <br> Great, your account is ready to use right away.",
	'successTermination'  => "User successfully Terminated",
   
    /* === User Modification === */
    'successUpdateProfile' => "Success Modification! <br> Great, your account is updated.",
	
	/* === User Extend Expiry  === */
    'successExtendExpiry' => "Expiry Extend! <br> Great, your account is extended.",
	
	
	/* === User Change Status  === */
    'successChangeStatus' => "Status Changed! <br> <br> Great, your account status is change.",
    
	/* === User Change Group  === */
	'successChangeGroup' => "Group Changed! <br> <br> Great, your account group is change.",
	
	/* === General error Message === */
   'oops' => "Sorry, we couldn't complete your action because of some problem on our server. Please try again.",

];
