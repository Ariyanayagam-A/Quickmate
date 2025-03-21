<?php 
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Firebase\JWT\JWT;
// use Firebase\JWT\JWT;
use Illuminate\Http\Request;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Response;



Route::middleware('auth:sanctum')->group(function(){
    Route::get('/test', function () {
        return 'SSO Test';
    });
});

// use Firebase\JWT\JWT;
// use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\Route;

Route::get('/generate-token', function (Request $request) {
    $secretKey = env('JWT_SECRET'); // Ensure this is set in your .env file

    $issuedAt  = Carbon::now()->timestamp; 
    $expireAt  = Carbon::now()->addDays(1)->timestamp; 

    // Get user details from headers (optional, if needed)
    $userId = $request->header('User-Id', 4);  // Default to 4 if not provided
    $organizationId = $request->header('Organization-Id', 1);
    $username = $request->header('Username', 'user4');  
    $role = $request->header('Role', 'user');

    // JWT Payload
    $payload = [
        'iss'            => url('/api/generate-token'),  
        'sub'            => $userId,  
        'iat'            => $issuedAt,  
        'exp'            => $expireAt,  
        'userId'         => $userId,  
        'organization_id' => $organizationId,  
        'username'       => $username,  
        'role'           => $role
    ];

    // Generate JWT token
    $token = JWT::encode($payload, $secretKey, 'HS256');

    return Response::json(['token' => $token]);
});


?>