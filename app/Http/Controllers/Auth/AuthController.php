<?php

namespace App\Http\Controllers\Auth;

use Log;
use Auth;
use Config;
use Session;
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
			$user = User::select([
				'id', 
				'status', 
				'expired_at'
			])
			->where('username', $request->username)
			->first();
			
			switch ($user->status) {
				
				case Config::get('users.status.active') : 
					if ($this->checkExpiry($user->expired_at) === false) {
						/* === auth success === */
						Auth::login($user);
						
						Log::info('Login : ', [
							'username' => $request->username, 
							'result'   => 'login success',
							'session'  => Session::all()
						]);
						
						return redirect()->intended($this->redirectTo);
					} else {
						$notif = $this->tagAsExpired($user->id);
					}
					break;
				
				case Config::get('users.status.disabled') :
					$notif = trans('users.disabled');
					break;
					
				case Config::get('users.status.expired') :
					$notif = trans('users.expired');
					break;
					
				case Config::get('users.status.terminated') :
					$notif = trans('users.terminated');
					break;
					
				case Config::get('users.status.temporary_password') :
					$notif = trans('users.temporary_password');
					break;
				
				default :
					$notif = trans('users.invalid_status');
			}
			
		} else {
			$notif = trans('users.invalid');
		}
		
		Log::info('Login : ',['username' => $request->username, 'result' => $notif]);
		
		return redirect('login')->with([
			'notif' => $notif,
			'username' => $request->username,
		]);
	}
	
	/**
     * Check user expiry
     * 
     * @param  date $expiryDate
     * @return boolean
     */
	private function checkExpiry($expiryDate)
	{
		$expiryDateString  = strtotime($expiryDate);
		$todayDateString   = strtotime(date('Y-m-d'));
		
		/* === check if today is greater than expiry date=== */ 
		if ($todayDateString >= $expiryDateString) {
			// user is expired
			return true;
		}
		
		return false;
	}
	
	/**
     * Tag user as expired
     * 
     * @param  int $id
     * @return string
     */
	private function tagAsExpired($id)
	{
		$user = User::find($id);
		$user->status = Config::get('users.status.expired');
		$user->save();
		
		Log::info('Tag user as Expired : ', [
			'table'	=> [
				'name' => 'users',
				'data' => [
					'status' => Config::get('users.status.expired')
				]
			],
			'session' => Session::all()
		]);
		
		return trans('users.expired');
	}
	
	/**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
	public function logout()
	{
		Log::info('Logout : ', ['session' => Session::all()]);
		
		Auth::guard('web')->logout();
		
		return redirect($this->redirectAfterLogout);
	}
}
