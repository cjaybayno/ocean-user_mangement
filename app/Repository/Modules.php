<?php
namespace App\Repository;

use DB;
use App\Module;

class Modules
{
	/**
     * Get Menus
     * 
     * @param int $parentId
     * @return Array
     */
	public function getMenus($parentId = 0, $activeOnly = true, $role = false)
	{
		$params  = $this->getMenusQuery($parentId, $activeOnly, $role);
		
		return $this->builTree($params, $activeOnly, $role);
	}
	
	
	/**
     * Build Tree
     *
     * @param array $params
     * @return Array
     */
	protected function getMenusQuery($parentId = 0, $activeOnly = true, $role = false)
	{
		$modules = Module::where('parent_id', $parentId);
		
		if ($activeOnly)
			$modules = $modules->where('active', true);
		
		if ($role !== false)
			$module = $modules->where('role', $role);
		
		return $modules->orderBy('order_list','asc')->get();
	}
	
    /**
     * Build Tree
     *
     * @param array $params
     * @return Array
     */
	protected function builTree($params, $activeOnly = true, $role = false)
	{
		$primaryData = [];
		for ($i = 0; $i < count($params); $i++) {
			$child = $this->getMenusQuery($params[$i]['id'], $activeOnly, $role);
			$params[$i]['child'] = $this->builTree($child, $activeOnly, $role);
			$primaryData[] = $params[$i];
		}
		
		return $primaryData;
	}
	
	/**
     * Get Menus Access
     * 
     * @param int $groupId
     * @return Array
     */
	public function getMenusAccess($groupId)
	{
		$raw = DB::table('user_group_modules')
					->select('module_id')
					->where('group_id', $groupId)
					->get();
					
		$formated = collect($raw)
			->map(function($raw) {
				return $raw->module_id;
			})
			->toArray();
			
		return $formated;
	}
}