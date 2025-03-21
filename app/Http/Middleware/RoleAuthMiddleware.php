<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;

class RoleAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Step 1: Retrieve Token from Header
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }
    
        try {
            // Step 2: Decode Token
            $payload = JWTAuth::decode(JWTAuth::setToken($token)->getToken());
    
            if (!$payload || !isset($payload['role'])) {
                return response()->json(['error' => 'Invalid token'], 401);
            }
    
            // Step 3: Assign Redirect Based on Role
            $redirectRoute = match ($payload['role']) {
                'admin' => route('admin.dashboard'),
                'user' => route('ticketform'),
                'support' => route('supporttickets.view'),
                'agent' => route('agenttickets.view'),
                default => route('customer.loginform'),
            };
    
            // Step 4: Store Config for Success Page
            $request->attributes->set('config', [
                'token' => $token,
                'name' => $payload['username'],
                'redirectRoute' => $redirectRoute,
            ]);
    
            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid token or unauthorized'], 401);
        }
    }
}
