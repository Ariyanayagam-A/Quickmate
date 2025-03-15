<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function authenticate($token)
    {
        // Step 1: Decode JWT to extract user data
        $payload = json_decode(
            base64_decode(
                str_replace('_', '/', str_replace('-', '+', explode('.', $token)[1]))
            ), true
        );

        // Step 2: Check if the token is valid
        if (!$payload || !isset($payload['userId'])) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        if ($payload['role'] === 'admin') {
            $redirectRoute = route('admin.dashboard');
        } elseif ($payload['role'] === 'user') {
            $redirectRoute = route('ticketform');
        } elseif ($payload['role'] === 'support') {
            $redirectRoute = route('supporttickets.view');
        } elseif ($payload['role'] === 'agent') {
            $redirectRoute = route('agenttickets.view');
        } else {
            $redirectRoute = route('customer.loginform');
        }
        
        $config = [
            'token' => $token,
            'name' => $payload['username'],
            'redirectRoute' => $redirectRoute
        ];

        return view('auth.success',compact('config'));
    }

    public function authorizeUser()
    {
        // Ensure user is logged in
        if (!Session::has('user_role')) {
            return redirect('/login')->with('error', 'Session expired. Please login again.');
        }

        // Step 5: Redirect to middleware-protected route
        return redirect()->route('role.redirect');
    }
}
