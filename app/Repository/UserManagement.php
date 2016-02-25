<?php

namespace App\Repository;

use App\UserGroup;

class UserManagement
{
	/**
     * Display Users Group in key/value pair 
     *
     * @return array
     */
	public function UserGroup()
	{
		/* === get all province/city === */
		$userGroupRaw = UserGroup::orderBy('name')
			->get()
			->keyBy('id');
		
		/* === format province/city to [province/city => province/city] === */
		$userGroup = collect($userGroupRaw)
			->map(function($userGroupRaw) {
				return $userGroupRaw->name;
			})
			->toArray();
			
		return $userGroup;
	}
}