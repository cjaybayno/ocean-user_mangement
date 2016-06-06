<?php
namespace App\Repository;

use App\Module;

class Modules
{
	/**
     * Get Parameters 
     * 
     * @param int $parentId
     * @return Array
     */
	public function getMenus($parentId = 0)
	{
		$params = Module::where('parent_id', $parentId)->orderBy('order_list','asc')->get()->toArray();
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
			$child = Module::where('parent_id', $params[$i]['id'])->orderBy('order_list','asc')->get()->toArray();
			$params[$i]['child'] = $this->builTree($child);
			$primaryData[] = $params[$i];
		}
		
		return $primaryData;
	}
}