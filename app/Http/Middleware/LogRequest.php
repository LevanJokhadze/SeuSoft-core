<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequest
{
    public function handle($request, Closure $next)
    {
        Log::info('Request Headers', $request->headers->all());
        Log::info('Request Body', $request->all());
        return $next($request);
    }
}