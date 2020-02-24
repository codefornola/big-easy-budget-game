<?php namespace App\Http\Controllers;

use View;
use App\Models\Budget;
use App\Models\Page;

class HomeController extends Controller{

	public function __construct(){
		View::share('budgets', Budget::where('is_active', true)->whereNull('closed_at')->whereNotNull('opened_at')->orderby('is_active', 'desc')->orderby('created_at', 'desc')->get());
		View::share('pages', Page::where('slug', '!=', 'index')->where('is_active', true)->orderBy('order')->get());
	}

	public function page($slug = null)
    {
        $page = Page::where('slug', ($slug ?: 'index'))->first();

		return view('home.default', compact('page'));
	}

//	public function about(){
//		return view('home.about');
//	}
//
//	public function contact(){
//		return view('home.contact');
//	}
}