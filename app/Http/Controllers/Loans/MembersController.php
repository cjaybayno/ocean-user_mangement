<?php

namespace App\Http\Controllers\Loans;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Datatables;

use App\LoanMember;
use App\Http\Requests;
use App\Repository\MemberManagement;
use App\Http\Controllers\Controller;

class MembersController extends Controller
{
	/**
	* Frontend route 
	*/
	public $route = '/loan/members';
	
	/**
     * The member repository implementation.
     */
	protected $memberRepo;
	
	/**
     * Create a new instance.
     *
     * @return void
     */
	public function __construct(MemberManagement $memberRepo)
	{
		$this->authorize('menuAccessByName', 'members');
		
		$this->middleware('ajax.request', ['except' => [
            'getIndex',
            'getRegister',
			'getShow',
			'getEdit',
        ]]);
		
		$this->memberRepo = $memberRepo;
	}
	
	/**
     * Show list of payments made
     *
     * @return \Illuminate\Http\Response
     */
	public function getIndex()
	{
		$this->authorize('subMenuAccessByName', 'member_list');
		
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/dataTables.bootstrap.min.js',
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
				'/assets/modules/loans/members-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/css/dataTables.responsive.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View members list: ', ['session' => session()->all()]);
		
        return view('modules/loans/members.list')->with([
			'assets' => $assets
		]);
	}
	
	/**
     * Return members list paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginate(Request $request)
    {	
		$members = DB::table('view_members')
		->select([
			'member_name', 
			'contact_number',
			'email_address',
			'id'
		])
		->where('entity_id', session('entity_id'));
			
		return Datatables::of($members)
				->addColumn('action', function ($members) {
					return view('modules/loans/members/datatables.action', [
								'encryptID' => Crypt::encrypt($members->id)
							])->render();
				})
				->removeColumn('id')
				->make();
	}
	
	/**
     * Show registration
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
		$this->authorize('moduleAccessByName', 'member_register');
		
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/moment.min2.js',
				'/assets/gentellela-alela/js/datepicker/daterangepicker.js',
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/loans/members-registration.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/select/select2.min.css'
			],
			'route' => $this->route,
		];
		
		Log::info('View member registration form: ', ['session' => session()->all()]);
	
        return view('modules/loans/members.register')->with([
			'assets' 	   => $assets,
			'provinceCity' => $this->memberRepo->provinceCity(),
		]);
    }
	
	/**
     * Show specific member
     *
     * @param string $encryptId
     * @return \Illuminate\Http\Response
     */
    public function getShow($encryptId)
    {
		Log::info('View specific member : ', ['session' => session()->all()]);
	
        return view('modules/loans/members.show')->with([
			'member' 	=>  LoanMember::findOrFail(Crypt::decrypt($encryptId)),
			'encryptId' => $encryptId,
		]);
    }
	
	/**
     * Show Edit form
     *
     * @param string $encryptId
     * @return \Illuminate\Http\Response
     */
    public function getEdit($encryptId)
    {
		$member =  LoanMember::findOrFail(Crypt::decrypt($encryptId));
		
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/moment.min2.js',
				'/assets/gentellela-alela/js/datepicker/daterangepicker.js',
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/loans/members-modify.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/select/select2.min.css'
			],
			'route' => $this->route,
		];
		
		Log::info('View member edit form: ', ['session' => session()->all()]);
	
        return view('modules/loans/members.edit')->with([
			'assets' 	   => $assets,
			'provinceCity' => $this->memberRepo->provinceCity(),
			'brgyTown' 	   => $this->memberRepo->brgyTown($member->province_city_address),
			'encryptId'    => $encryptId,
			'member' 	   => $member,
		]);
    }
	
	/**
     * Get list of Barangay/Town.
     *
     * @return JSON of location in zipcodes
     */
	public function getBrgyTown($provinceCity)
	{
		return response()->json($this->memberRepo->brgyTown($provinceCity));
	}
	
	/**
     * Get Zipcode of Barangay Town.
     *
     * @return JSON of zipcodes
     */
	public function getZipcode($brgyTown)
	{
		return response()->json($this->memberRepo->zipCode($brgyTown));
	}
	
	/**
     * Store members registration
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postStore(Request $request) 
	{
		$member = new member;
		$member->first_name  			= ucwords($request->first_name);
		$member->last_name 	 			= ucwords($request->last_name);
		$member->middle_name 			= ucwords($request->middle_name);
		$member->gender		 			= $request->gender;
		$member->marital_status 		= $request->marital_status;
		$member->birth_place 			= ucwords($request->birth_place);
		$member->birth_date 			= date('y-m-d', strtotime($request->birth_date));
		$member->mother_maiden_name 	= ucwords($request->mother_maiden_name);
		$member->contact_number	 		= $request->contact_number;
		$member->email_address	 		= $request->email_address;
		$member->street_address	 		= ucwords($request->street);
		$member->brgy_town_address		= $request->brgy_town;
		$member->province_city_address	= $request->province_city;
		$member->province_city_address	= $request->province_city;
		$member->zipcode_address		= $request->zipcode;
		$member->entity_id				= session('entity_id');
		$member->save();
		
		Log::info('Register member : ', [
			'table' => [
				'name' => 'members',
				'data' => $member->toArray()
			],
			'session' => session()->all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('members.successRegistration'),
		]);
	}
	
	/**
     * Update members 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postUpdate(Request $request) 
	{
		$member =  LoanMember::findOrFail(Crypt::decrypt($request->encryptId));
		$member->first_name  			= ucwords($request->first_name);
		$member->last_name 	 			= ucwords($request->last_name);
		$member->middle_name 			= ucwords($request->middle_name);
		$member->gender		 			= $request->gender;
		$member->marital_status 		= $request->marital_status;
		$member->birth_place 			= ucwords($request->birth_place);
		$member->birth_date 			= date('y-m-d', strtotime($request->birth_date));
		$member->mother_maiden_name 	= ucwords($request->mother_maiden_name);
		$member->contact_number	 		= $request->contact_number;
		$member->email_address	 		= $request->email_address;
		$member->street_address	 		= ucwords($request->street);
		$member->brgy_town_address		= $request->brgy_town;
		$member->province_city_address	= $request->province_city;
		$member->province_city_address	= $request->province_city;
		$member->zipcode_address		= $request->zipcode;
		$member->save();
		
		Log::info('Register member : ', [
			'table' => [
				'name' => 'members',
				'data' => $member->toArray()
			],
			'session' => session()->all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('members.successModify'),
		]);
	}
}
