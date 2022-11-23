<?php

namespace App\Http\Middleware;
use Session;
use Redirect;
use Closure;
use Illuminate\Http\Request;

class dashboardRedirection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('adminsession')){
            return Redirect::to('/bcb-backend');
        }else{
            return $next($request);
        }
    }
}
