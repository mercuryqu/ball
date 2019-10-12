<?php

namespace App\Http\Middleware;

use Closure;

class WapRedirectIfAuthenticated
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
        $member = session()->get('member');
        if ($member) {
            return redirect(route('wap.members.show'));
        }

        return $next($request);
    }
}
