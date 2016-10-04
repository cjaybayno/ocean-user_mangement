<?php

namespace App\Providers;

use Blade;
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
				'modules/users/groups.modules',
				'modules/loans/products.list',
				'modules/loans/products.form',
				'modules/loans/application.form',
				'modules/loans/application.current',
				'modules/loans/application.show',
				'modules/loans/application.members',
				'modules/loans/payments.form',
				'modules/loans/payments.list',
				'modules/loans/members.list',
				'modules/loans/members.register',
				'modules/loans/members.show',
				'modules/loans/members.edit',
				'modules/loans/conso/loan.conso',
				'modules/loans/conso/capital.conso',
				'modules/loans/conso/capital.contribution',
				'modules/loans/conso/savings.conso',
				'modules/loans/conso/savings.contribution',
				'modules/backoffice/balanceSheet.form',
				'modules/portal/modules.list',
				'modules/portal/modules.show',
				'modules/api/partners.list',
				
				'modules/insurance.saleRegistrations',
			], 
			'App\Http\ViewComposers\AuthUserProfileComposer'
		);
		
		Blade::directive('menuRoute', function($route) {
            return "<?php echo 'href='.URL::route($route) ?>";
        });
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
