<?php

namespace App\Http\Controllers\UsersManagement;

use Illuminate\Http\Request;

use DB;
use Log;
use Auth;
use Crypt;
use Config;
use Session;
use Datatables;

use App\User;
use App\UserGroup;
use App\Repository\UserManagement;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
	/**
	 * Determine Active Menu
	 */
	public $menuKey   = 'userActiveMenu';
	public $menuValue = 'current-page';
	
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
	}
	
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/icheck/icheck.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/dataTables.bootstrap.min.js',
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
				'/assets/modules/users/users-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			]
		];
		
		Log::info('View users list: ', ['session' => Session::all()]);
		
        return view('users.list')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets
		]);
    }
	
	/**
     * Return user list for paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginate(Request $request)
    {
		if (! $request->ajax()) {
			abort(404);
		}
		
        $users = User::select([
			'id',
			'avatar',
			'username', 
			'name', 
			'email',
			'is_login',
			'status',
		]);
			
		return Datatables::of($users)
				->editColumn('avatar',  function ($user) {
					return view('users/datatables.avatar', [
								'avatar' => $user->avatar
							])->render();
				})
				->addColumn('is_login', function ($user) {
					return view('users/datatables.isLogin', [
								'is_login' => $user->is_login
							])->render();
				})
				->editColumn('status', function ($user) {
					return view('users/datatables.status', [
								'user'   => $user, 
								'status' => Config::get('users.status')]
							)->render();
				})
				->addColumn('action', function ($user) {
					return view('users/datatables.action', [
								'encryptID' => Crypt::encrypt($user->id)
							])->render();
				})
				->removeColumn('id')
				->make();
    }
	
	/**
     * Show the form for creating a new users
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/fileinput/js/fileinput.min.js',
				'/assets/gentellela-alela/js/moment.min2.js',
				'/assets/gentellela-alela/js/datepicker/daterangepicker.js',
				'/assets/gentellela-alela/js/icheck/icheck.min.js',
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/users/users-register-form.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/js/fileinput/css/fileinput.min.css',
				'/assets/gentellela-alela/css/icheck/flat/green.css',
				'/assets/gentellela-alela/css/select/select2.min.css'
			]
		];
		
		Log::info('View user registration: ', ['session' => Session::all()]);
		
        return view('users.form')->with([
			$this->menuKey => $this->menuValue,
			'assets' 	   => $assets,
			'userGroup'    => $this->userRepo->userGroup(),
			'viewType'	   => 'create'
		]);
    }
	
	/**
     * Callback function to validate username duplication
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postValidateUsername(Request $request)
	{
		$this->validate($request, ['username' => 'unique:users']);
	}
	
	/**
     * Store a newly created user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
		$user = new User;
		$user->avatar			= ($request->hasFile('avatar')) ? $this->uploadAvatar($request->file('avatar')) : 'NULL';
		$user->username  		= $request->username;
		$user->password			= bcrypt($request->password);
		$user->expired_at		= date('y-m-d', strtotime($request->daterangepicker_end));
		$user->name		 		= ucwords($request->full_name);
		$user->contact_number	= $request->contact_number;
		$user->email	 		= $request->email;
		$user->status			= ($request->status) ? Config::get('users.status.active') : Config::get('users.status.disabled');
		$user->group_access_id  = $request->group_access;
		$user->remarks 		    = $request->remarks;
		$user->save();
		
		Log::info('Create new user: ', [
			'table'	=> [
				'name' => 'users',
				'data' => $user->toArray()
			],
			'session' => Session::all()
		]);
		 
		return response()->json([
			'success' => true,
			'message' => trans('users.successCreation')
		]);
	}
	
	/**
	* Upload avatar
	*
	* @param string	$avatarFile
	* return string 
	*/
	private function uploadAvatar($avatarFile)
	{
		$fileName = time().'.'.$avatarFile->getClientOriginalExtension();
			
		/* === move image to user image path === */
		$avatarFile->move(public_path(Config::get('users.avatar_path')), $fileName);
		
		return url('public/images/users/'.$fileName);
	}
	
	/**
	* Delete Avatar
	*
	* @param string	$avatarUrl
	* return boolean
	*/
	public function deleteAvatar($avatarUrl)
	{
		$explodeUrl = explode('/', $avatarUrl);
		
		/* === get last index of url explode === */
		$urlLAstIndex = count($explodeUrl) - 1;
	
		/* === get avatar path === */
		$avatarPath = public_path(Config::get('users.avatar_path').$explodeUrl[$urlLAstIndex]);
		
		if (file_exists($avatarPath)) {
			/* === delete images === */
			return unlink($avatarPath);
		} else {
			return false;
		}
	}
	
	/**
	* Display users information.
	*
	* @param  string  encrptyID
	* @return \Illuminate\Http\Response
	*/
	public function getShow($encrptyID)
	{
		/* === get user from db === */
		$user = User::select([
			'id',
			'avatar',
			'username',
			'expired_at',
			'name',
			'contact_number',
			'email',
			'status',
			'is_login',
			'group_access_id',
			'remarks',
			'created_at'
		])->findOrFail(Crypt::decrypt($encrptyID));
		
		/* === reformat date === */
		$user->dateRangeStart = date('m/d/Y', strtotime($user->created_at));
		$user->dateRangeEnd   = date('m/d/Y', strtotime($user->expired_at));
		
		/* === set encrptyID again === */
		$user->encrptyID = $encrptyID;
		
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/select/select2.full.js',
				'/assets/gentellela-alela/js/moment.min2.js',
				'/assets/gentellela-alela/js/datepicker/daterangepicker.js',
				'/assets/gentellela-alela/js/icheck/icheck.min.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/users/users-view.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/select/select2.min.css',
				'/assets/gentellela-alela/css/icheck/flat/green.css',
			]
		];
		
		/* === unset unnecessary user data for loggin === */
		$usersArray = $user->toArray();
		unset($usersArray['avatar']);
		unset($usersArray['encrptyID']);
	
		Log::info('View user : ', [
			'table'	=> [
				'name' => 'users',
				'data' => $usersArray
			],
			'session' => Session::all()
		]);
		 
		
		return view('users.form')->with([
			$this->menuKey    => $this->menuValue,
			'assets'	      => $assets,
			'user'		      => $user,
			'userGroup'		  => $this->userRepo->userGroup(),
			'viewType'	      => 'view',
			'isCurrentUser'	  => ((Auth::user()->id === $user->id) ? true : false)
		])
		->nest('extendExpiry', 'users.extendExpiry')
		->nest('changeStatus', 'users.changeStatus', [
			'userStatus'      => $user->status,
			'statusSelection' => $this->statusSelection($user->status),
		])
		->nest('changeGroup', 'users.changeGroup', [
			'userGroupId' => $user->group_access_id,
			'userGroup'   => $this->userRepo->userGroup(),
		])
		->nest('terminate', 'users.terminate')
		->nest('changePassword', 'users.password.change')
		->nest('changeReset', 'users.password.reset')
		;
	}
	
	/**
	* Process dynamic status selection
	*
	* @param  int  $userStatus
	* @return array
	*/
	private function statusSelection($userStatus)
	{
		/* === get status list === */
		$statusList = Config::get('users.status');
		
		/* === get status selections === */
		$selectStatus = Config::get('users.inverted_status');
		
		/* === no need for Temporary PAssword and Expired === */
		unset($selectStatus[$statusList['temporary_password']]);
		unset($selectStatus[$statusList['expired']]);
		
		/* === unset currrent status of user === */
		unset($selectStatus[$userStatus]);
		
		return $selectStatus;
	}
	
	/**
	* Display Users to modify information.
	*
	* @param  string  encrptyID
	* @return \Illuminate\Http\Response
	*/
	public function getEditProfile($encrptyID)
	{
		/* === get user from db === */
		$user = User::select([
			'id',
			'avatar',
			'username',
			'expired_at',
			'name',
			'contact_number',
			'email',
			'status',
			'group_access_id',
			'remarks',
			'created_at'
		])->findOrFail(Crypt::decrypt($encrptyID));
		
		/* === reformat date === */
		$user->dateRangeStart = date('m/d/Y', strtotime($user->created_at));
		$user->dateRangeEnd   = date('m/d/Y', strtotime($user->expired_at));
		
		/* === set encrptyID again === */
		$user->encrptyID = $encrptyID;
		
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/fileinput/js/fileinput.min.js',
				'/assets/gentellela-alela/js/moment.min2.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/users/users-modify-form.js',
			],
			'stylesheets' => [
				'/assets/gentellela-alela/js/fileinput/css/fileinput.min.css',
				'/assets/gentellela-alela/css/select/select2.min.css'
			]
		];
		
		Log::info('View user edit page: ', [
			'table'	=> [
				'name' => 'users',
				'data' => $user->toArray()
			],
			'session' => Session::all()
		]);
		
		return view('users.form')->with([
			$this->menuKey => $this->menuValue,
			'assets'	   => $assets,
			'user'		   => $user,
			'viewType'	   => 'edit',
		]);
	}
	
	/**
	* Terminate User accounts.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postUpdateProfile(Request $request)
	{
		$user = user::findOrFail($request->userId);
		
		/* === process avatar === */
		if ($request->hasFile('avatar')) {
			/* === delete current avatar === */
			$this->deleteAvatar($user->avatar);
			
			/* === upload new avatar === */
			$user->avatar = $this->uploadAvatar($request->file('avatar'));	
		}
		
		$user->name		 		= ucwords($request->full_name);
		$user->contact_number	= $request->contact_number;
		$user->email	 		= $request->email;
		$user->remarks	 		= $request->remarks;
		$user->save();
		
		Log::info('Update user profile: ', [
			'table'	=> [
				'name' => 'users',
				'data' => $request->all()
			],
			'session' => Session::all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('users.successUpdateProfile')
		]);
	}
	
	/**
	* Extend Expiry User accounts.
	*
	* @param  string  encrptyID
	* @return \Illuminate\Http\Response
	*/
	public function postExtendExpiry(Request $request)
	{
		$userId = Crypt::decrypt($request->userId);
		$user   = User::findOrFail($userId);
		$user->status     = Config::get('users.status.active');
		$user->expired_at = date('y-m-d', strtotime($request->extend_expiry));
		$user->save();
		
		Log::info('User Extend Expiry: ', [
			'table'	=> [
				'name' => 'users',
				'data' => [
					'id' 		 => $userId,
					'status'	 => Config::get('users.status.active'),
					'expired_at' => $user->expired_at,
				]
			],
			'session' => Session::all(),
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('users.successExtendExpiry')
		]);
	}
	
	/**
	* Terminate User accounts.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postTerminate(Request $request)
	{	
		$userId = Crypt::decrypt($request->userId);
		$user   = User::findOrFail($userId);
		$user->status = Config::get('users.status.terminated');
		$user->save();
		
		Log::info('User Terminated : ', [
			'table'	=> [
				'name' => 'users',
				'data' => [
					'id' 	 => $userId,
					'status' => Config::get('users.status.terminated')
				]
			],
			'session' => Session::all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('users.successTermination')
		]);
	}
	
	/**
	* Change Status 
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postChangeStatus(Request $request)
	{
		$userId = Crypt::decrypt($request->userId);
		$user   = User::findOrFail($userId);
		
		/* === if change to disabled or terminated, process here === */
		switch ($request->change_status) {
			case Config::get('users.status.disabled') :
			case Config::get('users.status.terminated') :
				/* === logout user, temporary code === */
				DB::table('sessions')->where('user_id', $userId)->delete();
				if ($user->is_login == 1) {
					$user->is_Login = 0;
				}
				break;
		}
		
		$user->status = $request->change_status;
		$user->save();
		
		Log::info('User Change Status : ', [
			'table'	=> [
				'name' => 'users',
				'data' => [
					'id' 	 => $userId,
					'status' => $request->change_status
				]
			],
			'session' => Session::all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('users.successChangeStatus')
		]);
	}
	
	/**
	* Change Group
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postChangeGroup(Request $request)
	{
		$userId = Crypt::decrypt($request->userId);
		$user   = User::findOrFail($userId);
		$user->group_access_id = $request->change_group;
		$user->save();
		
		Log::info('User Change Group : ', [
			'table'	=> [
				'name' => 'users',
				'data' => [
					'id' 	 		  => $userId,
					'group_access_id' => $request->change_group
				]
			],
			'session' => Session::all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('users.successChangeGroup')
		]);
	}
	
	/**
	* Change Password
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postChangePassword(Request $request)
	{
		$userId = Crypt::decrypt($request->userId);
		$user   = User::findOrFail($userId);
		$user->password = bcrypt($request->change_password);
		$user->save();
		
		Log::info('User Change Password : ', [
			'table'	=> [
				'name' => 'users',
				'data' => ['id' => $userId]
			],
			'session' => Session::all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('users.successChangePassword')
		]);
	}
	
	/**
	* Change Password
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postResetPassword(Request $request)
	{
		$userId = Crypt::decrypt($request->userId);
		$user   = User::findOrFail($userId);
		
		$tempPassword = str_random(8);
		$user->password = bcrypt($tempPassword);
		$user->status = Config::get('users.status.temporary_password');
		$user->save();
		
		Log::info('User Reset Password : ', [
			'table'	=> [
				'name' => 'users',
				'data' => [
					'id' 	 => $userId,
					'status' => Config::get('users.status.temporary_password'),
					'temp_password' => $tempPassword,
				]
			],
			'session' => Session::all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('users.successResetPassword')
		]);
	}
}