<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;

use DB;
use Log;
use Route;
use Crypt;
use Datatables;

use App\Module;
use App\Member;
use App\Http\Requests;
use App\Repository\Modules;
use App\Http\Controllers\Controller;

class ModulesController extends Controller
{
    /**
	* Frontend route 
	*/
	protected $route = '/portal/modules';
	
	/**
     * The parameters repository implementation.
     *
     * @var parameters
     */
    protected $modules;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Modules $modules)
    {
       $this->modules = $modules;
    }
	
	/**
     * Show list of modules
     *
     * @return \Illuminate\Http\Response
     */
	public function getIndex()
	{
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/jquery-ui.min.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/dataTables.bootstrap.min.js',
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
				'/assets/modules/portal/modules-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/jquery-ui.min.css',
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View modules list : ', ['session' => session()->all()]);
		
        return view('modules/portal/modules.list')->with([
			'assets'  => $assets,
			'modules' => Module::select('id', 'label')
							->where('parent_id', 0)
							->orderBy('order_list')
							->get(),
		]);
	}
	
	/**
     * Return modules list for paginated.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginate(Request $request)
    {
		$modules = Module::where('parent_id', 0)
		->select([
			'name',
			'label',
			'role',
			'order_list',
			'active',
			'id',
		]);
			
		return Datatables::of($modules)
			->editColumn('role', '{{ config("users.inverted_role.$role") }}')
			->editColumn('active', function ($modules) {
					return view('modules/portal/modules/dataTables.active', $modules)->render();
			})
			->addColumn('action', function ($modules) {
					return view('modules/portal/modules/datatables.action', [
								'encryptID' => Crypt::encrypt($modules->id)
							])->render();
				})
			->removeColumn('id')
			->make();
    }
	
	/**
     * Get Module info
     *
     * @param  string  encrptyId
     * @return \Illuminate\Http\Response
     */
    public function getGetModuleInfo($encrptyId)
    {
		return Module::select('name', 'label', 'role', 'active')
			->where('id', Crypt::decrypt($encrptyId))
			->first();
    }
	
	/**
     * Validate Module Name
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getValidateModuleName(Request $request)
    {
		$module = Module::select('id')->where('name', $request->name);
		
		if (! empty($request->encryptId)) 
			$module->where('id', '!=', Crypt::decrypt($request->encryptId));
			
		if ($module->count() > 0) return abort(404);
    }
	
	/**
     * Validate Module Label
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getValidateModuleLabel(Request $request)
    {
		$module = Module::select('id')->where('label', $request->label);
			
		if (empty($request->isMenu))
			$module->where('parent_id', 0);
		
		if (! empty($request->encryptId)) 
			$module->where('id', '!=', Crypt::decrypt($request->encryptId));
			
		if ($module->count() > 0) return abort(404);
    }
	
	/**
     * Validate Module Route
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getValidateModuleRoute(Request $request)
	{
		if ($request->route != " " AND ! Route::has($request->route)) abort(404);
	}
	
	/**
     * Add Module
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postStoreModule(Request $request) 
	{
		$module = new Module;
		$module->name  		= $request->name;
		$module->label 		= strtoupper($request->label);
		$module->order_list = Module::where('parent_id', 0)->max('order_list') + 1;
		$module->role  		= $request->role;
		$module->save();
		
		Log::info('Add modules info : ', [
			'table' => [
				'name' => 'modules',
				'data' => $module->toArray()
			],
			'session' => session()->all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('modules.successAddModule'),
		]);
	}
	
	/**
     * Update Module
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postUpdateModule(Request $request) 
	{
		$parentModuleId = Crypt::decrypt($request->encryptId);
		
		$module = Module::find($parentModuleId);
		if ($module->name   != $request->name)   $module->name  = $request->name;
		if ($module->label  != $request->label)  $module->label = strtoupper($request->label);
		if ($module->active != $request->active) $module->active  = $request->active;
		
		if ($module->role != $request->role) {
			$module->role  = $request->role;	
			$this->updateChildRole($parentModuleId, $request->role);
		}
		
		$module->save();
		
		Log::info('Modify modules info : ', [
			'table' => [
				'name' => 'modules',
				'data' => $module->toArray()
			],
			'session' => session()->all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('modules.successModifyModule'),
		]);
	}
	
	/**
     * Update Child Role
     *
     * @param  int   $moduleId
     * @return void
     */
	protected function updateChildRole($moduleId, $role)
	{
		$roleModules = $this->modules->getMenus($moduleId, false);
		
		foreach ($roleModules as $roleModule) {
			DB::table('modules')->where('id', $roleModule->id)->update(['role' => $role]);
			
			if (! empty($roleModule['child'])) {
				$this->updateChildRole($roleModule['id'], $role);
			}
		}
	}
	
	/**
     * Update Module
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postReorderModule(Request $request) 
	{
		foreach($request->data as $data) {
			$module = Module::find($data['id']);
			$module->order_list = $data['order'];
			$module->save();
		}
		
		Log::info('Reorder modules : ', [
			'table' => [
				'name' => 'modules',
				'data' => $request->data
			],
			'session' => session()->all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('modules.successReorderModule'),
		]);
	}
	
	/**
     * Show specific modules 
     *
     * @param  string  encrptyId
     * @return \Illuminate\Http\Response
     */
    public function getShow($encrptyId)
    {
		$modulesId = Crypt::decrypt($encrptyId);
		$modules   = Module::find($modulesId);
		
		$assets = [
			'scripts' => [
				'/assets/gentellela-alela/js/jquery-ui.min.js',
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/modules/portal/modules-show.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/jquery-ui.min.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View modules show : ', ['session' => session()->all()]);
	
        return view('modules/portal/modules.show')->with([
			'assets'  		 => $assets,
			'selected_menus' => $this->modules->getMenus($modulesId, false),
			'modules' 		 => $modules,
			'menuId'		 => $encrptyId,
		])
		->nest('iconList', 'modules/portal/modules.iconList');
    }
	
	/**
     * Get Menu info
     *
     * @param  string  encrptyId
     * @return \Illuminate\Http\Response
     */
    public function getGetMenuInfo($menuId)
    {
		return Module::find(Crypt::decrypt($menuId));
    }
	
	/**
     * Get Sub Menus
     *
     * @param  string  encrptyId
     * @return \Illuminate\Http\Response
     */
    public function getGetSubMenus($menuId)
    {
		return Module::select('id', 'label')
			->where('parent_id', Crypt::decrypt($menuId))
			->orderBy('order_list')
			->get();
    }
	
	
	/**
     * Add Menu
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postStoreMenu(Request $request) 
	{
		$parentModuleId = Crypt::decrypt($request->encryptId);		
		$module = new Module;
		$module->parent_id  = $parentModuleId;
		$module->order_list = Module::where('parent_id', $parentModuleId)->max('order_list') + 1;
		$module->name  		= $request->name;
		$module->label 		= ucwords($request->label);
		$module->role  		= Module::find($parentModuleId)->role;
		$module->icon  		= $request->icon;
		if (! empty($request->route))
			$module->route  = $request->route;
		else
			$module->route = NULL;
		
		$module->save();
		
		Log::info('Add menu: ', [
			'table' => [
				'name' => 'modules',
				'data' => $module->toArray()
			],
			'session' => session()->all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('modules.successAddMenu'),
		]);
	}
	
	/**
     * Update Menu
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postUpdateMenu(Request $request) 
	{
		$module = Module::find(Crypt::decrypt($request->menuEncryptId));
		if ($module->name   != $request->name)   $module->name   = $request->name;
		if ($module->label  != $request->label)  $module->label  = ucwords($request->label);
		if ($module->active != $request->active) $module->active = $request->active;
		if ($module->icon   != $request->icon) 	 $module->icon   = $request->icon;
		
		if ($module->route != $request->route) {
			if (! empty($request->route))
				$module->route  = $request->route;
			else
				$module->route = NULL;
		}
		
		$module->save();
		
		Log::info('Modify menu info : ', [
			'table' => [
				'name' => 'modules',
				'data' => $module->toArray()
			],
			'session' => session()->all()
		]);
		
		return response()->json([
			'success' => true,
			'message' => trans('modules.successModifyModule'),
		]);
	}
}
