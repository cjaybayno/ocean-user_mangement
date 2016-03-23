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
	
	'inverted_status' => [
		0 => 'Disabled',			 
		1 => 'Active',   		
		2 => 'Expired',  		
		3 => 'Terminated',  		 
		4 => 'Temporary Password',
	],
	
	/*
    |--------------------------------------------------------------------------
    | Role
    |--------------------------------------------------------------------------
    |
    | Users Role
    |
    */

	'role' => [
		'client' => 1,
		'admin'  => 0,
	],
	
	'inverted_role' => [
		1 => 'Client',
		0 => 'Admin',
	],
	
	/*
    |--------------------------------------------------------------------------
    | Avatar Path
    |--------------------------------------------------------------------------
    |
    | Where users avatar resided in the server
    |
    */
	
	'avatar_path' => 'images\users/',
];
