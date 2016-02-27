<?php

namespace App\Http\Controllers\UsersManagement;

use Illuminate\Http\Request;

use Log;
use Crypt;
use Session;
use Datatables;

use App\UserGroup;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserGroupController extends Controller
{
    /**
	* Determine Active Menu
	*/
	public $menuKey   = 'userGroupActiveMenu';
	public $menuValue = 'current-page';
	
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
				'/assets/modules/users/users-groups-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			]
		];
		
		Log::info('View user groups: ', ['session' => Session::all()]);
		
        return view('users/groups.list')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets
		])
		->nest('editUserGroupView', 'users/groups.edit');
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
		
		/* === get order of name from request === */
		$orderBy = $request->input('order')[0]['dir'];
		
		$userGroup = UserGroup::select(['id', 'name', 'description'])->orderBy('name', $orderBy);
		
		return Datatables::of($userGroup)
				->editColumn('action', function ($userGroup) {
					return view('users/groups/datatables.action', [
								'encryptID' => Crypt::encrypt($userGroup->id)
							])->render();
				})
				->removeColumn('id')
				->make();
    }
	
	/**
	* Return details of specific Group.
	*
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
