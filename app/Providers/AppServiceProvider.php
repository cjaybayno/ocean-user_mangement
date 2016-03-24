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
				'modules/users.list',
				'modules/users.form',
				'modules/users/groups.list',
				'modules/loans/products.list',
				'modules/loans/products.form',
				'modules/loans/application.form',
				'modules/loans/application.current',
				'modules/loans/application.show',
				'modules/loans/payments.form',
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
