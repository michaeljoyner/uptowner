<?php

namespace App\Http\Middleware;

use Closure;

class SuperAuth
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
        if(! $request->user() || ! $request->user()->isSuperadmin()) {
            return abort(403, 'You do not have permission to perform that action');
        }
        return $next($request);
    }
}
