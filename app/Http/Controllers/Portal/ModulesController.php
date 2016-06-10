<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;

use Log;
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
				'/assets/gentellela-alela/js/parsley/parsley.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/jquery.dataTables.min.js',
				'/assets/gentellela-alela/js/datatables/dataTables.bootstrap.min.js',
				'/assets/gentellela-alela/js/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
				'/assets/modules/portal/modules-list.js' 
			],
			'stylesheets' => [
				'/assets/gentellela-alela/css/datatables/tools/css/dataTables.tableTools.css',
				'/assets/gentellela-alela/js/dataTables/extensions/Responsive/css/dataTables.responsive.css',
			],
			'route' => $this->route,
		];
		
		Log::info('View modules list : ', ['session' => session()->all()]);
		
        return view('modules/portal/modules.list')->with([
			'assets' => $assets
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
			'id',
		]);
			
		return Datatables::of($modules)
			->editColumn('role', '{{ config("users.inverted_role.$role") }}')
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
		return Module::select('name', 'label', 'role')
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
		$module = Module::select('id')
			->where('label', $request->label)
			->where('parent_id', 0);
			
		if (! empty($request->encryptId)) 
			$module->where('id', '!=', Crypt::decrypt($request->encryptId));
			
		if ($module->count() > 0) return abort(404);
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
		$module = Module::find(Crypt::decrypt($request->encryptId));
		if ($module->name  != $request->name)  $module->name  = $request->name;
		if ($module->label != $request->label) $module->label = strtoupper($request->label);
		if ($module->role  != $request->role)  $module->role  = $request->role;
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
     * Show specific modules 
     *
     * @param  string  encrptyId
     * @return \Illuminate\Http\Response
     */
    public function getShow($encrptyId)
    {
		$id  	 = Crypt::decrypt($encrptyId);
		$modules = Module::where('parent_id', $id)->first();
			
		Log::info('View modules show : ', ['session' => session()->all()]);
	
        return view('modules/portal/modules.show')->with([
			'selected_menus' => $this->modules->getMenus($id),
			'modules' 		 => $modules
		]);
    }
}
