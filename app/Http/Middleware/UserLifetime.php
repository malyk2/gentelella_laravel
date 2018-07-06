<?php

namespace App\Http\Middleware;

use Closure;

class UserLifetime
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
        if ($user = auth()->user()) {
            config(['session.lifetime' => $user->group->lifetime]);
        }
        return $next($request);
    }
}
