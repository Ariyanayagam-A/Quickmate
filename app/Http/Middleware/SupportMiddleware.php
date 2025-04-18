<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('customer.loginform');
        }
    
        if (auth()->user()->role != 1) { // 1 = support team
            abort(403, 'Unauthorized');
        }
    
        return $next($request);
    }
    
}
