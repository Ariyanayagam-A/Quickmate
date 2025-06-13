<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Category;
use Response;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories')->with('activeLink','categories');
    }


    public function getSubcategories(Request $request)
       {
            $organizationId = session('organization_id');
            // dd($organizationId);
            $type = $request->query('type');
            $subcategories = Category::where('type', $type)->where('org_id', $organizationId)->get();
            return response()->json($subcategories);
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
    // dd($request->all());
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'type' => 'required|string|max:255',
        'is_active' => 'required|in:0,1',
    ]);
    // dd($request->all());
    // Log::alert("message", ['data' => $request->all()]);
    // $orgId = Session::get('organization_id'); // Get the ID from session

    Category::create([
        'org_id' => $request->org_id, // Dynamically set the organization ID
        'name' => $request->name,
        'description' => $request->description,
        'type' => $request->type,
        'is_active' => $request->is_active ?? 1,
    ]);

    return response()->json(['success' => 'Category added successfully']);
}


  // Store function

  // Fetch category for editing
  public function categoriesedit($id)
  {
      $category = Category::findOrFail($id);
      return response()->json($category);
  }

  // Update function
  public function categoriesupdate(Request $request, $id)
  {
    // dd($request->all());
      // Validate and update your category
      $data = $request->validate([
          'name' => 'required|string|max:255',
          'description' => 'nullable|string',
          'type' => 'required|string|max:255',
          'is_active' => 'required|boolean',
      ]);

      $category = Category::findOrFail($id);
      $category->update($data);

      return response()->json(['success' => true, 'message' => 'Category updated successfully']);
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
    public function update(Request $request)
    {
        $hasUpdated =  Category::where('id',$request->id)->update([
            'status' => $request->status,
            'name' => $request->category,
        ]);

        if($hasUpdated){
            return Response(['status' => 'success','message' => "Category Updated Successfully!"],200);
        }
        else
        {
            return Response(['status' => 'failed','message' => 'Something Went Wrong!'],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function categoriesDelete($id)
    {

        // dd('wsdsadd');
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found!'], 404);
        }

        $category->delete();

        return response()->json(['success' => 'Category deleted successfully!']);
    }

    public function list()
    {
        // <input type="hidden" name="org_id" value="{{ session('organization')->id }}">
        $orgId = session('organization')->id; // Get the ID from session
        $categories = Category::all()->where('org_id',$orgId);

        // dd($categories);

        return Datatables::of($categories)
                ->addIndexColumn()
                ->addColumn('category', function($row){
                    return $row->name;
                })               
                ->addColumn('status', function($row){
                    if ($row->is_active == 0) {
                        $status_btn = '<span class="badge bg-danger">Inactive</span>';
                    }
                    else{
                        $status_btn = '<span class="badge bg-primary">Active</span>';
                    }
                    return $status_btn;
                })
                ->addColumn('type', function($row){
                    return $row->type;
                })
                ->addColumn('action', function($row){

                    $statusText = $row->status ? 'Disable' : 'Enable';
                    $bgColor    = $row->status ? 'info' : 'danger';
                    $btn = '<button onclick="CategoryModalAction(this,'.$row->id.')" data-action="status" data-current='.$row->status.' class="btn btn-outline-'.$bgColor.' btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary" title="'.$statusText.' Category">
                    <i class="fa-regular fas fa-award"></i>
                    </button>
                    <button class="btn btn-outline-dark btn-sm" data-current='.$row->status.' data-name='.$row->name.' data-action="edit" onclick="CategoryModalAction(this,'.$row->id.')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-warning" title="Edit Category">
                    <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" data-action="delete" onclick="CategoryModalAction(this,'.$row->id.')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger" title="Delete Category">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>';

                    return $btn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
    }

    public function changeStatus(Request $request)
    {
       $hasUpdated =  Category::where('id',$request->id)->update([
            'status' => $request->status
        ]);

        if($hasUpdated){
            $statusText = $request->status ? 'Enabled' : 'Disabled';
            return Response(['status' => 'success','message' => "Category $statusText Successfully!"],200);
        }
        else
        {
            return Response(['status' => 'failed','message' => 'Something Went Wrong!'],500);
        }
    }
}
