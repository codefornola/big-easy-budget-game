<?php namespace App\Http\Controllers\Admin;

use View;
use App\Http\Controllers\Controller;

abstract class AdminController extends Controller{

	protected $crumbs = [];

	public function bread($crumbs = []){
		$this->crumbs = $this->crumbs + $crumbs;
		View::share('crumbs', $this->crumbs);
		return $this->crumbs;
	}

}