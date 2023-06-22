<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$userTypes)
    {
        if ($request->user() && in_array($request->user()->usertype, $userTypes)) {
            return $next($request);
        }

        //abort(403, 'Unauthorized');
        return redirect()->route('dashboard');
    }
}
