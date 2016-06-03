<?php
namespace App\Repository;

use App\Parameter;

class Parameters
{
	/**
     * Get Parameters 
     *
     * @param string $parentName
     * @return Array
     */
	public function getParams($parentName)
	{
		$params = Parameter::where('name', $parentName)->first();
		$params = Parameter::where('parent_id', $params->id)->orderBy('order_list','asc')->get()->toArray();
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
			$child = Parameter::where('parent_id', $params[$i]['id'])->orderBy('order_list','asc')->get()->toArray();
			$params[$i]['child'] = $this->builTree($child);
			$primaryData[] = $params[$i];
		}
		
		return $primaryData;
	}
}