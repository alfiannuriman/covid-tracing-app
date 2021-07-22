<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role_name)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole($role_name)) {
                return $next($request);
            } else {
                return redirect()->route('401');
            }
        }
    }
}
