<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Users Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for user management for various
    |
    */

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
    'successUpdateProfile' => "Success Modification! Great successful account update.",
	
	/* === User Extend Expiry  === */
    'successExtendExpiry' => "Expiry Extend! Great successful account extension.",	
	
	/* === User Change Status  === */
    'successChangeStatus' => "Status Changed! Great successful status change.",
    
	/* === User Change Group  === */
	'successChangeGroup' => "Group Changed! Great successful group change.",
	
	/* === User Change Password  === */
	'successChangePassword' => "Password Change! Great successful password change.",

	/* === User Reset Password  === */
	'successResetPassword' => "An email is sent! Great Tell the user to activate his account with temporary password.",
	
	/* === General error Message === */
   'oops' => "Sorry, we couldn't complete your action because of some problem on our server. Please try again.",
   
   /* === Login notif === */
   	'disabled' 	  => "Your account is temporary disabled. <br> Please contact the administrator",
   	'expired' 	  => "Your account already expired. <br> Please contact the administrator",
   	'terminated'  => "Invalid user access",
	'temporary_password' => 'Your account is in temporary password. <br> I have sent you an email to active your account',
	'invalid_status'	 => "Invalid user status <br> Please contact the administrator",
	'invalid'	 		 => "Invalid username and password",
	'currently_login'	 => "This user is currently login in another location",
	
	/* === User Group === */
	'successEditUserGroup' => "Group has modified! Great this group is being modified.",
	'successAddUserGroup'  => "Group has been save! Great you have new groups.",
];
