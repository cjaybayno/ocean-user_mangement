<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Datatables;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PartnersController extends Controller
{
    /**
	* Frontend route 
	*/
	public $route = '/api/partners';
	
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
				'/assets/modules/loans/application-current.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/css/dataTables.responsive.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View api partners list: ', ['session' => session()->all()]);
		
        return view('modules/api/partners.list')->with([
			'assets' => $assets
		]);
	}
}
