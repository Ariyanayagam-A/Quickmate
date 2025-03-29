<?php 
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Firebase\JWT\JWT;
// use Firebase\JWT\JWT;
use Illuminate\Http\Request;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Models\User;


Route::get('/quickmate/kloudstack/authenticate', [AuthenticationController::class, 'showSuccessPage'])
    ->middleware('role.auth')
    ->name('auth.success');


    //get user data form token from karthik anna
Route::post('/store-user', [UserController::class, 'storeUser']);

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

Route::get('/user/generate-token', function (Request $request) {
    $secretKey = env('JWT_SECRET'); // Ensure this is set in your .env file

    $issuedAt  = Carbon::now()->timestamp;
    $expireAt  = Carbon::now()->addDays(1)->timestamp;

    // Get user details from headers (Default values if missing)
    $username = $request->header('Username', 'Bottle man');
    $email = $request->header('Email', 'boomer12@example.com');
    $password = $request->header('Password', 'password123'); // Not storing, just included for payload
    $realmId = $request->header('Realm-Id', 29); // Default realm_id
    $organizationId = $request->header('Organization-Id', 71); // Default organization_id
    $role = $request->header('Role', 1); // Default role

    // JWT Payload (No Database Interaction)
    $payload = [
        'iss' => url('/user/generate-token'),  // Issuer
        'iat' => $issuedAt,  // Issued at
        'exp' => $expireAt,  // Expiration time
        'username' => $username,
        'email' => $email,
        'password' => $password, // Just for reference, avoid sending sensitive data in JWT
        'realm_id' => $realmId,
        'organization_id' => $organizationId,
        'role' => $role
    ];

    // Generate JWT token
    $token = JWT::encode($payload, $secretKey, 'HS256');

    return Response::json([
        'message' => 'Token generated successfully!',
        'token' => $token
    ]);
});

?>