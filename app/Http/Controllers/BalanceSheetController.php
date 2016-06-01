<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Log;

use App\Parameter;
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
		$balanceSheet = Parameter::where('name', 'balance_sheet')->first();
		$params = Parameter::where('parent_id', $balanceSheet->id)->get()->toArray();
		$params = $this->builTree($params);
		
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/jquery.number.min.js',
				'/assets/modules/balanceSheet/assets-form.js' 
			],
			'stylesheets' => [
				
			],
			'route' => $this->route,
		];
		
		Log::info('View balance sheet: ', ['session' => session()->all()]);
		
        return view('modules/balanceSheet/form')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets,
			'assetParams'  => $this->getParent($params, 'assets'),
			'laeParams'    => $this->getParent($params, 'liabilities_and_equity'),
 		]);
	}
	
	/**
     * Get Specific parent
     *
     * @param array $params
     * @return Array
     */
	private function getParent($params, $name)
	{
		foreach ($params as $param) {
			if ($param['name'] == $name) $params = $param;
		}
		
		return $params;
	}
	
	/**
     * Build Tree
     *
     * @param array $params
     * @return Array
     */
	private function builTree($params)
	{
		$primaryData = [];
		for ($i = 0; $i < count($params); $i++) {
			$child = Parameter::where('parent_id', $params[$i]['id'])->get()->toArray();
			$params[$i]['child'] = $this->builTree($child);
			$primaryData[] = $params[$i];
		}
		
		return $primaryData;
	}
}
