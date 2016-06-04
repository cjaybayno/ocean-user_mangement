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
		$gate->before(function ($user, $ability) {
			if($user->group_access_id === 1) return true;
		});
		
		/* === show only valid module === */
        $gate->define('moduleRole', function ($user, $moduleRole) {
            return $user->role == $moduleRole;
        });
		
		/* === show only valid mennu === */
		$gate->define('menuAccess', function ($user, $menuId) {
            $count = DB::table('user_access_module')
				->where('group_id', $user->group_access_id)
				->where('module_id', $menuId)
				->where('entity_id', $user->entity_id)
				->count();
				
			return ($count > 0);
        });
		
		/* === authorize controller to access by web === */
		$gate->define('controllerAccess', function ($user, $name) {
			$params = DB::table('parameters')->where('name', $name)->first();
			if (! empty($params)) {
				$count = DB::table('user_access_module')
				->where('group_id', $user->group_access_id)
				->where('module_id', $params->id)
				->where('entity_id', $user->entity_id)
				->count();
				
				return ($count > 0);
			} else {
				dd('abort: sample not authorize page');
			}
        });
		
    }
}
