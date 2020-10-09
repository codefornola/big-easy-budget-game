<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;

class VerifyAccount{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        // Explode domain
        $parts = explode('.', $request->getHost());

        // If there is no subdomain
        if(2 == count($parts))
        {
            // It's the marketing site, so skip account existence check
            return $next($request);
        }

        // A subdomain was provided
        // $account = new Account($parts[0]);
        $account = new Account('neworleans');

        // Throw not found if no account found
        if(!$account->exists()) abort(404);

        // If account exists, let's bind it to the service container
        app()->singleton('Account', function() use($account) {
            return $account;
        });

        // Then continue
        return $next($request);
    }

}