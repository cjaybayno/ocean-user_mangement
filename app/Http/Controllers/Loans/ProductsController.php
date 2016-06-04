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

class ProductsController extends Controller
{
	/**
	* Frontend route 
	*/
	public $route = '/loan/products';
	
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
				'/assets/modules/loans/products-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View loan products: ', ['session' => session()->all()]);
		
			
        return view('modules/loans/products.list')->with([
			'assets' => $assets
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
				->where('entity_id', session('entity_id'))
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
				'/assets/modules/loans/products-create-form.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/select/select2.min.css'
			],
			'route' => $this->route,
		];
		
		Log::info('View loan product create: ', ['session' => session()->all()]);
	
        return view('modules/loans/products.form')->with([
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
		$loanProduct->entity_id = (session('role') == config('users.role.client')) ? session('entity_id') : $request->entity;
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
	
	/**
     * Show specific loan products
     * 
     * @param string $encryptID
     * @return \Illuminate\Http\Response
     */
    public function getShow($encryptID)
    {
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/loans/products-view-form.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/select/select2.min.css'
			],
			'route' => $this->route,
		];
		
		$loanProduct = LoanProduct::findOrFail(Crypt::decrypt($encryptID));
		
		Log::info('View loan product show: ', ['session' => session()->all()]);
	
        return view('modules/loans/products.form')->with([
			'assets' 	   => $assets,
			'entities'     => $this->loanRepo->entities(),
			'viewType'	   => 'view',
			'loanProduct'  => $loanProduct,
			'encryptId'    => $encryptID,
		]);
    }
	
	/**
     * Show edit form of specific loan products
     * 
     * @param string $encryptID
     * @return \Illuminate\Http\Response
     */
    public function getEdit($encryptID)
    {
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/loans/products-edit-form.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/select/select2.min.css'
			],
			'route' => $this->route,
		];
		
		$loanProduct = LoanProduct::findOrFail(Crypt::decrypt($encryptID));
		
		Log::info('View loan product show: ', ['session' => session()->all()]);
	
        return view('modules/loans/products.form')->with([
			'assets' 	   => $assets,
			'entities'     => $this->loanRepo->entities(),
			'viewType'	   => 'edit',
			'loanProduct'  => $loanProduct,
			'encryptId'    => $encryptID
		]);
    }
	
	/**
     * Update a specific loan products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request)
    {
		$loanProduct = LoanProduct::findOrFail(Crypt::decrypt($request->encrypt_id));
		$loanProduct->name 	    = ucwords($request->product_name);
		$loanProduct->principal = $request->principal_amount;
		$loanProduct->term   	= $request->term;
		$loanProduct->interest  = $request->interest_rate;
		$loanProduct->remarks   = $request->remarks;
		$loanProduct->save();
		
		Log::info('Update loan product: ', [
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


