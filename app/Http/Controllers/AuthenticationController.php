<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use App\Http\Controllers\JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
// use App\Http\Controllers\JWT;


class AuthenticationController extends Controller
{
    // use Tymon\JWTAuth\Facades\JWTAuth;

    public function authenticate($token)
    {
        // Step 1: Decode JWT to extract user data
        $payload = JWTAuth::decode(JWTAuth::setToken($token)->getToken());
        
        // Step 2: Check if the token is valid
        if (!$payload || !isset($payload['userId']) || !isset($payload['organization_id'])) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    
        $organizationId = $payload['organization_id']; // ✅ Extract organization_id
    
        // Step 3: Assign Redirect Based on Role
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
    
        // Step 4: Store Organization ID in Session (Optional)
        session(['organization_id' => $organizationId]); // Useful if needed globally
    
        // Step 5: Return Data to View
        $config = [
            'token' => $token,
            'name' => $payload['username'],
            'organization_id' => $organizationId,  // ✅ Pass to view
            'redirectRoute' => $redirectRoute
        ];
    
        return view('auth.success', compact('config'));
    }
    
    
    

    public function authorize($role)
    {
        
        // Store the role in the session (this is passed from the getUser function)
        Session::put('user_role', $role);

        // Redirect to a success page or another location, you can handle this logic
        // dd('Authorized as ' . $role);
        // dd(Session::all());
        return redirect()->route('role.redirect');
    }

    public function logout(Request $request)
    {
        try {
            // Invalidate the token
            auth()->logout();
    
            // Clear session data
           

            // Clear the JWT token from cookies (if stored there)
            $cookie = \Cookie::forget('jwt_token');
    
    
            return redirect()->route('customer.login')->with('success', 'Successfully logged out');
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to logout. ' . $e->getMessage()
            ], 500);
        }
    }   
    
    

    public function showSuccessPage(Request $request)
    {
        // Retrieve data set by middleware
        $config = $request->get('config');

        return view('auth.success', compact('config'));
    }

    public function redirectToDashboard(Request $request)
    {
        // Retrieve redirect route from middleware
        $redirectRoute = $request->get('config')['redirectRoute'] ?? route('customer.loginform');
    
        return redirect($redirectRoute);
    }
    
}

