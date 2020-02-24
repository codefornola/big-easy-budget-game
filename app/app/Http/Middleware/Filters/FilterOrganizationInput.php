<?php

namespace App\Http\Middleware\Filters;

use Closure;

class FilterOrganizationInput{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next){

		$input = $request->input();

		// Fix category_id
		if(empty($input['category_id'])) $input['category_id'] = NULL;

		// Fix ints
		$ints = ['units_min', 'units_previous_period'];
		foreach($ints as $int){
			if($input[$int] != "") $input[$int] = (int)filter_var($input[$int], FILTER_SANITIZE_NUMBER_INT);
		}

		$request->merge($input);

		return $next($request);
	}
}
