<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApiKeyMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        // $headers = $request->header();
        // $data = $request->all();
        // dd(request()->getHttpHost(), request()->getHost(), request()->header('User-Agent'));


        // Log::debug($headers['x-api-key'][0]);
        // if( Cache::has($data['name'])){
        //    $pvCache =  Cache::get($data['name']);
        //    if($pvCache == $headers['x-api-key'][0]){
        //         return response()->json(['key' => 'invalid']);
        //    } else {
        //     Cache::put($data['name'], $headers['x-api-key'][0], now()->addMinutes(1));
        //     return $next($request);
        //    }
        // } else {
        //     Cache::add($data['name'], $headers['x-api-key'][0], now()->addMinutes(1));
        //     return $next($request);
        // }
        // if (strpos(request()->header('User-Agent'), 'Mozilla') !== false) {
        //     return $next($request);
        // } else {
        //     return response()->json(['key' => 'not allow to request']);
        // }
        return $next($request);

    }
}
