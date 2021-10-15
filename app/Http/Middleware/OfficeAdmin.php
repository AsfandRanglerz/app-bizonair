<?php

namespace App\Http\Middleware;

use App\UserCompany;
use Closure;

class OfficeAdmin
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
//            if(UserCompany::where('user_id',auth()->id())->where('company_id',session()->get('company_id'))->where('is_admin',1)->first()){
//                return $next($request);
//            }
//            else{
//                abort(403,'Permission Denied');
//            }
            return $next($request);
        }
        else{
            return redirect()->route('home');
        }
    }
}
