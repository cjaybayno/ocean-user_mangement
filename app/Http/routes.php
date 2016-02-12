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

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

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

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
	
	Route::group(['middleware' => 'auth'], function () {
		
		Route::get('home', function () {
			return view('home');
		});
		
		Route::get('/', function () {
			return view('home');
		});
		
		//users route
		Route::controller('users', 'UsersController', [
			'getIndex'          => 'users',
			'getRegister'       => 'users.register',
			'postStore'         => 'users.store',
			'getShow'           => 'users.show',
			'getEditProfile'    => 'users.editProfile',
			'postUpdateProfile' => 'users.UpdateProfile',
			'postTerminate'     => 'users.terminate',
		]);
		
	});
});
