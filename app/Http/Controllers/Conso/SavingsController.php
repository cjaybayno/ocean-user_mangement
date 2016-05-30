<?php

namespace App\Http\Controllers\Conso;

use Illuminate\Http\Request;

use DB;
use Log;
use DateTime;
use Datatables;

use App\Entity;
use App\Balance;
use App\LoanProduct; 
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SavingsController extends Controller
{
    /**
	* Determine Active Menu
	*/
	public $menuKey   = 'consoActiveMenu';
	public $menuValue = 'current-page';
	
	/**
	* Frontend route 
	*/
	public $route = '/conso/savings';
	
	/**
     * Create a new instance.
     *
     * @return void
     */
	public function __construct()
	{
		$this->middleware('ajax.request', ['except' => [
            'getIndex',
            'getContribution',
        ]]);
	}
	
	/**
     * Show Consolidation form
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
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/dataTables.bootstrap.min.js',
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
				'/assets/gentellela-alela/js/jquery.number.min.js',
				'/assets/modules/conso/conso-savings.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/select/select2.min.css',
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View savings consolidation : ', ['session' => session()->all()]);
		
        return view('modules/conso/savings.conso')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets,
		]);
	}
	
	/**
     * Get Loan Type Name
	 *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getGetParams(Request $request)
	{
		$entity = Entity::select('code')->find(session('entity_id'));
		
		return response()->json([
			'product_name' => 'Savings',
			'entity_code'  => $entity['code']
		]);
	}
	
	/**
     * Show Consolidation form
     *
     * @return \Illuminate\Http\Response
     */
	public function getPaginateConso(Request $request)
	{
		$savingsPayments = DB::table('view_balances')
			->select([
				'member_name', 
				'current_balance',
				'available_balance',
				'pending_balance',
			])
			->where('entity_id', session('entity_id'))
			->where('type', config('loans.productType.savings'))
			->where(DB::raw("DATE_FORMAT(updated_at,'%Y-%m-%d')"), '>=', date('Y-m-d', strtotime($request->from_date)))
			->where(DB::raw("DATE_FORMAT(updated_at,'%Y-%m-%d')"), '<=', date('Y-m-d', strtotime($request->to_date)));
			
			return Datatables::of($savingsPayments)
				->make();
	}
	
	
	/**
     * Show Yearly Contribution
     *
     * @return \Illuminate\Http\Response
     */
	public function getContribution()
	{
		$savingsceMembers = DB::table('view_balances')
			->select('member_id', 'member_name')
			->where('type', config('loans.productType.savings'))
			->groupBy('member_id')
			->orderBy('member_name','asc')
			->get();
			
		$year = 2016;
		for($month = 1; $month <= 12; $month++) {	
			/* === initialize variable === */
			$monthName     = strtolower(DateTime::createFromFormat('!m', $month)->format('M'));
			$monthNames[]  = $monthName;
			$month 		   = sprintf('%02d', $month);
			$yearMonthDate = $year.'-'.$month;
			
			$balancePayments = DB::table('view_balance_payments')
				->select([
					'member_id',
					DB::raw("SUM(payment_amount) as contribution")
				])
				->where(DB::raw("DATE_FORMAT(date,'%Y-%m')"), $yearMonthDate)
				->where('type', config('loans.productType.savings'))
				->groupBy('member_id')
				->get();
			
			/* === build members contribution per month === */
			$count = count($savingsceMembers);
			for ($i = 0; $i < $count; $i++) {
				foreach($balancePayments as $balancePayment) {
					if($savingsceMembers[$i]->member_id == $balancePayment->member_id) {
						$savingsceMembers[$i]->$monthName = $balancePayment->contribution;
					}
				}
			}
		}
		
		$overAllTotal  = 0;
		$monthlyTotals = $this->getInitMonthlyTotal($monthNames);
		foreach ($savingsceMembers as $savingsceMember) {
			$memberYearTotal = 0;
			foreach($monthNames as $monthName) {
				if(isset($savingsceMember->$monthName)) {
					$monthlyTotals[$monthName] += $savingsceMember->$monthName; 
					$memberYearTotal += $savingsceMember->$monthName;
				}
			}
			
			/* === total contribution  per member === */
			$savingsceMember->total = $memberYearTotal;
			
			/* === total contribution over all === */
			$overAllTotal += $memberYearTotal;
		}
		
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/jquery.number.min.js'
			]
		];
		
		
		Log::info('View savings yearly contribution : ', ['session' => session()->all()]);
		
        return view('modules/conso/savings.contribution')->with([
			$this->menuKey  => $this->menuValue,
			'assets'		=> $assets,
			'monthNames'	=> $monthNames,
			'contributions'	=> $savingsceMembers,
			'overAllTotal'  => $overAllTotal,
			'monthlyTotals' => $monthlyTotals,
		]);
	}
	
	
	/**
     * Get initialize monthly total
     *
     * @param array $monthNames
     * @return Array
     */
	private function getInitMonthlyTotal($monthNames) {
		$monthlyTotalArray = [];
		foreach($monthNames as $monthName) {
			$monthlyTotalArray[$monthName] = 0;
		}
		return $monthlyTotalArray;
	}
}
