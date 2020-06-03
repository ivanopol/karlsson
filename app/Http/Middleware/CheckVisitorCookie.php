<?php


namespace App\Http\Middleware;


use App\Services\BitrixService;
use Closure;

class CheckVisitorCookie
{
    public function handle($request, Closure $next){
        $bitrixService = new BitrixService();

        $bitrixService->checkVisitorCookie();

        return $next($request);
    }
}
