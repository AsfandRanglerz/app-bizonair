<?php

namespace App\Http\Middleware;

use Closure;

class Member
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
        if(\Auth::check()){
            if((\Auth::user()->is_admin == 1 || \Auth::user()->is_member == 1) && \Auth::user()->is_owner == 0)
            return $next($request);
            else
            abort(404, 'Unauthorized Action');
        }
        else{
            return redirect()->route('home');
        }
    }
}
