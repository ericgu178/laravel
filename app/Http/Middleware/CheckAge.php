<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge implements Middleware
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

        Session::put('name',"哈哈哈");
        return $next($request);
    }
}
