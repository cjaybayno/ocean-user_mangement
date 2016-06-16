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
	public function getMenus($parentId = 0)
	{
		$params = Module::where('parent_id', $parentId)
			->where('active', true)
			->orderBy('order_list','asc')
			->get()
			->toArray();
		return $this->builTree($params);
	}
	
    /**
     * Build Tree
     *
     * @param array $params
     * @return Array
     */
	private function builTree($params)
	{
		$primaryData = [];
		for ($i = 0; $i < count($params); $i++) {
			$child = Module::where('parent_id', $params[$i]['id'])
				->where('active', true)
				->orderBy('order_list','asc')
				->get()
				->toArray();
			$params[$i]['child'] = $this->builTree($child);
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