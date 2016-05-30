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
				'modules/loans/application.members',
				'modules/loans/payments.form',
				'modules/loans/payments.list',
				'modules/members.list',
				'modules/members.register',
				'modules/members.show',
				'modules/members.edit',
				'modules/conso/loan.conso',
				'modules/conso/capital.conso',
				'modules/conso/capital.contribution',
				'modules/conso/savings.conso',
				'modules/conso/savings.contribution',
				'modules/balanceSheet/form',
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
