<?php

namespace App\Http\Middleware;

use Closure;
use App\City;

class CheckCity
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
        if (!$request->cookie('city')) {
            $city = new City;
           // print_r($request->decodedPath());
        }

        return $next($request);
    }
}
