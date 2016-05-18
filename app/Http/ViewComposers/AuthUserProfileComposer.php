<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Entity;
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
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
       
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
		
		if (session('entity_id')) {
			$entity = Entity::find(session('entity_id'));
			$view->with('entity_name', $entity->entity_name);
		}
    }
}