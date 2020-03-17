<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Language
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
        $user = \Auth::user();
        if(!empty($user)){
            if($request->session()->has('language')){
                App::setLocale($request->session()->get('language'));
            }else{
                App::setLocale(\Config::get('app.locale'));
            }
        }
        return $next($request);

    }
}
