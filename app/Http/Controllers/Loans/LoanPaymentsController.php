<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;

use DB;
use Log;
use Datatables;

use App\LoanProduct;
use App\Http\Requests;
use App\Repository\LoanManagement;
use App\Http\Controllers\Controller;

class LoanPaymentsController extends Controller
{
    /**
	* Determine Active Menu
	*/
	public $menuKey   = 'loanPaymentsActiveMenu';
	public $menuValue = 'current-page';
	
	/**
     * The loan repository implementation.
     */
	protected $loanRepo;
	
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
            'getForm',
        ]]);
	}
	
	
	/**
     * Display a listing of the loan payments
     *
     * @return \Illuminate\Http\Response
     */
    public function getForm()
    {
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/moment.min2.js',
				'/assets/gentellela-alela/js/datepicker/daterangepicker.js',
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/dataTables.bootstrap.min.js',
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
				'/assets/modules/loans/loans-payments-form.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
				'/assets/gentellela-alela/css/select/select2.min.css'
			]
		];
		
		Log::info('View loan payments form: ', ['session' => session()->all()]);
	
        return view('modules/loans/payments.form')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets,
			'loanTypes'	   => $this->loanRepo->loanProducts(),
		]);
    }
	
	/**
     * Return loan members list for paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginate(Request $request)
    {
		$loanApplications = DB::table('view_loan_applications')
		->where('entity_id', session('entity_id'))
		->where('fully_paid', false)
		->where('loan_product_id', $request->loan_product_id)
		->select(['member_name']);
			
		return Datatables::of($loanApplications)
				->addColumn('payment_input', 'test')
				->addColumn('or_input', 'test')
				->addColumn('action', 'test')
				->make();
	}
	
	/**
     * Get Loan Type Name
	 *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getGetLoanTypeName(Request $request)
	{
		$loanProduct = LoanProduct::select('name')->find($request->loan_product_id);
		
		return response()->json($loanProduct['name'].' Payments Form');
	}
}
