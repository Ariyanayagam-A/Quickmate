<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if superadmin is logged in
        if (!Session::has('superadmin_logged_in') || Session::get('superadmin_logged_in') !== true) {
            return redirect()->route('quickmate.loginform')->with('error', 'Access denied. Please login as Super Admin.');
        }

        return $next($request);
    }
}
