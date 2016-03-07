<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Datatables;

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
    public function getApplication()
    {
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/icheck/icheck.min.js',
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/loans/loans-products-create-form.js',
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
			'viewType'	   => 'create'
		]);
    }
	
}
