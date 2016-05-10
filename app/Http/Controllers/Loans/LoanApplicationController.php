<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Datatables;

use App\Member;
use App\Balance;
use App\LoanProduct;
use App\Http\Requests;
use App\LoanApplication;
use App\Repository\LoanManagement;
use App\Http\Controllers\Controller;

class LoanApplicationController extends Controller
{
    /**
	* Determine Active Menu
	*/
	public $menuKey   = 'loanActiveMenu';
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
            'getShow',
        ]]);
	}
	
	/**
     * Show the form for appliyng a loans
     *
     * @return \Illuminate\Http\Response
     */
    public function getForm()
    {
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/moment.min2.js',
				'/assets/gentellela-alela/js/datepicker/daterangepicker.js',
				'/assets/gentellela-alela/js/icheck/icheck.min.js',
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/loans/loans-application-form.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/icheck/flat/green.css',
				'/assets/gentellela-alela/css/select/select2.min.css'
			]
		];
		
		Log::info('View loan application form: ', ['session' => session()->all()]);
	
        return view('modules/loans/application.form')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets,
			'loanTypes'	   => $this->loanRepo->loanProducts(),
			'viewType'	   => 'create'
		]);
    }
	
	/**
     * Show list of current application
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
				'/assets/modules/loans/loans-application-current.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			]
		];
		
		Log::info('View loan application current: ', ['session' => session()->all()]);
		
        return view('modules/loans/application.current')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets
		]);
	}
	
	/**
     * Return loan products list for paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginate(Request $request)
    {
		$loanApplications = DB::table('view_loan_applications')
		->where('entity_id', session('entity_id'))
		->where('fully_paid', false)
		->select([
			'applied_date',
			'member_name',
			'loan_product_name',
			'application_type',
			'amount',
			'total_made_payments',
			'outstanding_balance',
			'id',
			'member_id',
		]);
			
		return Datatables::of($loanApplications)
				->editColumn('applied_date', 	    '{{ date("m/d/Y", strtotime($applied_date)) }}')
				->editColumn('amount', 			    '{{ number_format($amount, 2) }}')
				->editColumn('total_made_payments', '{{ number_format($total_made_payments, 2) }}')
				->editColumn('outstanding_balance', '{{ number_format($outstanding_balance, 2) }}')
				->addColumn('action', function ($loanApplications) {
					return view('modules/loans/application/datatables.action', [
								'encryptID' => Crypt::encrypt($loanApplications->id)
							])->render();
				})
				->removeColumn('id')
				->removeColumn('member_id')
				->make();
    }
	
	/**
     * Show specific loan member application
     *
     * @param  string  encrptyId
     * @return \Illuminate\Http\Response
     */
    public function getShow($encrptyId)
    {
		$loaApplication = DB::table('view_loan_applications')->find(Crypt::decrypt($encrptyId));
				
		Log::info('View loan application show: ', ['session' => session()->all()]);
	
        return view('modules/loans/application.show')->with([
			$this->menuKey => $this->menuValue,
			'loanTypes'	   => $this->loanRepo->loanProducts(),
			'application'  => $loaApplication,
		]);
    }
	
	/**
     * Get Member Last Name
	 *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getGetMemberInLastName(Request $request)
	{
		return $this->loanRepo->getMemberInLastName($request->last_name);
	}
	
	/**
     * Get Member Name
     *
     * @param  int  memberId
     * @return \Illuminate\Http\Response Json
     */
	public function getGetMemberName($memberId = '')
	{
		$member = Member::select([
			'first_name',
			'middle_name',
			'last_name',
		])->find($memberId);
		
		$memberName = (! empty($member))
			? $memberName = $member->first_name.' '.$member->middle_name.' '.$member->last_name 
			: '';
		
		return response()->json([
			'member_id'	  => $memberId,
			'member_name' => $memberName
			
		]);
	}
	
	/**
     * Validate application type
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getValidateApplicationType(Request $request)
	{
		$loanCount = LoanApplication::select('id')->where([
			'member_id' 	  => $request->member_id,
			'loan_product_id' => $request->loan_type,
		])->count();
		
		if ($request->application_type == config('loans.applicationType.new')) {
			/* === if has current application to this loan product, not allowed === */
			if ($loanCount > 0) return abort(404);
		}
		
		if ($request->application_type == config('loans.applicationType.renewal')) {
			/* === if has current application to this loan product, allowed === */
			if ($loanCount <= 0) return abort(404);
		}
	}
	
	
	/**
     * Validate loam amount
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getValidateLoanAmount(Request $request) 
	{
		$loanProduct = LoanProduct::select('principal')->find($request->loan_product_id);
		
		/* === if loan_amount is higher than principal, not allowed === */
		if ((int)$request->loan_amount > $loanProduct['principal']) return abort(404);
	}
	
	/**
     * Get Application Id (user for renewal)
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getGetApplicationId(Request $request)
	{
		if ($request->application_type == config('loans.applicationType.renewal')) {
			$loanApplication = LoanApplication::select('id')->where([
				'member_id' 	  => $request->member_id,
				'loan_product_id' => $request->loan_product_id,
			]);
			
			if ($loanApplication->count() > 0) {
				return response()->json($loanApplication->first()->id);
			}
		}
		
		return response()->json(0);
	}
	
	/**
     * Get Principal Amount
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getGetPrincipalAmount(Request $request)
	{
		$loanProduct = LoanProduct::select('principal')->find($request->loan_product_id);
		
		$principalAmount = (! empty($loanProduct['principal'])) ? $loanProduct['principal'] : 0.00;
		
		return response()->json($principalAmount);
	}
	
	/**
     * Calculate Advance Interest
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getCalAdvanceInterest(Request $request) 
	{
		/* === get advance interest parameters === */
		$advanceInterestParam = $this->loanRepo->getAdvanceInterest($request->loan_product_id);
		
		/* === compute advance interest and send === */
		return response()->json($request->loan_amount * $advanceInterestParam['interest'] * $advanceInterestParam['term']);
	}
	
	/**
     * Calculate Advance Interest
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getCalProcessingFee(Request $request) 
	{
		if (! empty($request->loan_amount)) {
			$loanProduct = LoanProduct::select('principal')->find($request->loan_product_id);
			
			/* === get 2% of principal === */
			$twoPercent = ($loanProduct['principal'] * 0.02);
			
			/* === Php500 or 2% of principal whichever is lower === */
			$processingFee =  ($twoPercent < 500) ? $twoPercent : 500;
		} else {
			$processingFee = 0.00;
		}
		
		return response()->json($processingFee);
	}
	
	/**
     * Calculate Net Proceeds
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getCalNetProceeds(Request $request) 
	{
		/* === (Loan Amount) - (Total Deductions)  === */
		$netProceeds = ($request->loan_amount - $request->total_deduction);
		return response()->json($netProceeds);
	}
	
	/**
     * Calculate Total deduction
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getCalTotalDeduction(Request $request) 
	{	
		/* ===  (Advance Interest) + (Processing Fee) + (Capital Build-Up) === */
		$totalDeduction = ($request->advance_interest + $request->processing_fee + $request->capital_build_up);
		return response()->json($totalDeduction);
	}
	
	/**
     * Get Amortization
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getGetAmortization(Request $request) 
	{
		$loanProduct = LoanProduct::select('amortization')->find($request->loan_product_id);
		
		if (empty($loanProduct['amortization'])) {
			/* === calculate amortization === */
			$amortization = 'compute';
		} else {
			/* === get in db === */
			$amortization = $loanProduct['amortization'];
		}
		
		return response()->json($amortization);
	}
	
	/** 
	 * Get New Application Outstanding Balance
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getCalNewApplicationOutstandingBalance(Request $request)
	{	
		$loanProduct = LoanProduct::select('term', 'amortization')->find($request->loan_product_id);
		
		$mortization = ($request->amortization) ? $request->amortization : $loanProduct['amortization'];
		
		/* === loan product term * amortization === */
		return response()->json($loanProduct['term'] * $mortization);
	}
	
	/** 
	 * Get Renewal Application Outstanding Balance
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getCalRenewalApplicationOutstandingBalance(Request $request)
	{	
		$loanApplication = LoanApplication::select('outstanding_balance')->find($request->loan_application_id);
				
		return response()->json($loanApplication['outstanding_balance']);
	}
	
	/**
     * Store Application
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postStore(Request $request) 
	{
		$loan = new LoanApplication;
		$loan->member_id 			= $request->member_name;
		$loan->application_type 	= $request->application_type;
		$loan->loan_product_id  	= $request->loan_type;
		$loan->amount           	= $request->loan_amount;
		$loan->advance_interest 	= $request->advance_interest;
		$loan->processing_fee 		= $request->processing_fee;
		$loan->capital_build_up 	= $request->capital_build_up;
		$loan->total_deduction  	= $request->total_deduction;
		$loan->net_proceeds	    	= $request->net_proceeds;
		$loan->outstanding_balance  = $request->outstanding_balance;
		$loan->rebate 				= $request->rebate;
		$loan->amortization	    	= $request->monthly_amortization;
		$loan->applied_date	    	= date('y-m-d', strtotime($request->applied_date));
		$loan->entity_id	    	= session('entity_id');
		$loan->save();
		
		$this->saveCapitalBalance($loan->member_id, $request->capital_build_up);
		
		Log::info('Create application : ', [
			'table'	=> [
				'name' => 'loans',
				'data' => $loan->toArray()
			],
			'session' => session()->all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('loans.successLoanApplication'),
		]);
	}
	
	/**
     * Save Capital Balance
     *
     * @param  int	$memberID
     * @param  int	$capitalBuildUp
     * @return void
     */
	protected function saveCapitalBalance($memberID, $capitalBuildUp)
	{
		$getBalance = Balance::select('id')->where('member_id', $memberID)->first();
		 
		if (empty($getBalance)) {
			$logInfo = 'Create capital';
			$balance = new Balance;
			$balance->member_id = $memberID;
			$balance->type 		= 'capital';
		} else {
			$logInfo = 'Update capital';
			$balance = Balance::find($getBalance->id);
		}
		
		$balance->current_balance   = $balance->current_balance   + $capitalBuildUp;
		$balance->available_balance = $balance->available_balance + $capitalBuildUp;
		$balance->save();
		
		Log::info($logInfo.' : ', [
			'table'	=> [
				'name' => 'balance',
				'data' => $balance->toArray()
			],
			'session' => session()->all()
		]);
	}
}
