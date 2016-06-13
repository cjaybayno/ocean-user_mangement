<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module Status
    |--------------------------------------------------------------------------
    |
    | List of Module status 
    |
    */

	'status' => [
		'active'   => 1,
		'deactive' => 0,
	],
	
	'select_status' => [
		1   => 'Active',
		0   => 'Deactive',
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
	
	'select_role' => [
		' ' => 'Select Role',
		1   => 'Client',
		0   => 'Admin',
	],
	
];