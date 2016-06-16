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
			
			// member route
			Route::controller('members', 'Loans\MembersController', [
				'getIndex'	  => 'loan.members',
				'getRegister' => 'loan.members.register',
				'getShow' 	  => 'loan.members.show',
				'getEdit' 	  => 'loan.members.edit',
			]);
			
			// loan application route
			Route::controller('application', 'Loans\ApplicationController', [
				'getIndex'   => 'loan.application.current',
				'getForm' 	 => 'loan.application.form',
				'getShow' 	 => 'loan.application.show',
				'getMembers' => 'loan.application.members',
			]);
			
			// Consolildation group 
			Route::group(['prefix' => 'conso'], function () {
				// consolidated loan route
				Route::controller('loan', 'Loans\Conso\LoanController', [
					'getIndex' => 'loan.conso.loan',
				]);
				
				// consolidated capital route
				Route::controller('capital', 'Loans\Conso\CapitalController', [
					'getIndex' 		  => 'loan.conso.capital',
					'getContribution' => 'loan.conso.capital.contribution',
				]);
				
				// consolidated savings route
				Route::controller('savings', 'Loans\Conso\SavingsController', [
					'getIndex' 		  => 'loan.conso.savings',
					'getContribution' => 'loan.conso.savings.contribution',
				]);
			});
			
			//loan payments route
			Route::controller('payments', 'Loans\PaymentsController', [
				'getIndex' => 'loan.payments.list',
				'getForm'  => 'loan.payments.form',
			]);
			
			// loan products route
			Route::controller('products', 'Loans\ProductsController', [
				'getIndex'  => 'loan.products',
				'getCreate' => 'loan.products.create',
				'getShow'   => 'loan.products.show',
				'getEdit'   => 'loan.products.edit',
			]);
			
		});
		
		// backoffice route gruop
		Route::group(['prefix' => 'backoffice'], function () {
			
			// Balance Sheet route
			Route::controller('balance-sheet', 'Backoffice\BalanceSheetController', [
				'getForm'  => 'backoffice.balance-sheet.form',
			]);
		});
		
		// portal route gruop
		Route::group(['prefix' => 'portal'], function () {
			
			// Modules Sheet route
			Route::controller('modules', 'Portal\ModulesController', [
				'getIndex'  => 'portal.modules',
				'getShow'   => 'portal.modules.show',
			]);
		});
				
		// Users route
		Route::controller('users', 'Users\UsersController', [
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
			Route::controller('groups', 'Users\UserGroupController', [
				'getIndex'  => 'user.groups',
				'getAccess' => 'user.groups.access',
			]);
		});	
	});
});
