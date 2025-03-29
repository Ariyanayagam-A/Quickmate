<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Organization;
// use Tymon\JWTAuth\Facades\JWTAuth;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class OrganizationController extends Controller
{ 
    private $masterAuthService;
    public function __construct(MasterAuthService $masterAuthService)
    {
        $this->masterAuthService = $masterAuthService;
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
    
        // Handle file upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoName = time() . '_' . $logoFile->getClientOriginalName();
            $logoPath = $logoFile->storeAs('logos', $logoName, 'public'); 
        }
    
        // Define the data to send to Node.js
        $nodeAppUrl = 'http://localhost:5000/create-realm';
        $realmData = ['realmName' => $request->domain_name];
    
        // Send data to Node.js first
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($nodeAppUrl, $realmData);
    
        // Check if Node.js request was successful
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to send realmName to Node.js app.');
        }
    
        // Store organization details in DB only if Node.js request is successful
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
            'realm_id' => 324,
            'realm' => 'kloudstack22',
            'master_orgid' => 17,
            'logo' => $logoPath,
        ]);
    
        // Generate JWT token
        $secretKey = env('JWT_SECRET'); 
        $payload = [
            'id' => $organization->id,
            'organization_name' => $organization->organization_name,
            'issued_at' => time(),
            'expires_at' => time() + 86400, // 1-day expiration
        ];
        $token = JWT::encode($payload, $secretKey, 'HS256');
    
        // Store token in the database (if column exists)
        $organization->update(['token' => $token]);
    
        return redirect()->back()->with('success', 'Organization stored successfully!');
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
    $organizations = Organization::select(['id', 'organization_name', 'official_email']);

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
        if ($organization->logo) {
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
        'logo' => $logoPath
    ]);

    return response()->json(['success' => true, 'message' => 'Organization updated successfully!']);
}

public function showOrganizations()
{
    // Fetch organizations that don't already have both authorization and client secret enabled
    $organizations = Organization::where(function ($query) {
        $query->whereNull('is_authorize')
              ->orWhere('is_authorize', false);
    })
    ->whereNull('secret')
    ->get();

    return view('superadmin.verifyorg', compact('organizations'));
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
    
    $organization->save();

    return redirect()->back()->with('success', 'Organization settings updated successfully.');
}
    
}

