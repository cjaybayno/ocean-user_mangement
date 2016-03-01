<?php

namespace App\Repository;

use App\UserGroup;
use App\Entity;

class UserManagement
{
	/**
     * Display Users Group in key/value pair 
     * 
     * @ param int $entityId
     * @return array
     */
	public function groups($entityId  = '')
	{
		if (! empty($entityId)) {
			$userGroupRaw = UserGroup::orderBy('name')
				->where('entity_id', $entityId)
				->get()
				->keyBy('id');
		} else {
			$userGroupRaw = UserGroup::orderBy('name')
				->whereNull('entity_id')
				->get()
				->keyBy('id');
		}
		
		$userGroup = collect($userGroupRaw)
			->map(function($userGroupRaw) {
				return $userGroupRaw->name;
			})
			->toArray();
		
		if (empty($entityId)) {
			$userGroup[''] = 'Select Groups';
		}
		
		return $userGroup;
	}
	
	/**
     * Display Entity in key/value pair 
     *
     * @return array
     */
	public function entities()
	{
		$entityRaw = Entity::orderBy('code')
			->get()
			->keyBy('id');
		
		$entity = collect($entityRaw)
			->map(function($entityRaw) {
				return $entityRaw->code;
			})
			->toArray();
			
		$entity[''] = 'Select Entity';
			
		return $entity;
	}
}