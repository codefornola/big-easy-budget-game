<?php

namespace App\Http\Middleware\Filters;

use Closure;

class FilterBudgetInput{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next){

		$input = $request->input();

		// Fix ints
		$ints = ['units_value', 'units_total'];
		foreach($ints as $int) $input[$int] = (int)filter_var($input[$int], FILTER_SANITIZE_NUMBER_INT);

		// Make checkboxes boolean
		$input['is_active']         = isset($input['is_active']) ? 1 : 0;
		$input['require_spend_all'] = isset($input['require_spend_all']) ? 1 : 0;

		return $next($request);
	}
}
