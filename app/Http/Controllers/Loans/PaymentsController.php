<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Datatables;

use App\Balance;
use App\Payment;
use App\LoanProduct;
use App\Http\Requests;
use App\LoanApplication;
use App\Repository\LoanManagement;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
	/**
	* Frontend route 
	*/
	public $route = '/loan/payments';
	
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
				'/assets/modules/loans/payments-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View loan payments made list: ', ['session' => session()->all()]);
		
        return view('modules/loans/payments.list')->with([
			'assets' => $assets
		]);
	}
	
	/**
     * Return loan payments list paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginateLoan(Request $request)
    {
		$loanApplications = DB::table('view_loan_payments')
		->where('entity_id', session('entity_id'))
		->select([
			'date', 
			'member_name',
			'loan_product_name',
			'payment_amount',
			'or_number',
		]);
			
		return Datatables::of($loanApplications)
				->editColumn('date', '{{ date("m/d/Y", strtotime($date)) }}')
				->editColumn('payment_amount', '{{ number_format($payment_amount, 2) }}')
				->make();
	}
	
	/**
     * Return balance payments list paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginateBalance(Request $request)
    {
		$balancePayment = DB::table('view_balance_payments')
		->where('entity_id', session('entity_id'))
		->select([
			'date', 
			'member_name',
			'payment_amount',
			'or_number',
		]);
		
		$balancePayment->where('type', $request->type);
				
		return Datatables::of($balancePayment)
				->editColumn('date', '{{ date("m/d/Y", strtotime($date)) }}')
				->editColumn('payment_amount', '{{ number_format($payment_amount, 2) }}')
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
				'/assets/modules/loans/payments-form.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
				'/assets/gentellela-alela/css/select/select2.min.css'
			],
			'route' => $this->route,
		];
		
		Log::info('View loan payments form: ', ['session' => session()->all()]);
	
		/* === get payment type === */
		$payementType = $this->loanRepo->loanProducts() + $this->loanRepo->balanceProducts();
	
		/* === set default payment type === */
		$payementType[''] = 'Select Payment Type';
	
        return view('modules/loans/payments.form')->with([
			'assets' 	   => $assets,
			'payementType' => $payementType,
		]);
    }
	
	/**
     * Return payments form paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginatePaymentForm(Request $request)
    {	
		$productType = LoanProduct::select('type')->find($request->product_id);
		
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
					->where('loan_product_id', $request->product_id);
					
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
	public function getGetProductTypeName(Request $request)
	{
		$loanProduct = LoanProduct::select('name')->find($request->product_id);
		
		return response()->json($loanProduct['name']);
	}
	
	/**
     * Store payments.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
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
	private function paidLoan($paymentParams)
	{
		/* === decrypt application id === */
		$loanApplicationId = Crypt::decrypt($paymentParams['id']);
		
		/* === if payment success === */
		$loanApplication = LoanApplication::find($loanApplicationId);
		
		/* === add num_made_payments === */
		$loanApplication->num_made_payments = $loanApplication->num_made_payments + 1;
		
		/* === add payment amount total_made_payments === */
		$loanApplication->total_made_payments = $loanApplication->total_made_payments + $paymentParams['payment_amount'];
		
		/* === update outstanding balance === */
		$outstandingBalance = $loanApplication->outstanding_balance;
		$remainingBalance   = $outstandingBalance - $paymentParams['payment_amount'];
		$loanApplication->outstanding_balance = $remainingBalance;
		
		$loanApplication->updated_date  = date('y-m-d');
		
		/* === check if fully paid === */
		if ($loanApplication->outstanding_balance <= 0) {
			$loanApplication->fully_paid = 1;
			$loanApplication->paid_date  = date('y-m-d');
			$loanApplication->remarks    = 'closed fully paid';
		}
		
		if ($loanApplication->save()) {
			/* ==== save payments=== */
			$this->savePayment([
				'parent_id' 		  => $loanApplicationId,
				'outstanding_balance' => $outstandingBalance,
				'payment_amount'	  => $paymentParams['payment_amount'],
				'remaining_balance'   => $remainingBalance,
				'or_number'			  => strtoupper($paymentParams['payment_or']),
				'type'			  	  => config('loans.productType.loan'),
				'entity_id'			  => session('entity_id'),
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
		
		/* === cal outstanding and remaining balance === */
		$outstandingBalance = $balance->current_balance;
		$remainingBalance   = $outstandingBalance + $paymentParams['payment_amount'];
		
		$balance->current_balance   = $balance->current_balance   + $paymentParams['payment_amount'];
		$balance->available_balance = $balance->available_balance + $paymentParams['payment_amount'];
		$balance->save();
		
		if ($balance->save()) {
			/* ==== save payments=== */
			$this->savePayment([
				'parent_id' 		  => $balance->id,
				'outstanding_balance' => (! empty($outstandingBalance)) ? $outstandingBalance : 0,
				'payment_amount'	  => $paymentParams['payment_amount'],
				'remaining_balance'   => $remainingBalance,
				'or_number'			  => strtoupper($paymentParams['payment_or']),
				'type'			  	  => $paymentParams['type'],
				'entity_id'			  => session('entity_id'),
			]);
		}
		
		Log::info($logInfo.' : ', [
			'table'	=> [
				'name' => 'balance',
				'data' => $balance->toArray()
			],
			'session' => session()->all()
		]);
		
	}
	
	/**
     * Save payments
	 *
     * @param  Array $paymentParams
     * @return void
     */
	private function savePayment($paymentParams) 
	{
		$payment = new Payment;
		$payment->parent_id 		  = $paymentParams['parent_id'];
		$payment->outstanding_balance = $paymentParams['outstanding_balance'];
		$payment->payment_amount 	   = $paymentParams['payment_amount'];
		$payment->remaining_balance   = $paymentParams['remaining_balance'];
		$payment->or_number 		  = strtoupper($paymentParams['or_number']);
		$payment->type 		  		  = $paymentParams['type'];
		$payment->entity_id 		  = session('entity_id');
		$payment->save();
		
		Log::info('Save Payment : ', [
			'table'	=> [
				'name' => 'payment',
				'data' => $payment->toArray()
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
		$orNumberCount = Payment::select('or_number')
			->where('or_number', $request->payment_or)
			->where('entity_id', session('entity_id'))
			->count();
		
		if ($orNumberCount > 0) abort(404);
	}
}
