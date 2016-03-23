<?php

namespace App\Http\Middleware;

use Closure;

class AjaxRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		/* === if request is not ajax abort === */
		if (! $request->ajax()) abort(404);
		
        return $next($request);
    }
}
