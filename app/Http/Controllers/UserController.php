<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;



class UserController extends Controller
{
    public function verifylogin(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            // dd(Auth::user()->role);
            if(Auth::user()->role == 1)
            {
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
    public function login()
    {
        return view('customer.loginform');
    }

    public function register()
    {
        return view('customer.signupform');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('customer.tickets');
    }

    public function dashboard()
    {
        return view('customer.dashboard');
    }  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            die('error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role'  => '2',
            'password' => Hash::make($request->password),
        ]);

        dd($user);
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'organization_id' => 'required|exists:organizations,id',
        ]);

        // Find the organization and get the realm_id
        $organization = Organization::findOrFail($request->organization_id);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'realm_id' => $organization->realm_id, // Assign realm_id from organization
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout(Request $request)
    {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('user/login')->with('success', 'Logged out successfully.');
  }

  public function import(Request $request)
  {
    
      // Validate the uploaded file
      $request->validate([
          'file' => 'required|mimes:xlsx,xls'
      ]);
  
      // Import the Excel file
      $import = new ExcelImport();
      Excel::import($import, $request->file('file'));
  
      // Get the imported data as an array
      $data = $import->data;
      $index = 0;
      // Loop through the data and insert into the users table
      foreach ($data as $index => $row) {
        $data[$index] = [
            'name' => $row['name'] ?? 'Unknown', 
            'email' => $row['email'],
            'password' => $row['password'], // Use already hashed password
            'role' => 1,
            'email_verified_at' => null,
            'realm_id' => $row['realm_id'] ?? 1,
            'organization_id' => $row['organization_id'] ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
      }
    // dd($data);
      User::insert($data);
      return redirect()->route('import-user')->with('success', 'Users imported successfully!');

  }


  public function storeUser(Request $request)
  {
      // 1️⃣ Validate request
      $request->validate([
          'token' => 'required|string',
      ]);
  
      try {
          // 2️⃣ Get Secret Key from .env
          $secretKey = env('JWT_SECRET');
  
          // 3️⃣ Decode JWT Token using Firebase JWT
          $payload = JWT::decode($request->token, new Key($secretKey, 'HS256'));
  
          // 4️⃣ Extract User Data
          $username = $payload->username ?? null;
          $email = $payload->email ?? null;
          $password = $payload->password ?? null;
  
          if (!$username || !$email || !$password) {
              return response()->json(['error' => 'Invalid token payload'], 400);
          }
  
          // 5️⃣ Store User Data in Database with Default Values
          $user = User::create([
              'name' => $username,
              'email' => $email,
              'password' => Hash::make($password), // Secure password
              'realm_id' => $payload->realm_id ?? 1, // Default to 1 if not provided
              'organization_id' => $payload->organization_id ?? 1, // Default to 1 if not provided
              'role' => $payload->role ?? 1, // Default role
              'email_verified_at' => now(), // Auto-verify email
          ]);
  
          // 6️⃣ Return Response
          return response()->json([
              'success' => 'User created successfully!',
              'user' => $user
          ], 201);
  
      } catch (\Exception $e) {
          return response()->json(['error' => 'Invalid token: ' . $e->getMessage()], 400);
      }
  }

  public function newuserstore(Request $request)
  {
      $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:6',
          'role' => 'required|string'
      ]);

      // Assign role value
      $roleValues = [
          'user' => 1,
          'support team' => 2,
          'engineer' => 3,
      ];

      $roleValue = $roleValues[$request->role] ?? null;

      if ($roleValue === null) {
          return back()->withErrors(['role' => 'Invalid role selected']);
      }
        // dd($roleValue);
      // Create user
      User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'role' => $roleValue,
          'realm_id' => null,  // Change this if needed
          'organization_id' => null, // Change this if needed
          'email_verified_at' => now(),
      ]);

      return redirect()->back()->with('success', 'User registered successfully!');
  }
  
  
}
