<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleRedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $role = Session::get('user_role', 'guest');

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'user':
                return redirect()->route('ticketform');
            case 'support':
                return redirect()->route('supporttickets.view');
            case 'agent':
                return redirect()->route('agenttickets.view');
            default:
                return redirect()->route('customer.loginform');
        }
    }
}
