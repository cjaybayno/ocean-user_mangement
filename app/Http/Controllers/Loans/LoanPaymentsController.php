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
            'getIndex',
        ]]);
	}
	
	
	/**
     * Show list of payments made
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
				'/assets/modules/loans/loans-payments-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			]
		];
		
		Log::info('View loan payments made list: ', ['session' => session()->all()]);
		
        return view('modules/loans/payments.list')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets
		]);
	}
	
	/**
     * Return payments list paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginatePaymentList(Request $request)
    {
		$loanApplications = DB::table('view_loan_payments')
		->where('entity_id', session('entity_id'))
		->select([
			'date', 
			'member_name',
			'loan_product_name',
			'amount',
			'or_number',
		]);
			
		return Datatables::of($loanApplications)
				->editColumn('date', '{{ date("m/d/Y", strtotime($date)) }}')
				->make();
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
	
		/* === get payment type === */
		$payementType = $this->loanRepo->loanProducts() + $this->loanRepo->balanceProducts();
	
		/* === set default payment type === */
		$payementType[''] = 'Select Payment Type';
	
        return view('modules/loans/payments.form')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets,
			'loanTypes'	   => $payementType,
		]);
    }
	
	/**
     * Return payments form paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginatePaymentForm(Request $request)
    {	
		$productType = LoanProduct::select('type')->find($request->loan_product_id);
		
		if (isset($productType->type)) {
			switch ($productType->type) {
				case 'loan' :
					$loanPayments = DB::table('view_loan_applications')
					->where('entity_id', session('entity_id'))
					->where('fully_paid', false)
					->where('loan_product_id', $request->loan_product_id)
					->select([
						'member_name', 
						'id',
						'outstanding_balance',
						'amortization',
					]);
						
					return Datatables::of($loanPayments)
							->addColumn('paymentAmountInput', function ($loanPayments) {
								return view('modules/loans/payments/datatables.paymentAmountInput', [
											'encryptID' => Crypt::encrypt($loanPayments->id),
											'minAmount' => $loanPayments->amortization,
											'maxAmount' => $loanPayments->outstanding_balance,
										])->render();
							})
							->addColumn('paymentORInput',  function ($loanPayments) {
								return view('modules/loans/payments/datatables.paymentORInput', [
											'encryptID' => Crypt::encrypt($loanPayments->id),
										])->render();
							})
							->addColumn('paymentAction', function ($loanPayments) {
								return view('modules/loans/payments/datatables.paymentAction', [
											'encryptID' => Crypt::encrypt($loanPayments->id)
										])->render();
							})
							->removeColumn('id')
							->removeColumn('outstanding_balance')
							->removeColumn('amortization')
							->make();
					break;
				
				case 'balance' :
					$loanPayments = DB::table('view_members')
					->where('entity_id', session('entity_id'))
					->select('member_name', 'id');
						
					return Datatables::of($loanPayments)
							->addColumn('paymentAmountInput', function ($loanPayments) {
								return view('modules/loans/payments/datatables.paymentAmountInput', [
											'encryptID' => Crypt::encrypt($loanPayments->id),
											'minAmount' => '1000',
											'maxAmount' => '20000',
										])->render();
							})
							->addColumn('paymentORInput',  function ($loanPayments) {
								return view('modules/loans/payments/datatables.paymentORInput', [
											'encryptID' => Crypt::encrypt($loanPayments->id),
										])->render();
							})
							->addColumn('paymentAction', function ($loanPayments) {
								return view('modules/loans/payments/datatables.paymentAction', [
											'encryptID' => Crypt::encrypt($loanPayments->id)
										])->render();
							})
							->removeColumn('id')
							->make();
					break;
			}
		}
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
		/* === loop all data for payement ===*/
		foreach ($request->data as $loan) {
			/* === decrypt application id === */
			$loanApplicationId = Crypt::decrypt($loan['payment_id']);
			
			$loanPayment = new LoanPayment;
			$loanPayment->loan_application_id = $loanApplicationId;
			$loanPayment->amount 			  = $loan['payment_amount'];
			$loanPayment->or_number 		  = strtoupper($loan['payment_or']);
			$loanPayment->entity_id 		  = session('entity_id');
			$loanPayment->save();
			
			Log::info('Make Payment : ', [
				'table'	=> [
					'name' => 'loan_payments',
					'data' => $loanPayment->toArray()
				],
				'session' => session()->all()
			]);
			
			/* === if payment success === */
			if ($loanPayment->id) {
				$loanApplication = LoanApplication::find($loanApplicationId);
				
				/* === add 1 to num_made_payments === */
				$loanApplication->num_made_payments = $loanApplication->num_made_payments + 1;
				
				/* === add payment amount total_made_payments === */
				$loanApplication->total_made_payments = $loanApplication->total_made_payments + $loan['payment_amount'];
				
				/* === outstanding balance - payment_amount === */
				$loanApplication->outstanding_balance = $loanApplication->outstanding_balance - $loan['payment_amount'];
				
				/* === check if fully paid === */
				if ($loanApplication->outstanding_balance <= 0) {
					$loanApplication->fully_paid = true;
				}
				
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
