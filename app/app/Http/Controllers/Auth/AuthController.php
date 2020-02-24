<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Validator;
use Redirect;
use Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller{

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	protected $loginPath    = '/'; // after login
	protected $redirectPath = '/'; // after register
	protected $redirectAfterLogout = '/'; // after logout

	public function __construct(){
		$this->middleware('guest', ['except' => 'getLogout']);
	}

	protected function validator(array $data){
		return Validator::make($data, [
			'name'     => 'required|max:255',
			'email'    => 'required|email|max:255|unique:app.users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	public function socialiteAuthorize($provider){
		return Socialite::driver($provider)->redirect();
	}

	public function socialiteLogin($provider){
		if(!empty(Request::input('denied'))){
			return Redirect::route('home.index')->withErrors(['Login was canceled by the user.']);
		}
		$oauth = Socialite::driver($provider)->user();
		//print_r($oauth->user);
		//print_r($oauth->getName());
		$user = User::where('provider', '=', $provider)->where('provider_user_id', '=', $oauth->getId())->first();
		// if we can't find user
		if(!count($user)){

			$user = User::where('email', '=', $oauth->getEmail())->first();
			if(!count($user)){
				// must be a new one
				$user = User::create([
					'name'                => $oauth->getName(),
					'email'               => $oauth->getEmail(),
					'avatar'              => $oauth->getAvatar(),
					'provider'            => $provider,
					'provider_user_id'    => $oauth->getId(),
					'provider_user_token' => $oauth->token,
					'roles'               => ['user']
				]);
			}else{
				return Redirect::route('home.index')->withErrors(["You've already linked your ".ucfirst($user->provider)." account. Please login with ".ucfirst($user->provider)." instead."]);
			}
		}
		Auth::login($user);
		return Redirect::intended();
	}

	public function getLogin(){
		return Redirect::route('home.index', ['showLogin'=>'true']);
	}

	public function postRegister(){

		$validator = $this->validator(Request::all());
		if($validator->fails()){
			return Redirect::back()
					->withErrors($validator)
					->withInput();
		}

		$data = Request::only('name', 'email', 'password');
		$data['roles'] = ['user'];
		$user = $this->create($data);

		Auth::login($user);
		return Redirect::intended();

	}

	protected function create(array $data){
		return User::create([
			'name'                => $data['name'],
			'email'               => $data['email'],
			'password'            => bcrypt($data['password']),
			'avatar'              => '',
			'provider'            => '',
			'provider_user_id'    => '',
			'provider_user_token' => '',
		]);
	}

}
