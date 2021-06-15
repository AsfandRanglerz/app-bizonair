<?php

namespace App\Http\Middleware;

use Closure;

class Bizoffice
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
            if(\Auth::user()->my_office)
                return $next($request);
            else{
                if(\Auth::user()->step_1 == null){
                    $data['url'] = route('my-account' , \Auth::user()->id);
                }
                elseif(\Auth::user()->step_2 == null){
                    $data['url'] = route('company-profile');
                }
                else{
                    $data['url'] = route('user-dashboard');
                }
            }
                return redirect($data['url']);
        }
        else{
            return redirect()->back();
        }

    }
}
