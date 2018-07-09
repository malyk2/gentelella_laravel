<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\PermissionException;

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
            if($user->logout) {
                auth()->logout();
                return redirect()->route('login')->pnotify('Доступ заборонено', '','error');
            }
            config(['session.lifetime' => $user->group->lifetime]);
        }
        return $next($request);
    }
}
