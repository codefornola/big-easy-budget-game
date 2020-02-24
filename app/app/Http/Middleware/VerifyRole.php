<?php

namespace App\Http\Middleware;

use Closure;

class VerifyRole{
	/**
	 * Run the request filter.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @param  string $role
	 * @return mixed
	 */
	public function handle($request, Closure $next, $role){
		if(!$request->user()->is($role)){
			return redirect()->route('home.index')->withErrors("Please login with the $role role to continue.");
		}

		return $next($request);
	}

}