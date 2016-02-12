<?php

return [

    /*
    |--------------------------------------------------------------------------
    | User Status
    |--------------------------------------------------------------------------
    |
    | List of users status 
    |
    */

	'status' => [
	
		'disabled'			  => 0,
		'active'   			  => 1,
		'expired'  			  => 2,
		'terminated'  		  => 3,
		'temporary_password'  => 4,
		
	],
	
	 /*
    |--------------------------------------------------------------------------
    | Inverted Status
    |--------------------------------------------------------------------------
    |
    | This is use for html select as selection value
    |
    */
	
	'inverted_status' => [
	
		0 => 'Disabled',			 
		1 => 'Active',   		
		2 => 'Expired',  		
		3 => 'Terminated',  		 
		4 => 'Temporary Password',
	],
	
	/*
    |--------------------------------------------------------------------------
    | Avatar Path
    |--------------------------------------------------------------------------
    |
    | Where users avatar resided in the server
    |
    */
	
	'avatar_path' => 'images\users/'

];
