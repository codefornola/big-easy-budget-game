<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\Budget;

class DashboardController extends AdminController{

	public function index(){
		$budgets = Budget::all();
		return view('admin.dashboard.index', compact('budgets'));
	}

}