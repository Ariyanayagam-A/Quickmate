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
use App\Models\Organization;
use Illuminate\Support\Facades\Session;
use App\Services\MasterAuthService;
use DataTables;
use App\Models\Role;
use Exception;
class UserController extends Controller
{
    public function __construct(MasterAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function ajaxList(Request $request)
    {
        if ($request->ajax()) {
            // with(['organization', 'roles'])->
            $orgId = Session::get('organization')->id;
            // dd($orgId);
            $users = User::where('organization_id',$orgId)->get();
            // dd($users);
            return DataTables::of($users)
                ->addColumn('roles', function ($user) {
                    $role = $user->role ? Role::find($user->role) : 'Not Assigned';
                    return isset($role->name) ? $role->name : $role;
                })
                ->addColumn('action', function ($user) {
                    return '
                        <button class="btn btn-primary btn-sm editUser" data-id="' . $user->id . '">Edit</button>
                        <button class="btn btn-danger btn-sm deleteUser" data-id="' . $user->id . '">Delete</button>
                        <a class="btn btn-warning btn-sm assignRole" data-id="' . $user->id . '"  data-bs-toggle="modal" onclick="openRoleAssignModal('.$user->id .')" data-bs-target="#assignRoleModal"><i class="fas fa-user-shield"></i> Assign Role</a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.manageuser');
    }

    public function verifylogin(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // dd($credentials);

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

    return redirect('login')->with('success', 'Logged out successfully.');
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
    // dd($request->all());
    $validator = Validator::make($request->all(),[
          'username' => 'required|string|max:255',
          'fname' => 'required|string|max:255',
          'lname' => 'required|string|max:255',
        //   'email' => 'required|email|unique:users',
          'email' => 'required|email',
          'password' => 'required|min:6'
      ]);

      if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // dd();

      // Assign role value
    //   $roleValues = [
    //       'user' => 1,
    //       'support team' => 2,
    //       'engineer' => 3,
    //   ];

    //   $roleValue = $roleValues[$request->role] ?? null;

    //   if ($roleValue === null) {
    //       return back()->withErrors(['role' => 'Invalid role selected']);
    //   }
        // dd($roleValue);
      // Create user
      $org_name = Session::get('organization')->organization_name;
      $user = User::create([
          'name' => $request->username,
          'fname' => $request->fname,
          'lname' => $request->lname,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'role' => null,
          'realm_id' => null,
          'email_verified_at' => now(),
      ]);

      if($user)
      {
           $user['org_password'] = $request->password;
           $user['organization_id'] = Session::get('organization')->id;

          $userCreated =  $this->authService->createUser($user);

          if($userCreated)
          {
            unset($user['org_password']);
            $user->update(['organization_id' => $user['organization_id'],'realm' => $org_name ]);
            return redirect()->back()->with('success', 'User registered successfully!');
          }
          else
          {
            return redirect()->back()->with('error', 'User not Created!!');
          }
      }
      else
      {
        return redirect()->back()->with('error', 'Error while creating user');
      }

  }
  public function deleteUser($id)
  {
      $user = User::find($id);
      if ($user) {
          $user->delete();
          return response()->json(['message' => 'User deleted successfully!']);
      }
      return response()->json(['message' => 'User not found!'], 404);
  }

  public function assignRole(Request $request)
  {
      try {
        // dd($request->role_name);
          // Validate the incoming request
          $request->validate([
              'user_id' => 'required|exists:users,id',
              'role_id' => 'required|exists:roles,id',
              'role_name' => 'required|string',
          ]);

          // Find the user
          $user = User::find($request->user_id);
          if (!$user) {
              return response()->json(['message' => 'User not found!'], 404);
          }

          // Map role name to a specific value
          $roleMap = [
              'supportdesk' => 1,
              'engineerdesk' => 2,
              'users' => 3,
              // Add more mappings as needed
          ];

          $roleValue = $roleMap[strtolower($request->role_name)] ?? null;
          if ($roleValue === null) {
              return response()->json(['message' => 'Invalid role name!'], 400);
          }

          // Update the user's role_id (or another column) with the mapped value
          $user->update(['role' => $roleValue]);

          return response()->json(['status' => true, 'message' => 'Role assigned successfully!']);
      } catch (Exception $error) {
          return response()->json(['message' => $error->getMessage()], 500);
      }
}
}
