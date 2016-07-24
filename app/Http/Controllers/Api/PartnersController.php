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
				'/assets/modules/api/partner-list.js' 
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
	
	/**
     * Return partners list for paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginate(Request $request)
    {
		$partners = DB::table('view_gateway_partners')
		->select([
			'logo',
			'name',
			'code',
			'description',
			'id',
		]);
			
		return Datatables::of($partners)
				->editColumn('logo',  function ($partners) {
					return view('modules/api/partners/datatables.logo', [
						'logo' => $partners->logo
					])->render();
				})
				->editColumn('description', function ($partners) {
					return view('modules/api/partners/datatables.description', [
						'description' => $partners->description
					])->render();
				})
				->addColumn('action', function ($partners) {
					return view('modules/api/partners/datatables.action', [
								'encryptID' => Crypt::encrypt($partners->id)
							])->render();
				})
				->removeColumn('id')
				->make();
    }
	
	
}
