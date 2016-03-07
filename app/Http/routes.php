<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
	
	//Authentication Route
	Route::get('login', 'Auth\AuthController@getLogin');
	Route::post('login', 'Auth\AuthController@auth');
	Route::get('logout', 'Auth\AuthController@logout');
  
	// Authenticated route group
	Route::group(['middleware' => 'auth'], function () {
		
		Route::get('dashboard', function () {
			return view('home');
		});
		
		Route::get('/', function () {
			return view('home');
		});
		
		// Loans route group
		Route::group(['prefix' => 'loan'], function () {
			// loan application route
			Route::get('application', 'Loans\LoanApplicationController@getApplication');
			
			// loan products route
			Route::controller('products', 'Loans\LoanProductsController', [
				'getIndex'  => 'loan.products',
				'getCreate' => 'loan.products.create',
				'getShow'   => 'loan.products.show',
				'getEdit'   => 'loan.products.edit',
			]);
		});
				
		// Users route
		Route::controller('users', 'UsersManagement\UsersController', [
			'getIndex'          => 'users',
			'getRegister'       => 'users.register',
			'postStore'         => 'users.store',
			'getShow'           => 'users.show',
			'getEditProfile'    => 'users.editProfile',
			'postUpdateProfile' => 'users.UpdateProfile',
		]);
		
		// Users route gruop
		Route::group(['prefix' => 'user'], function () {
			// users/groups route
			Route::controller('groups', 'UsersManagement\UserGroupController', [
				'getIndex' => 'user.groups',
			]);
		});	
	});
});
