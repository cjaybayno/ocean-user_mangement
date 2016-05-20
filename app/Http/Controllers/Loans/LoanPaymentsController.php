<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Datatables;

use App\Balance;
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
				->editColumn('amount', '{{ number_format($amount, 2) }}')
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
				'/assets/gentellela-alela/js/jquery.number.min.js',
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
				case config('loans.productType.loan'):
					$loanApplication = DB::table('view_loan_applications')
					->select([
						'member_name', 
						'id',
						'outstanding_balance',
						'amortization',
					])
					->where('entity_id', session('entity_id'))
					->where('fully_paid', false)
					->where('loan_product_id', $request->loan_product_id);
					
					return Datatables::of($loanApplication)
							->addColumn('paymentAmountInput', function ($loanApplication) {
								return view('modules/loans/payments/datatables.paymentAmountInput', [
											'type' 		=> config('loans.productType.loan'),
											'encryptID' => Crypt::encrypt($loanApplication->id),
											'minAmount' => $loanApplication->amortization,
											'maxAmount' => $loanApplication->outstanding_balance,
										])->render();
							})
							->addColumn('paymentORInput',  function ($loanApplication) {
								return view('modules/loans/payments/datatables.paymentORInput', [
											'encryptID' => Crypt::encrypt($loanApplication->id),
										])->render();
							})
							->addColumn('paymentAction', function ($loanApplication) {
								return view('modules/loans/payments/datatables.paymentAction', [
											'encryptID' => Crypt::encrypt($loanApplication->id)
										])->render();
							})
							->removeColumn('id')
							->removeColumn('outstanding_balance')
							->removeColumn('amortization')
							->make();
					break;
				
				case config('loans.productType.capital'):
					$member = DB::table('view_members')
						->select('member_name', 'id')
						->where('entity_id', session('entity_id'));
						
					return Datatables::of($member)
							->addColumn('paymentAmountInput', function ($member) {
								return view('modules/loans/payments/datatables.paymentAmountInput', [
											'type' 		=> config('loans.productType.capital'),
											'encryptID' => Crypt::encrypt($member->id),
											'minAmount' => '1000',
											'maxAmount' => '20000',
										])->render();
							})
							->addColumn('paymentORInput',  function ($member) {
								return view('modules/loans/payments/datatables.paymentORInput', [
											'encryptID' => Crypt::encrypt($member->id),
										])->render();
							})
							->addColumn('paymentAction', function ($member) {
								return view('modules/loans/payments/datatables.paymentAction', [
											'encryptID' => Crypt::encrypt($member->id)
										])->render();
							})
							->removeColumn('id')
							->make();
					break;
					
				case config('loans.productType.savings'):
					$member = DB::table('view_members')
						->select('member_name', 'id')
						->where('entity_id', session('entity_id'));
						
					return Datatables::of($member)
							->addColumn('paymentAmountInput', function ($member) {
								return view('modules/loans/payments/datatables.paymentAmountInput', [
											'type' 		=> config('loans.productType.savings'),
											'encryptID' => Crypt::encrypt($member->id),
											'minAmount' => '1000',
											'maxAmount' => '20000',
										])->render();
							})
							->addColumn('paymentORInput',  function ($member) {
								return view('modules/loans/payments/datatables.paymentORInput', [
											'encryptID' => Crypt::encrypt($member->id),
										])->render();
							})
							->addColumn('paymentAction', function ($member) {
								return view('modules/loans/payments/datatables.paymentAction', [
											'encryptID' => Crypt::encrypt($member->id)
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
     * Store payments.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
		// return $request->all();
		
		/* === loop all data for payement ===*/
		foreach ($request->data as $loan) {
			switch ($loan['type']) {
				case config('loans.productType.loan'):
					$this->paidLoan($loan);
					break;
					
				case config('loans.productType.capital'):
				case config('loans.productType.savings'):
					$this->paidBalance($loan);
					break;
			}
		}
		
		return response()->json([
			'success' => true,
			'message' => trans('loans.successLoanPayment'),
		]);
	}
	
	/**
     * Paid Loan Application
     *
     * @param  array $loan
     * @return \Illuminate\Http\Response
     */
	private function paidLoan($loan)
	{
		/* === decrypt application id === */
		$loanApplicationId = Crypt::decrypt($loan['id']);
		
		/* === if payment success === */
		$loanApplication = LoanApplication::find($loanApplicationId);
		
		/* === add num_made_payments === */
		$loanApplication->num_made_payments = $loanApplication->num_made_payments + 1;
		
		/* === add payment amount total_made_payments === */
		$loanApplication->total_made_payments = $loanApplication->total_made_payments + $loan['payment_amount'];
		
		/* === update outstanding balance === */
		$outstandingBalance = $loanApplication->outstanding_balance;
		$remainingBalance   = $outstandingBalance - $loan['payment_amount'];
		$loanApplication->outstanding_balance = $remainingBalance;
		
		/* === check if fully paid === */
		if ($loanApplication->outstanding_balance <= 0) {
			$loanApplication->fully_paid = 1;
			$loanApplication->paid_date  = date('y-m-d');
			$loanApplication->remarks    = 'closed fully paid';
		}
		
		if ($loanApplication->save()) {
			/* === save payments === */
			$loanPayment = new LoanPayment;
			$loanPayment->loan_application_id = $loanApplicationId;
			$loanPayment->outstanding_balance = $outstandingBalance;
			$loanPayment->amount 			  = $loan['payment_amount'];
			$loanPayment->remaining_balance   = $remainingBalance;
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
		}
		
		Log::info('Update loan application on payment : ', [
			'table'	=> [
				'name' => 'loan_application',
				'data' => $loanApplication->toArray()
			],
			'session' => session()->all()
		]);
	}
	
	/**
     * Paid Balance
     *
     * @param  array $paymentParams
     * @return \Illuminate\Http\Response
     */
	private function paidBalance($paymentParams)
	{
		/* === decrypt member id === */
		$memberId = Crypt::decrypt($paymentParams['id']);
		
		$getBalance = Balance::select('id')
			->where('member_id', $memberId)
			->where('type', $paymentParams['type'])
			->first();
		 
		if (empty($getBalance)) {
			$logInfo = 'Create '.$paymentParams['type'];
			$balance = new Balance;
			$balance->member_id = $memberId;
			$balance->type 		= $paymentParams['type'];
			$balance->entity_id = session('entity_id');
		} else {
			$logInfo = 'Update '.$paymentParams['type'];
			$balance = Balance::find($getBalance->id);
		}
		
		$balance->current_balance   = $balance->current_balance   + $paymentParams['payment_amount'];
		$balance->available_balance = $balance->available_balance + $paymentParams['payment_amount'];
		$balance->save();
		
		Log::info($logInfo.' : ', [
			'table'	=> [
				'name' => 'balance',
				'data' => $balance->toArray()
			],
			'session' => session()->all()
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
