<?php

namespace App\Providers;

use DB;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
		
		/* === administrator === */
		$gate->before(function ($user) {
			if($user->group_access_id === 1) return true;
		});
		
		/* === show only valid module === */
        $gate->define('moduleRole', function ($user, $moduleRole) {
            return $user->role == $moduleRole;
        });
		
		/* === determine if user has authorize to visit the module using ID === */
		$gate->define('moduleAccessById', function ($user, $moduleId) {
			$count = DB::table('modules')
				->where('id', $moduleId)
				->where('active', true)
				->count();
				
			if ($count > 0) {
				$count = DB::table('user_access_module')
					->where('group_id', $user->group_access_id)
					->where('module_id', $moduleId)
					->where('entity_id', $user->entity_id)
					->count();
			}
			
			return ($count > 0);
        });
		
		/* === determine if module is acccesible using name === */
		$gate->define('moduleAccessByName', function ($user, $name) {
			return $this->checkAccessByName($user, $name);
        });
		
		/* === determine if menu is acccesible using name === */
		$gate->define('menuAccessByName', function ($user, $name) {
			return $this->checkAccessByName($user, $name);
        });

		/* === determine if sub-menu is acccesible using name === */
		$gate->define('subMenuAccessByName', function ($user, $name) {
			return $this->checkAccessByName($user, $name);
        });
    }
	
	 /**
     * check Access By Name
     *
     * @param  app\User $user
     * @param  string   $name
     * @return void
     */
	private function checkAccessByName($user, $name)
	{	
		$params = DB::table('modules')
					->where('active', true)
					->where('name', $name)
					->first();
					
		if (! empty($params)) {
			$count = DB::table('user_access_module')
			->where('group_id', $user->group_access_id)
			->where('module_id', $params->id)
			->where('entity_id', $user->entity_id)
			->count();
			
			return ($count > 0);
		}
		
		return false;
	}

}

