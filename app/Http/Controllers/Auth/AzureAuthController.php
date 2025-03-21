<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use TheNetworg\OAuth2\Client\Provider\Azure;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class AzureAuthController extends Controller
{
    protected $provider;

    public function __construct(Azure $provider)
    {
        $this->provider = $provider;
    }

    public function redirectToAzure()
    {
        $this->provider->defaultEndPointVersion = Azure::ENDPOINT_VERSION_2_0;
        $baseGraphUri = $this->provider->getRootMicrosoftGraphUri(null);
        $this->provider->scope = 'openid profile email offline_access ' . $baseGraphUri . '/User.Read';

        $authorizationUrl = $this->provider->getAuthorizationUrl(['scope' => $this->provider->scope]);
        
        Session::put('OAuth2.state', $this->provider->getState());

        return redirect($authorizationUrl);
    }

    public function handleAzureCallback(Request $request)
    {
        // dd('callback Received!!');
        if (!$request->has('code') || $request->input('state') !== Session::get('OAuth2.state')) {
            return redirect('/')->with('error', 'Invalid authentication state.');
        }

        Session::forget('OAuth2.state');

        $token = $this->provider->getAccessToken('authorization_code', [
            'scope' => $this->provider->scope,
            'code'  => $request->input('code'),
        ]);

       //$azureUser = $this->provider->get($this->provider->getRootMicrosoftGraphUri($token) . '/v1.0/me', $token);

        // dd($azureUser);
        $user = [
            'id' => uniqid(), // Generate unique ID
            'username' => $azureUser['displayName'],
            'email' => $azureUser['userPrincipalName'],
        ];

        // Store user in session
        Session::put('user', $user);

        // echo 'User authenticated successfully';die;

        // dd(Session::get('user'));
        // Process user authentication here, e.g., create or find user in DB
        // return response()->json([
        //     'token' => $token->getToken(),
        //     'user' => $user
        // ]);
        return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully.');
    }
}
?>