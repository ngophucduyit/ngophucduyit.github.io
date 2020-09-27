<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class check_role
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
        $roles = array_slice(func_get_args(), 2);
        if (Auth::check())
            foreach ($roles as $role) {
                if ($request->user()->role == $role) {
                    return $next($request);
                }
            }
        return redirect('/');
    }
}
