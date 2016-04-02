<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Datatables;

use App\Member;
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
			'net_proceeds',
			'outstanding_balance',
			'id',
			'member_id',
		]);
			
		return Datatables::of($loanApplications)
				->editColumn('applied_date', 	    '{{ date("m/d/Y", strtotime($applied_date)) }}')
				->editColumn('amount', 			    '{{ number_format($amount, 2) }}')
				->editColumn('net_proceeds', 	    '{{ number_format($net_proceeds, 2) }}')
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
     * Validate current application
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getValidateCurrentApplication(Request $request) 
	{
		$loanCount = LoanApplication::where([
			'member_id' 	  => $request->member_id,
			'loan_product_id' => $request->loan_type,
		])->count();
		
		/* === if has current application to this loan product, not allowed === */
		if ($loanCount > 0) return abort(404);
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
     * @param  int  $loanProductId
     * @param  int  $amortization
     * @return \Illuminate\Http\Response
     */
	protected function getNewApplicationOutstandingBalance($loanProductId, $amortization)
	{
		$loanProduct = LoanProduct::select('term')->find($loanProductId);
		
		/* === loan product term * amortization === */
		return $loanProduct['term'] * $amortization;
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
		$loan->member_id 		= $request->member_name;
		$loan->application_type = $request->application_type;
		$loan->loan_product_id  = $request->loan_type;
		$loan->amount           = $request->loan_amount;
		$loan->advance_interest = $request->advance_interest;
		$loan->processing_fee 	= $request->processing_fee;
		$loan->capital_build_up = $request->capital_build_up;
		$loan->total_deduction  = $request->total_deduction;
		$loan->net_proceeds	    = $request->net_proceeds;
		$loan->net_proceeds	    = $request->net_proceeds;
		$loan->amortization	    = $request->monthly_amortization;
		$loan->applied_date	    = date('y-m-d', strtotime($request->applied_date));
		$loan->entity_id	    = session('entity_id');
		
		switch ($request->application_type) {
			case config('loans.applicationType.new') :
					$loan->outstanding_balance = $this->getNewApplicationOutstandingBalance(
						$request->loan_type,
						$request->monthly_amortization
					);
				break;
				
			case config('loans.applicationType.new') :
					$loan->rebate = $request->rebate;
					$loan->outstanding_balance = $request->outstanding_balance;
				break;
		}
		
		$loan->save();
		
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
}
