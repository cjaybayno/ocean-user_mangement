<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View composer for authenticated user profile info ...
        view()->composer([
				'home',
				'users.list',
				'users.create',
				'users.form',
				'users/groups.list',
			], 
			'App\Http\ViewComposers\AuthUserProfileComposer'
		);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
