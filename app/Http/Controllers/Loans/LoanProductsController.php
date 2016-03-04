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

class LoanProductsController extends Controller
{
    /**
	* Determine Active Menu
	*/
	public $menuKey   = 'loanProductsActiveMenu';
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
     * Display a listing of the loan products
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
				'/assets/modules/loans/loans-products-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			]
		];
		
		Log::info('View loan products: ', ['session' => session()->all()]);
		
			
        return view('modules/loans/products.list')->with([
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
		if (! $request->ajax()) {
			abort(404);
		}
		
		$select = [
			'code',
			'name',
			'principal',
			'term',
			'interest',
			'loan_products.id',
		];
		
		$loanProducts = DB::table('loan_products')
				->leftJoin('entities', 'entities.id', '=', 'loan_products.entity_id')
				->select($select);
		
		
		return Datatables::of($loanProducts)
				->editColumn('principal', '{{ number_format($principal, 2) }}')
				->editColumn('term', '{{ $term }} months')
				->editColumn('interest', '{{ $interest }}%')
				->addColumn('action', function ($loanProducts) {
					return view('modules/loans/products/datatables.action', [
								'encryptID' => Crypt::encrypt($loanProducts->id)
							])->render();
				})
				->removeColumn('id')
				->make();
    }
	
	/**
     * Show the form for creating a new products
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/loans/loans-products-create-form.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/select/select2.min.css'
			]
		];
		
		Log::info('View loan products create: ', ['session' => session()->all()]);
	
        return view('modules/loans/products.form')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets,
			'entities'     => $this->loanRepo->entities(),
			'viewType'	   => 'create'
		]);
    }
	
	/**
     * Store a newly created loan products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
		$loanProduct = new LoanProduct;
		$loanProduct->name 	    = ucwords($request->product_name);
		$loanProduct->principal = $request->principal_amount;
		$loanProduct->term   	= $request->term;
		$loanProduct->interest  = $request->interest_rate;
		$loanProduct->entity_id = $request->entity;
		$loanProduct->remarks   = $request->remarks;
		$loanProduct->save();
		
		Log::info('Create new loan product: ', [
			'table'	=> [
				'name' => 'loan_products',
				'data' => $loanProduct->toArray()
			],
			'session' => session()->all()
		]);
		 
		return response()->json([
			'success' => true,
			'message' => trans('loans.successLoanProductCreation')
		]);
	}
}


