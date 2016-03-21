<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Datatables;

use App\Loan;
use App\Member;
use App\LoanProduct;
use App\Http\Requests;
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
     * Validate member id value
	 *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getValidateMemberId(Request $request) 
	{
		Member::findOrFail($request->member_id);
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
     * Validate member id value
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getValidateCurrentApplication(Request $request) 
	{
		$loanCount = Loan::where([
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
		/* === 1% of loanAmount === */
		return response()->json($request->loan_amount * 0.01);
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
}
