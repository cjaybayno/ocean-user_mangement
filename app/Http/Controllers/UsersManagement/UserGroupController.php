<?php

namespace App\Http\Controllers\UsersManagement;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Session;
use Datatables;

use App\UserGroup;
use App\Http\Requests;
use App\Repository\UserManagement;
use App\Http\Controllers\Controller;

class UserGroupController extends Controller
{
	/**
     * The user repository implementation.
     */
	protected $userRepo;
	
	/**
     * Create a new instance.
     *
     * @param  UserManagement  $UserRepository
     * @return void
     */
	public function __construct(UserManagement $UserRepository)
	{
		$this->userRepo = $UserRepository;
		
		$this->authorize('adminRole');
	}
	
	
	/**
     * Display a listing of the user groups
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
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/users/users-groups-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
				'/assets/gentellela-alela/css/select/select2.min.css',
			]
		];
		
		Log::info('View user groups: ', ['session' => Session::all()]);
		
		$entities = $this->userRepo->entities();
		$entities[0] = 'No Entity';
		
        return view('modules/users/groups.list')->with([
			'assets' => $assets
		])
		->nest('editUserGroupView', 'modules/users/groups.edit')
		->nest('addUserGroupView',  'modules/users/groups.add', [
			'entities' => $entities,
		]);
    }
	
	/**
     * Return user gruop list for paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginate(Request $request)
    {
		if (! $request->ajax()) {
			abort(404);
		}
		
		$select = [
			'user_groups.name',
			'entities.code',
			'user_groups.description',
			'user_groups.id',
		];
		
		
		$userGroup = DB::table('user_groups')
				->leftJoin('entities', 'entities.id', '=', 'user_groups.entity_id')
				->select($select);
		
		return Datatables::of($userGroup)
				->addColumn('action', function ($userGroup) {
					return view('modules/users/groups/datatables.action', [
								'encryptID' => Crypt::encrypt($userGroup->id)
							])->render();
				})
				->removeColumn('id')
				->make();
    }
	
	/**
	* Return details of specific Group.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  string  encrptyID
	* @return \Illuminate\Http\Response
	*/
	public function getGetGroup(Request $request, $encryptID)
	{
		if (! $request->ajax()) {
			abort(404);
		}
		
		$userGroup = UserGroup::findOrFail(Crypt::decrypt($encryptID));
		
		return response()->json([
			'encryptId'  => $encryptID,
			'groupNAme' => $userGroup->name,
			'groupDesc' => $userGroup->description,
		]);
		
		Log::info('Edit user groups (get group details) : ', [
			'table'	=> [
				'name' => 'user_groups',
				'data' => $userGroup
			],
			'session' => Session::all()
		]);
	}
	
	/**
	* Store Group
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postStoreGroup(Request $request)
	{
		$userGroup = new UserGroup;
		$userGroup->name        = ucwords($request->group_name);
		$userGroup->description = $request->group_desc;
		
		/* === if has entity selected === */
		if (! empty($request->group_entity) OR $request->group_entity != 0) {
			$userGroup->entity_id = $request->group_entity;
		}
		
		$userGroup->save();
		
		Log::info('Create user group: ', [
			'table'	=> [
				'name' => 'users_groups',
				'data' => $userGroup->toArray(),
			],
			'session' => Session::all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('users.successAddUserGroup')
		]);
	}
	
	/**
	* Update Group
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postUpdateGroup(Request $request)
	{
		$userGroup = UserGroup::findOrFail(Crypt::decrypt($request->encryptId));
		$userGroup->name        = ucwords($request->group_name);
		$userGroup->description = $request->group_desc;
		$userGroup->save();
		
		Log::info('Update user group: ', [
			'table'	=> [
				'name' => 'users_groups',
				'data' => $userGroup->toArray(),
			],
			'session' => Session::all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('users.successEditUserGroup')
		]);
	}
}
