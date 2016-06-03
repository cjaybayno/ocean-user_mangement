<?php

namespace App\Http\Controllers\Conso;

use Illuminate\Http\Request;

use DB;
use Log;
use Datatables;

use App\Entity;
use App\LoanProduct; 
use App\Http\Requests;
use App\Repository\LoanManagement;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{
	/**
	* Frontend route 
	*/
	public $route = '/conso/loan';
	
	/**
     * Create a new instance.
	 *
     * @param  LoanManagement  $LoanRepository
     * @return void
     */
	public function __construct(LoanManagement $LoanRepository)
	{
		$this->loanRepo = $LoanRepository;
		
		$this->middleware('ajax.request', ['except' => [
            'getIndex',
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
				'/assets/modules/conso/conso-loan.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/select/select2.min.css',
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View loan consolidation : ', ['session' => session()->all()]);
		
        return view('modules/conso/loan.conso')->with([
			'loanTypes'	=> $this->loanRepo->loanProducts(),
			'assets' 	=> $assets,
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
		$loanProduct = LoanProduct::select('name')->find($request->loan_product_id);
		$entity      = Entity::select('code')->find(session('entity_id'));
		
		return response()->json([
			'product_name' => $loanProduct['name'],
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
		$loanApplication = DB::table('view_loan_applications')
			->select([
				'member_name', 
				'net_proceeds as total_release',
				'total_made_payments as total_collected',
				'outstanding_balance as remaining_balance',
				'id',
			])
			->where('entity_id', session('entity_id'))
			->where('loan_product_id', $request->loan_product_id)
			->whereBetween('updated_date', [
				date('Y-m-d', strtotime($request->from_date)), 
				date('Y-m-d', strtotime($request->to_date)),
			]);
			
			return Datatables::of($loanApplication)
				->removeColumn('id')
				->make();
	}
}
