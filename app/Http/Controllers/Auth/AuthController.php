<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Config;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
     * use username instead of email.
     *
     * @var string
     */
	protected $username = 'username';
	
	/**
     * Where to redirect users after logout.
     *
     * @var string
     */
	protected $redirectAfterLogout = '/login';
	
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
	
	/**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function auth(Request $request)
	{
		$credentials = [
			'username' => $request->username,
			'password' => $request->password,
		];
		
		if (Auth::validate($credentials)) {
			
			$user = User::select('status')->where('username', $request->username)->first();
			
			switch ($user->status) {
				
				case Config::get('users.status.active') : 
					return 'User is active and able to login';
					break;
				
				case Config::get('users.status.disabled') :
					return 'user is disabled';
					break;
					
				case Config::get('users.status.expired') :
					return 'user is expired';
					break;
					
				case Config::get('users.status.terminated') :
					return 'user is Terminated';
					break;
					
				case Config::get('users.status.temporary_password') :
					return 'user is on temporary password';
					break;
				
				default :
					echo 'Invalid Username status';
			}
			
			echo 'test';
			
		} else {
			echo 'Invalid Username';
		}
	}
	
	/**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
	public function logout()
	{
		Auth::guard('web')->logout();
		
		return redirect($this->redirectAfterLogout);
	}
	
	public function isActive()
	{
		return false;
	}
}
