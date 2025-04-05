<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MasterAuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Ticket;

class AuthController extends Controller
{
    public function __construct(MasterAuthService $authService)
    {
        // dd('aaaaaa');
        $this->authService = $authService;
       // $this->middleware('admin')->except(['orgAdminLoginPage', 'orgAdminLogin']);
    }

    public function checkAuth(Request $request)
    {
        $credentials = $request->validate([
            'name_email' => 'required',
            'password' => 'required',
        ]);

        // Step 1: Call your custom auth service
        $token = $this->authService->loginServiceUser($credentials, 'user');

        if ($token) {
            Session::put('access_token', $token);
            Session::put('name_email', $credentials['name_email']);



            // Step 2: Manually fetch the user by email
            $user = \App\Models\User::where('email', $credentials['name_email'])->first();
            Session::put('organization_id', $user->organization_id);
            Session::put('engineer_id', $user->id);
            // dd($user->id);
            // dd($user->organization_id);

            if ($user) {
                // Step 3: Manually log the user in
                Auth::login($user);

                // Step 4: Check role and redirect
                if ($user->role == 1) {
                    return redirect()->route('supporttickets.view')->with('success', 'Logged in successfully.');
                } elseif ($user->role == 3) {
                    return redirect()->route('customer.tickets')->with('success', 'Logged in successfully.');
                } elseif ($user->role == 2) {
                    return redirect()->route('agenttickets.view')->with('success', 'Logged in successfully.');
                } else {
                    return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully.');
                }
            } else {
                return back()->with('error', 'User not found in database.')->withInput();
            }
        }

        return back()->with('error', 'Invalid email or password.')->withInput();
    }


    public function orgAdminLoginPage()
    {
      return view('admin.auth.login');
    }

    public function orgAdminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $token = $this->authService->loginService($credentials, 'org');

        if ($token) {
            Session::put('access_token', $token);

            // 🔍 Fetch the organization admin user (based on email or credentials)
            $admin = \App\Models\Organization::where('official_email', $credentials['email'])->first();

            if ($admin) {
                // ✅ Put the org_id in session (you can store the ID or full object)
                Session::put('organization_id', $admin->id);
                // dd($admin->id);
                // Or if you want to store full organization:
                // Session::put('organization', $admin->organization);
            }

            return redirect()->route('admin.dashboard')
                ->with(compact('token'))
                ->with('success', 'Logged in successfully');
        }

        return back()->with('error', 'Invalid email or password.')->withInput();
    }

}
