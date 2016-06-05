<?php

namespace App\Http\Middleware;

use Agent;
use App\LogAccess;
use Auth;
use Closure;

class LogAccessMiddleware
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
        LogAccess::create([
            'request_uri' => request()->server('REQUEST_URI'),
            'http_headers' => Agent::getHttpHeaders(),
            'user_id' => Auth::guard('api')->id(),
        ]);

        return $next($request);
    }
}
