<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;

use Log;

use App\Parameter;
use App\BackofficeBalanceSheet;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BalanceSheetController extends Controller
{
	/**
	* Frontend route 
	*/
	public $route = '/backoffice/balance-sheet';
	
	/**
     * Create a new instance.
     *
     * @return void
     */
	public function __construct()
	{
		$this->authorize('menuAccessByName', 'balance_sheet');
		
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
				'/assets/modules/backoffice/balanceSheet/form.js' 
			],
			'stylesheets' => [
				
			],
			'route' => $this->route,
		];
		
		Log::info('View balance sheet: ', ['session' => session()->all()]);
		
        return view('modules/backoffice/balanceSheet.form')->with([
			'assets' 	  => $assets,
			'assetParams' => $this->getParent($params, 'assets'),
			'laeParams'   => $this->getParent($params, 'liabilities_and_equity'),
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
	
	public function postStore(Request $request) 
	{
		foreach($request->input() as $paramId => $amount) {
			if ($amount != 0 OR !empty($amount)) {
				$balanceSheet = new BackofficeBalanceSheet;
				$balanceSheet->param_id = $paramId;
				$balanceSheet->amount   = $amount;
				$balanceSheet->save();
				
				Log::info('Balance sheet save : ', [
					'table'	=> [
						'name' => 'balance_sheets',
						'data' => $balanceSheet->toArray()
					],
					'session' => session()->all()
				]);
			}
		}
		
		return response()->json([
			'success' => true,
			'message' => trans('general.successSave'),
		]);
	}
}
