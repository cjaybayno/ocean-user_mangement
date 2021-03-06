<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use DB;
use Log;
use Crypt;
use Session;
use Datatables;

use App\Module;
use App\UserGroup;
use App\Http\Requests;
use App\Repository\Modules;
use App\Repository\UserManagement;
use App\Http\Controllers\Controller;

class UserGroupController extends Controller
{
	/**
	* Frontend route 
	*/
	protected $route = '/user/groups';
	
	/**
     * The parameters repository implementation.
     *
     * @var parameters
     */
    protected $modules;
	
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
	public function __construct(UserManagement $UserRepository, Modules $modules)
	{
		$this->userRepo = $UserRepository;
		$this->modules  = $modules;
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
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/css/dataTables.responsive.css',
				'/assets/gentellela-alela/css/select/select2.min.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View user groups: ', ['session' => Session::all()]);
		
		$entities = $this->userRepo->entities();
		$entities[0] = 'No Entity';
		
        return view('modules/users/groups.list')->with([
			'assets' => $assets
		])
		->nest('editUserGroupView', 'modules/users/groups.edit',[
			'entities' => $entities,
		])
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
		
		Log::info('Edit user groups (get group details) : ', [
			'table'	=> [
				'name' => 'user_groups',
				'data' => $userGroup
			],
			'session' => Session::all()
		]);
		
		return response()->json([
			'encryptId'   => $encryptID,
			'groupNAme'   => $userGroup->name,
			'groupEntity' => $userGroup->entity_id,
			'groupDesc'   => $userGroup->description,
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
		$userGroup->entity_id   = $request->group_entity;
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
	
	/**
     * Group Access
     *
     * @return \Illuminate\Http\Response
     */
	public function getAccess($encryptId)
	{
		$userGroup = UserGroup::findorFail(Crypt::decrypt($encryptId));
		
		$role = (! empty($userGroup['entity_id'])) ? config('users.role.client') : false;
		
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/icheck/icheck.min.js',
				'/assets/modules/users/users-groups-modules.js' ,
			],
			'route' => $this->route,
		];
		
		Log::info('View modules list : ', ['session' => session()->all()]);
		
        return view('modules/users/groups.modules')->with([
			'assets'    => $assets,
			'menusUl'   => $this->buildMenusUlTree($this->modules->getMenus(0, true, $role)),
			'menusId'   => json_encode($this->modules->getMenusAccess($userGroup['id'])),
			'userGroup' => $userGroup,
			'encryptId' => $encryptId,
		]);
	}
	
	/**
     * Build Menus UL Tree
     *
     * @param array $menus
     * @return string
     */
	protected function buildMenusUlTree($menus, $loop = false, $parentId = 0) {
		$orderList = '';
		
		foreach ($menus as $menu) {
			$ulClass        = (!$loop) ? 'nav side-menu to_do' : 'nav child_menu';
			$liStyle 	    = (!$loop) ? '' : 'display:none';
			$moduleParentId = (!$loop) ? '0' : $parentId;
			$childCount     = (! empty($menu['child'])) ? '('.count($menu['child']).')' : '';
			$cursorPnter    = (! empty($menu['child'])) ? 'cursor:pointer;' : '';
			
			/* === build html ul li === */
			$orderList .= '<ul class="'.$ulClass.'">';
			$orderList .= '<li style="'.$liStyle.'">';
			$orderList .= '<p style="'.$cursorPnter.'">';
			$orderList .= '<input type="checkbox" class="flat" parent-id="'.$moduleParentId.'" id="'.$menu['id'].'"> '.$menu['label'].' '.$childCount;
			$orderList .= '</p>';
			
			if (! empty($menu['child'])) {
				$orderList .= $this->buildMenusUlTree($menu['child'], true, $menu['id']);
			}
			
			$orderList .= '</li>';
			$orderList .= '</ul>';
		}
		
		return $orderList;
	}
	
	/**
	* Update group module
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postUpdateGroupModule(Request $request)
	{
		$groupId = Crypt::decrypt($request->encryptId);
		
		$currentMenusId = $this->modules->getMenusAccess($groupId);
		
		/* === insert new menus === */
		$insertMenusId = array_diff($request->update_menusId, $currentMenusId);
		foreach($insertMenusId as $insertMenuId) {
			DB::table('user_group_modules')->insert([
				'module_id' => $insertMenuId,
				'group_id'  => $groupId,
			]);	
		}
		
		/* === delete remove menus === */
		$removeMenusId = array_diff($currentMenusId, $request->update_menusId);
		foreach($removeMenusId as $removeMenuId) {
			DB::table('user_group_modules')
				->where('module_id', $removeMenuId)
				->where('group_id', $groupId)
				->delete();
		}
		
		return response()->json([
			'success' => true,
			'message' => trans('users.successEditUserGroupModule'),
			'insert' => $insertMenusId,
			'remove' => $removeMenusId,
		]);
	}
}
