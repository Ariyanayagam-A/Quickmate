<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    //     $authHeader = Session::get('access_token');
    //     // dd($authHeader);
    //     if (!$authHeader) {
    //         return response()->json(['error' => 'Unauthorized, token missing'], 401);
    //     }
        
    //     // Extract the token
    //     $token = trim(substr($authHeader, 7));
        
    //     // Get your Keycloak realm public key (set in .env and config)
    //     $publicKey = trim(env('https://auth.kloudstacks.com/realms/master'));

    //     $jwks = Http::withOptions(['verify' => false])->get("https://auth.kloudstacks.com/realms/master/protocol/openid-connect/certs")->json();

    //     if (!isset($jwks['keys'][0])) {
    //         return response()->json(['error' => 'Unable to fetch Keycloak keys'], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    //  //   dd($jwks['keys'][0]);
    //     $publicKey = $this->convertJwkToPem($jwks['keys'][0]);

    //     if (!$publicKey) {
    //         return response()->json(['error' => 'Public key not configured'], 500);
    //     }
    //     // dd($publicKey);
    //     try {
    //         // Decode and verify the token signature (using RS256)
    //         $decoded = JWT::decode($token, new Key($publicKey, 'RS256'));
    //         dd($decoded);
    //         // Check if the token has expired (the 'exp' claim is in Unix timestamp)
    //         if ($decoded->exp < time()) {
    //             Session::forget('access_token');
    //             return response()->json(['error' => 'Token expired'], 401);
    //         }   
            
    //         // Optionally, attach the decoded token data to the request for later use:
    //         $request->attributes->set('keycloak_token', $decoded);
            
    //     } catch (Exception $e) {
    //         return response()->json(['error' => 'Token validation failed: ' . $e->getMessage()], 401);
    //     }
        
        return $next($request);
    }

    private function convertJwkToPem($jwk)
    {
        $modulus = $this->base64UrlDecode($jwk['n']);
        $exponent = $this->base64UrlDecode($jwk['e']);
        $publicKey = "-----BEGIN PUBLIC KEY-----\n" . chunk_split(base64_encode("\x30\x82" . $modulus . "\x02\x03" . $exponent), 64, "\n") . "-----END PUBLIC KEY-----\n";
        return $publicKey;
    }

    private function base64UrlDecode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $input .= str_repeat('=', 4 - $remainder);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }

}
