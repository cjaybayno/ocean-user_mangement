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
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/dataTables.bootstrap.min.js',
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
				'/assets/gentellela-alela/js/wizard/jquery.smartWizard.js',
				//'/assets/modules/api/partner-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/css/dataTables.responsive.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View sales registration form: ', ['session' => session()->all()]);
		
        return view('modules/insurance.saleRegistrations')->with([
			'assets' => $assets
		]);
	}
}
