<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Entity;
use App\Repository\Parameters;
use Illuminate\Contracts\View\View;

class AuthUserProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;
	
	/**
     * The parameters repository implementation.
     *
     * @var parameters
     */
    protected $parameters;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Parameters $parameters)
    {
       $this->parameters = $parameters;
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
			$view->with('entity_name', Entity::find(session('entity_id'))->entity_name);
		
		$view->with('menus', $this->parameters->getParams('menus'));
    }
}