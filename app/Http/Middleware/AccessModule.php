<?php

namespace App\Http\Middleware;

use Gate;
use Closure;

class AccessModule
{
    /**
     * Handle Access Module.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string   $moduleName
     * @return mixed
     */
    public function handle($request, Closure $next, $moduleName)
    {
		if (Gate::denies('moduleAccessByName', $moduleName)) {
			abort(404);
		}
		
        return $next($request);
    }
}
