<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Delegate
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
        
        if(Auth::user()->user_type == 'client'){ 
            return redirect()->route('frontend.profile');
        }elseif(Auth::user()->user_type == 'delegate'){ 
            return $next($request);
        }elseif(Auth::user()->user_type == 'staff'){
            return redirect()->route('admin.home');
        }else{
            return abort(403);
        }
    }
}
