<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LdapController;

class AuthController extends Controller
{
    protected $ldapController;

    public function __construct(LdapController $ldapController)
    {
        $this->ldapController = $ldapController;
    }

    

    public function checkAuth(Request $request)
    {

        $credentials = $request->validate([
            'name_email' => 'required',
            'password' => 'required',
        ]);

        $isAuthenticated = $this->ldapController->checkLDAPAuthentication($request->name_email);

        // dd($isAuthenticated);
        // if (Auth::attempt($credentials)) {
            
        if ($isAuthenticated) 
        {
        // $request->session()->regenerate();
        // dd(Auth::user()->role);
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

}
