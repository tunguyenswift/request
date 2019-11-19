<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;

class CheckLoginCookie
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
        $username = Cookie::get('usernamethm');
        
        if(is_null($username)){
            return redirect('/');
            // echo "Bạn cần đăng nhập";
            // echo "234";
            exit();
        } 
        
        return $next($request);


    }
}
