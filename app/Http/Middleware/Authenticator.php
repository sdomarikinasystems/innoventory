<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;
use Session;

class Authenticator
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
        if(session('user_eid') == ""){
            return new Response(view('login'));
        }else{
            return $next($request);
        }
       
    }
}
