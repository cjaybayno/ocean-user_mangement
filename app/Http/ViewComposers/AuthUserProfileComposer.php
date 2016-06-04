<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Entity;
use App\Repository\Modules;
use Illuminate\Contracts\View\View;

class AuthUserProfileComposer
{
	/**
     * The parameters repository implementation.
     *
     * @var parameters
     */
    protected $modules;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Modules $modules)
    {
       $this->modules = $modules;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		$user = Auth::user();
        $view->with('name',   $user->name);
        $view->with('email',  $user->email);
        $view->with('avatar', $user->avatar);
		
		if (session('entity_id'))
			$view->with('entity_name', Entity::find($user->entity_id)->entity_name);
		
		$view->with('menus', $this->modules->getMenus());
    }
}