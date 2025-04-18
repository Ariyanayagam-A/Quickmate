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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
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
            'realm_id' => "QUID".Organization::count()+5,
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
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
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
        'password' => Hash::make('Azeus@123'),
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

    $organizations = Organization::all();

    return view('superadmin.addldap', compact('organizations'));


}

public function updateLdap(Request $request)
{
    $request->validate([
        'organization_id' => 'required|exists:organizations,id',
        'connection_url' => 'required|string',
        'ldapadminname' => 'required|string',
        'ldapadminpassword' => 'required|string',
    ]);

    $organization = Organization::findOrFail($request->organization_id);

    DB::beginTransaction();

    try {
        // 1. Update organization with LDAP info
        $organization->ldap_url = $request->connection_url;
        $organization->ldap_user = $request->ldapadminname;
        $organization->ldap_password = $request->ldapadminpassword;
        $organization->save();

        // 2. Call MasterAuthService to send LDAP info
        $ldapResponse = $this->masterAuthService->sendLdapDetails([
            'ldap_id' => $request->ldapadminname,
            'ldap_password' => $request->ldapadminpassword,
            'domain_name' => $organization->domain_name,
            'connection_url' => $request->connection_url
        ]);

        // Check if response is valid and has expected structure
        if (!is_array($ldapResponse) ||
            !isset($ldapResponse['status_code']) ||
            $ldapResponse['status_code'] !== 200 ||
            !isset($ldapResponse['response']['data'])) {

            Log::error("Invalid LDAP response or sync failure.", ['response' => $ldapResponse]);
            DB::rollBack();
            return redirect()->back()->with('error', 'Saved, but failed to sync LDAP users.');
        }

        // 3. Extract and store users
        $counter = 1;
        $ldapUsers = $ldapResponse['response']['data'];

        $counter = 1;

        foreach ($ldapUsers as $ldapUser) {
            $username = $ldapUser['username'] ?? 'user' . $counter;
            $email = $ldapUser['email'] ?? $username . $counter . '@example.com';

            User::create([
                'name' => $username,
                'realm' => $organization->organization_name,
                'email' => $email,
                'password' => Hash::make('1234'), // Or whatever default password you want
                'organization_id' => $organization->id
            ]);

            $counter++;
        }


        DB::commit();
        return redirect()->back()->with('success', 'LDAP settings updated and users synced successfully.');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("LDAP Update Error: " . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong during LDAP sync.');
    }
}


public function verify(Request $request) {
    $request->validate([
        'organization_id' => 'required|exists:organizations,id',
        'authorization_enabled' => 'nullable|boolean',
        'client_secret_enabled' => 'nullable|string',
    ]);
    // dd($request->all());

    $organization = Organization::findOrFail($request->organization_id);
    $organization->is_authorize = $request->has('authorization_enabled');
    $organization->secret = $request->client_secret_enabled;

    // $organization->save();

    return redirect()->back()->with('success', 'Organization settings updated successfully.');
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

}

