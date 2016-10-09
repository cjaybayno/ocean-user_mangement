<?php

namespace App\Http\Controllers\Insurance;

use Illuminate\Http\Request;

use DB;
use Log;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SalesRegistrationController extends Controller
{
    /**
	* Frontend route 
	*/
	public $route = '/insurance/sales-registration';
	
	/**
     * Create a new instance.
     *
     * @return void
     */
	public function __construct()
	{
		$this->middleware('ajax.request', ['except' => [
            'getIndex',
        ]]);
	}
	
	/**
     * Show list of partners
     *
     * @return \Illuminate\Http\Response
     */
	public function getIndex()
	{
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/moment.min2.js',
				'/assets/gentellela-alela/js/datepicker/daterangepicker.js',
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/wizard/jquery.smartWizard.js',
				'/assets/modules/insurance/sales-registration.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/select/select2.min.css'
			],
			'route' => $this->route,
		];
		
		Log::info('View sales registration form: ', ['session' => session()->all()]);
		
        return view('modules/insurance.saleRegistrations')->with([
			'assets' => $assets
		]);
	}
}
