<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Jenssegers\Mongodb\Model as Eloquent;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract{
	use Authenticatable, CanResetPassword;

//	protected $connection = 'mongodb';
	protected $collection = 'users';
	protected $fillable   = ['name', 'email', 'password', 'roles', 'avatar', 'provider', 'provider_user_id', 'provider_user_token'];
	protected $hidden     = ['password', 'remember_token', 'provider_user_token'];

	public function responses(){
		return $this->hasMany('App\Models\Response');
	}

	public function budgets(){
		return $this->hasManyThrough('App\Models\Budget', 'App\Models\Response');
	}

	public function is($role){
		return in_array($role, (array)$this->roles);
	}

	public function isAdmin(){
		return in_array('admin', (array)$this->roles);
	}

}
