<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BalanceSheetController extends Controller
{
    /**
	* Determine Active Menu
	*/
	public $menuKey   = 'BalanceSheetActiveMenu';
	public $menuValue = 'current-page';
	
	/**
	* Frontend route 
	*/
	public $route = '/balance-sheet';
	
	/**
     * Create a new instance.
     *
     * @return void
     */
	public function __construct()
	{
		$this->middleware('ajax.request', ['except' => [
            'getForm',
            'getIndex',
        ]]);
	}
	
	/**
     * Show list 
     *
     * @return \Illuminate\Http\Response
     */
	public function getForm()
	{
		$assets = [
			'scripts' => [
				'/assets/modules/loans/.js' 
			],
			'stylesheets' => [
				
			],
			'route' => $this->route,
		];
		
		Log::info('View balance sheet: ', ['session' => session()->all()]);
		
        return view('modules/balanceSheet/form')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets
		]);
	}
}
