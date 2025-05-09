<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Organization;
// use Tymon\JWTAuth\Facades\JWTAuth;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Services\MasterAuthService;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Jobs\SyncLdapUsers;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;


class OrganizationController extends Controller
{
    private $masterAuthService;
    public function __construct(MasterAuthService $authService)
    {
        $this->masterAuthService = $authService;
    }
    public function addorg()
    {
        return view('organization.addorg');
    }

    public function showResetForm()
    {
        $orgId = Session::get('reset_org_id');
        return view('admin.password_reset', compact('orgId'));
    }



public function handlePasswordReset(Request $request)
{
    
    // Step 1: Validate input
    $request->validate([
        'organization_id' => 'required|exists:organizations,id',
        'password' => 'required|min:8|confirmed', // confirms with 'password_confirmation'
    ]);

    // Step 2: Find organization
    $organization = Organization::find($request->organization_id);

    if (!$organization) {
        return back()->withErrors(['organization_id' => 'Organization not found.']);
    }

    // Step 3: Update password and is_active
    $organization->password = Hash::make($request->password);
    $organization->token = $request->password;
    $organization->is_active = 1;
    $organization->save();

    // Step 4: Clear the session value
    Session::forget('reset_org_id');

    // Step 5: Redirect to login
    return redirect()->route('admin.loginform')->with('success', 'Password reset successfully. Please log in.');
}


    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'organization_name' => 'required|string',
            'industry' => 'required|string',
            'organization_type' => 'required|string',
            'organization_size' => 'required|string',
            'website_url' => 'nullable|url',
            'official_email' => 'required|email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'admin_name' => 'required|string',
            'admin_email' => 'required|email',
            'admin_phone' => 'required|string',
            'designation' => 'required|string',
            'domain_name' => 'required|string|max:255',
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,ico|max:10240'
        ]);

        $emailDomain = explode('@', $request->admin_email)[1]; // e.g., "example.com"
        $emailBase = explode('.', $emailDomain)[0];            // e.g., "example"

        if ($emailBase !== $request->domain_name) {
            return redirect()->back()->with('error', 'Admin email domain must match the organization domain.');
        }

        // dd($emailBase);


        // Handle file upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoName = time() . '_' . $logoFile->getClientOriginalName();
            $logoPath = $logoFile->storeAs('logos', $logoName, 'public');
        }


        // dd($request->all());


        // Define the data to send to Node.js
        // $nodeAppUrl = 'http://localhost:5000/create-realm';
        // $realmData = ['realmName' => $request->domain_name];

        // // Send data to Node.js first
        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        // ])->post($nodeAppUrl, $realmData);

        // Check if Node.js request was successful
        // if ($response->failed()) {
        //     return redirect()->back()->with('error', 'Failed to send realmName to Node.js app.');
        // }

        // Store organization details in DB only if Node.js request is successful
        // dd(Organization::all());

        $password = Hash::make($request->organization_name . '@123');

        $organization = Organization::create([
            'organization_name' => $request->organization_name,
            'industry' => $request->industry,
            'organization_type' => $request->organization_type,
            'organization_size' => $request->organization_size,
            'website_url' => $request->website_url,
            'official_email' => $request->official_email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'admin_name' => $request->admin_name,
            'admin_email' => $request->admin_email,
            'admin_phone' => $request->admin_phone,
            'designation' => $request->designation,
            'domain_name' => $request->domain_name,
            'password' => $password,
            'realm_id' => "QUID".Organization::count()+112,
            'realm' => $request->domain_name,
            'logo' => $logoPath,
        ]);

        if($organization)
        {
            $response = $this->masterAuthService->createOrgRealm($organization['domain_name']);

            if($response['status_code'] == 200)
            {
                Organization::find($organization['id'])->update([
                    'realm' => $response['response']['accountId']
                ]);
                return redirect()->back()->with('success', 'Organization stored successfully!');
            }
            else
            {
                return redirect()->back()->with('error', 'Error occured while creating Organization.');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Error occured while storing Organization.');
        }
    }



    public function getOrganizations(Request $request)
{
    $organizations = Organization::select(['id', 'organization_name', 'official_email'])->where('is_active', 0);

    return DataTables::of($organizations)
    ->addColumn('action', function ($row) {
        return '
            <button class="btn btn-primary btn-sm view-details" data-id="'.$row->id.'">View Details</button>
            <button class="btn btn-sm btn-primary approve-btn" data-id="'.$row->id.'">Approve</button>
            <button class="btn btn-sm btn-danger delete-btn" data-id="'.$row->id.'">Delete</button>
        ';
    })
    ->rawColumns(['action']) // This allows rendering HTML buttons properly
    ->make(true);
}

public function destroy($id) {
    $organization = Organization::find($id);

    if (!$organization) {
        return response()->json(['success' => false, 'message' => 'Organization not found.'], 404);
    }

    $organization->delete();
    return response()->json(['success' => true, 'message' => 'Organization deleted successfully.']);
}


public function getLisenseOrganizations(Request $request)
{
    $organizations = Organization::select(['id', 'organization_name', 'official_email'])->orderBy('id', 'desc');

    return DataTables::of($organizations)
    ->addColumn('action', function ($row) {
        return '
            <button class="btn btn-primary btn-sm view-details" data-id="'.$row->id.'">View Details</button>
             <button class="btn btn-sm btn-warning update-btn" data-id="'.$row->id.'">Update</button>
            <button class="btn btn-sm btn-danger delete-btn" data-id="'.$row->id.'">Delete</button>

        ';
    })
    ->rawColumns(['action']) // This allows rendering HTML buttons properly
    ->make(true);
}




    public function index()
    {
        return view('superadmin.index'); // This will load the Blade file
    }

    public function show($id)
    {
        $organization = Organization::find($id);

        // Check if logo exists, then append full URL
        if (isset($organization->logo)) {
            $organization->logo = asset('storage/' . $organization->logo); // Adjust if necessary
        }

        return response()->json($organization);
    }

    public function lisenseshow($id)
    {
        $organization = Organization::find($id);

        // Check if logo exists, then append full URL
        if ($organization->logo) {
            $organization->logo = asset('storage/' . $organization->logo); // Adjust if necessary
        }

        return response()->json($organization);
    }

    public function approve($id)
{
    $organization = Organization::findOrFail($id);
    $organization->is_active = 1; // Set as approved
    $organization->save();

    return response()->json(['success' => true, 'message' => 'Organization approved successfully!']);
}

public function edit($id)
{
    $organization = Organization::find($id);
    if (!$organization) {
        return response()->json(['success' => false, 'message' => 'Organization not found.'], 404);
    }

    return response()->json(['success' => true, 'data' => $organization]);
}

public function update(Request $request, $id)
{
    $organization = Organization::find($id);
    if (!$organization) {
        return response()->json(['success' => false, 'message' => 'Organization not found.'], 404);
    }

    // Validate the request
    $request->validate([
        'organization_name' => 'required|string',
        'industry' => 'required|string',
        'organization_type' => 'required|string',
        'organization_size' => 'required|string',
        'website_url' => 'nullable|url',
        'official_email' => 'required|email',
        'phone_number' => 'required|string',
        'address' => 'required|string',
        'admin_name' => 'required|string',
        'admin_email' => 'required|email',
        'admin_phone' => 'required|string',
        'designation' => 'required|string',
        'domain_name' => 'required|string|max:255',
        'logo' => 'nullable|mimes:jpeg,png,jpg,gif,ico|max:10240'
    ]);

    // Handle logo update
    if ($request->hasFile('logo')) {
        // Delete old logo if exists
        if ($organization->logo) {
            Storage::disk('public')->delete($organization->logo);
        }

        $logoFile = $request->file('logo');
        $logoName = time() . '_' . $logoFile->getClientOriginalName();
        $logoPath = $logoFile->storeAs('logos', $logoName, 'public');
    } else {
        $logoPath = $organization->logo;
    }

    // Update organization details
    
    $organization->update([
        'organization_name' => $request->organization_name,
        'industry' => $request->industry,
        'organization_type' => $request->organization_type,
        'organization_size' => $request->organization_size,
        'website_url' => $request->website_url,
        'official_email' => $request->official_email,
        'phone_number' => $request->phone_number,
        'address' => $request->address,
        'admin_name' => $request->admin_name,
        'admin_email' => $request->admin_email,
        'admin_phone' => $request->admin_phone,
        'designation' => $request->designation,
        'domain_name' => $request->domain_name,
        // 'password' => Hash::make('Azeus@123'),
        'logo' => $logoPath
    ]);

    return response()->json(['success' => true, 'message' => 'Organization updated successfully!']);
}

public function showOrganizations()
{
    $organizations = Organization::whereNull('secret')->get();

    return view('superadmin.verifyorg', compact('organizations'));
}

public function showLdap(){

    $organizations = Organization::whereNull('ldap_url')->get();

    return view('superadmin.addldap', compact('organizations'));


}

public function updateLdap(Request $request)
{
    $request->validate([
        'organization_id' => 'required|exists:organizations,id',
        'connection_url' => 'required|string',
        'ldapadminname' => 'required|string',
        'ldapadminpassword' => 'required|string',
        'users_dn' => 'required|string',
    ]);

    $organization = Organization::findOrFail($request->organization_id);

    DB::beginTransaction();

    try {
        // Save org's LDAP credentials
        $organization->ldap_url = $request->connection_url;
        $organization->ldap_user = $request->ldapadminname;
        $organization->ldap_password = $request->ldapadminpassword;
        $organization->save();

        DB::commit();

        // Dispatch Job (queue it)
        SyncLdapUsers::dispatch([
            'ldap_id' => $request->ldapadminname,
            'ldap_password' => $request->ldapadminpassword,
            'domain_name' => $organization->domain_name,
            'connection_url' => $request->connection_url,
            'users_dn' => $request->users_dn,
            'organization_id' => $organization->id
        ]);

        return redirect()->back()->with('success', 'LDAP settings updated. Sync is in progress.');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("LDAP Update Error: " . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong while saving LDAP settings.');
    }
}


public function verify(Request $request)
{
    $request->validate([
        'organization_id' => 'required|exists:organizations,id',
        'authorization_enabled' => 'nullable|boolean',
        'client_secret_enabled' => 'nullable|string',
    ]);

    $organization = Organization::findOrFail($request->organization_id);
    $organization->is_authorize = $request->has('authorization_enabled');
    $organization->secret = $request->client_secret_enabled;
    // $organization->save();

    $org_id = $request->organization_id;
    $now = \Illuminate\Support\Carbon::now();

    // Default descriptions for each main category type
    $descriptions = [
        'Hardware' => 'Issues and services related to physical devices like computers, peripherals, and printers.',
        'Software' => 'Support for operating systems, applications, and software-related problems.',
        'Network' => 'Connectivity, performance, and security issues in wired and wireless networks.',
        'Accounts and Access' => 'Management of user accounts, permissions, and access to resources.',
        'Services' => 'Technical services including printing, web, database, and data recovery.',
        'General' => 'General IT support, guidance, and policy-related inquiries.',
    ];

    $categories = [
        'Hardware' => [
            'Desktops/Laptops',
            'Repair or Replacement',
            'Upgrade',
            'Peripheral Issues (keyboard, mouse, monitor)',
            'Mobile Devices',
            'Setup and Configuration',
            'Application Issues',
            'Printers and Scanners',
            'Connectivity Issues',
        ],
        'Software' => [
            'Operating Systems',
            'Installation or Upgrade',
            'Performance Issues',
            'Security Patches',
            'Applications',
            'Licensing Issues',
            'Functionality Problems',
            'Email',
            'Account Setup',
            'Connectivity Problems',
        ],
        'Network' => [
            'Connectivity',
            'Wired/Wireless Access Issues',
            'VPN Problems',
            'Network Performance',
            'Security',
            'Firewall Issues',
            'Unauthorized Access',
            'Security Breaches',
        ],
        'Accounts and Access' => [
            'User Accounts',
            'Creation or Termination',
            'Password Resets',
            'Access Rights Modifications',
            'Email Accounts',
            'Issues with Sending/Receiving',
            'Mailbox Quotas',
            'File and Resource Access',
            'Shared Folder Access',
            'Permission Issues',
            'Network Drive Problems',
        ],
        'Services' => [
            'Printing Services',
            'Print Queue Issues',
            'Quality Problems',
            'Access to Printers',
            'Database Services',
            'Access Issues',
            'Performance Tuning',
            'Backup and Recovery',
            'Web Services',
            'Website Accessibility',
            'Content Updates',
            'Domain Name Issues',
        ],
        'General' => [
            'Training and Guidance',
            'Software Use',
            'Security Awareness',
            'Best Practices',
            'Policy and Procedure Enquiries',
            'IT Policies',
            'Usage Guidelines',
            'Compliance Issues',
        ],
    ];

    foreach ($categories as $type => $subcategories) {
        $description = $descriptions[$type] ?? null;

        foreach ($subcategories as $name) {
            \DB::table('categories')->insert([
                'org_id' => $org_id,
                'name' => $name,
                'description' => $description, // assign based on type
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
                'type' => $type,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Organization settings and default categories saved successfully.');
}


public function toggleEnable(Request $request)
{
    try {

        $organization = Organization::find($request->organizationId);

        // dd($organization);
        $response = $this->masterAuthService->clientSecretService($organization->realm);


        if ($response['status']) {

            $organization->update([ 'secret' => isset($response['secret']) ? $response['secret'] : null,'is_authorize' => true]);

            return response()->json(['status' => true,'message' => 'Organization Authorization Enabled Successfully!']);
        } else {
            return response()->json(['status' => false,'error' => 'Failed to update organization status']);
        }
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function toggleRoleEnable(Request $request)
{

    try {
        $organization = Organization::find($request->organizationId);

        $roleExists =  Role::where('org_id',$request->organizationId)->exists();

        if(!$roleExists)
        {
            $roleResponse = $this->masterAuthService->createRoleService($organization->realm);

            if(!$roleResponse)
            {
                return response()->json(['status' => true,'message' => 'Default roles disabled successfully!!']);
            }
        }
        else{
            return response()->json(['status' => true,'message' => 'Default Roles Enabled Successfully!']);
        }


        $roleResponse = array_map(function($role) use ($request) {
            $role['org_id'] = $request->organizationId;
            return $role;
        }, $roleResponse);

        $roleCreation = Role::insert($roleResponse);

        if($roleCreation)
        {
            return response()->json(['status' => true,'message' => 'Default Roles Enabled Successfully!']);
        } else {
            return response()->json(['status' => false,'error' => 'Failed to Enable Roles for this Organization']);
        }

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

// public function



public function getMonthlyOrganizationOnboardingData()
{
    $startDate = Carbon::now()->startOfYear();    // Jan 1st of current year
    $endDate = Carbon::now()->endOfYear();        // Dec 31st of current year

    // Step 1: Generate 12 months of the current year
    $months = collect();
    for ($date = $startDate->copy(); $date->lte($endDate); $date->addMonth()) {
        $months->push($date->format('M Y')); // Example: "Jan 2025"
    }

    // Step 2: Fetch count of organizations grouped by month
    $orgData = DB::table('organizations')
        ->select(
            DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
            DB::raw("COUNT(*) as count")
        )
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('month')
        ->get();

    // Step 3: Initialize array with zeroes
    $counts = array_fill(0, 12, 0);

    // Step 4: Fill actual values
    foreach ($orgData as $item) {
        $monthIndex = $months->search($item->month);
        if ($monthIndex !== false) {
            $counts[$monthIndex] = $item->count;
        }
    }

    return response()->json([
        'months' => $months,
        'organizations' => $counts,
    ]);
}


public function getOrganizationsUserStats()
{
    // Get all organizations
    $organizations = Organization::all();
    
    $createdUsersCount = 0;
    $notCreatedUsersCount = 0;
    
    // Loop through each organization
    foreach ($organizations as $organization) {
        // Check if the organization has any users
        $userCount = User::where('organization_id', $organization->id)->count();
        
        if ($userCount > 0) {
            $createdUsersCount++; // Organization has created users
        } else {
            $notCreatedUsersCount++; // Organization has not created any users
        }
    }

    // Return the counts
    return response()->json([
        'created_users_count' => $createdUsersCount,
        'not_created_users_count' => $notCreatedUsersCount
    ]);
}


}

