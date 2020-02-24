<?php

namespace App\Http\Middleware\Filters;

use Carbon\Carbon;
use Closure;

class FilterResultInput{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next){

		$input = $request->input();
		foreach($input['org'] as $id => &$org){
			$org['units'] = (int)filter_var($org['units'], FILTER_SANITIZE_NUMBER_INT);
		}
		$input['start_time'] = Carbon::createFromTimestamp($input['start_time']);
		$request->merge($input);

		return $next($request);
	}
}
