<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Config;
use Redirect;

class slashesMiddewre
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $flag)
    {
        if ($flag=="remove") {
            if (Str::endsWith($request->getPathInfo(), '/')) {
                $newval = rtrim($request->getPathInfo(), "/");
                header("HTTP/1.1 301 Moved Permanently");
                header("Location:$newval");
                exit();
            }
        } else {
            if (!Str::endsWith($request->getPathInfo(), '/')) {
                $newval =$request->getPathInfo().'/';
                header("HTTP/1.1 301 Moved Permanently");
                header("Location:$newval");
                exit();
            }
        }
        return $next($request);
    }
}
