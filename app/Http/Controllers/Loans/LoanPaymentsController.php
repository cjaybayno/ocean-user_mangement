<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Datatables;

use App\LoanPayment;
use App\LoanProduct;
use App\Http\Requests;
use App\LoanApplication;
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
		->select(['member_name', 'id']);
			
		return Datatables::of($loanApplications)
				->addColumn('paymentAmountInput', function ($loanApplications) {
					return view('modules/loans/payments/datatables.paymentAmountInput', [
								'encryptID' => Crypt::encrypt($loanApplications->id)
							])->render();
				})
				->addColumn('paymentORInput',  function ($loanApplications) {
					return view('modules/loans/payments/datatables.paymentORInput', [
								'encryptID' => Crypt::encrypt($loanApplications->id)
							])->render();
				})
				->addColumn('paymentAction', function ($loanApplications) {
					return view('modules/loans/payments/datatables.paymentAction', [
								'encryptID' => Crypt::encrypt($loanApplications->id)
							])->render();
				})
				->removeColumn('id')
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
	
	/**
     * Store payements.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
		foreach ($request->data as $loan) {
			if (! empty($loan['payment_amount']) AND ! empty($loan['payment_or'])) {
				$loanApplicationId = Crypt::decrypt($loan['payment_id']);
				$loanPayment = new LoanPayment;
				$loanPayment->loan_application_id = $loanApplicationId;
				$loanPayment->amount 			  = $loan['payment_amount'];
				$loanPayment->or_number 		  = strtoupper($loan['payment_or']);
				$loanPayment->entity_id 		  = session('entity_id');
				$loanPayment->save();
				
				Log::info('Make Payments : ', [
					'table'	=> [
						'name' => 'loan_payments',
						'data' => $loanPayment->toArray()
					],
					'session' => session()->all()
				]);
				
				if ($loanPayment->id) {
					$loanApplication = LoanApplication::find($loanApplicationId);
					/* === outstanding balance - payment_amount === */
					$loanApplication->outstanding_balance = $loanApplication->outstanding_balance - $loan['payment_amount'];
					/* === add 1 to num_made_payments === */
					$loanApplication->num_made_payments   = $loanApplication->num_made_payments + 1;
					$loanApplication->save();
					
					Log::info('Update Outstanding balance : ', [
						'table'	=> [
							'name' => 'loan_application',
							'data' => $loanApplication->toArray()
						],
						'session' => session()->all()
					]);
				}
			}
		}
		
		return response()->json([
			'success' => true,
			'message' => trans('loans.successLoanPayment'),
		]);
	}
	
	/**
     * Validate OR
	 *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getValidateOr(Request $request)
	{
		$orNumberCount = LoanPayment::select('or_number')->where('or_number', $request->payment_or)->count();
		
		if ($orNumberCount > 0) abort(404);
	}
}
