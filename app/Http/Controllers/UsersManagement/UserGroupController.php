<?php

namespace App\Http\Controllers\UsersManagement;

use Illuminate\Http\Request;

use Log;
use Session;

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
		]);
    }
}
