<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MasterAuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        // dd($request->all());
        $credentials = $request->validate([
            'name_email' => 'required',
            'password' => 'required',
        ]);

        $token = $this->authService->loginServiceUser($credentials,'user');
            
        if ($token) 
        {
            Session::put('access_token',$token);

        if(true)
        {
            // dd('redirect');
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully.');
        }
        if(Auth::user()->role == 2){
            return redirect()->route('supporttickets.view')->with('success', 'Logged in successfully.');
        }
        else if(Auth::user()->role == 3){
            return redirect()->route('customer.tickets')->with('success', 'Logged in successfully.');
        }
        else{
            return redirect()->route('agenttickets.view')->with('success', 'Logged in successfully.');
        }
        }

        // dd('invalid!!');
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

        $token = $this->authService->loginService($credentials,'org');

        Session::put('access_token',$token);

        if($token)
        {
            return redirect()->route('admin.dashboard')
            ->with(compact('token'))
            ->with('success' , 'Logged in successfully');
        }

        return back()->with('error', 'Invalid email or password.')->withInput(); 

  }
}
