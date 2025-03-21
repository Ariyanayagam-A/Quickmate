<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer.tickets');
    }

    public function raiseTicket()
    {
        $categories = Category::where('is_active',1)->get();
        return view('customer.raise-ticket')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'desc' => 'required',
                'category' => 'required',
                'ticket_file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048', // Limit file type & size
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            // Retrieve user_id and organization_id from session
            // $organizationId = session('organization_id');
            // $userId = session('user_id');
            
    
            // if (!$userId) {
            //     return redirect()->back()->with('error', 'User ID not found in session.');
            // }
    
            // Debugging: Check if session values are set
            // dd(session()->all()); 
    
            // Create new ticket
            $ticket = new Ticket();
            $ticket->subject = $request->title;
            $ticket->ticket_id = 'TKT' . rand(100000, 999999);
            $ticket->category = $request->category;
            $ticket->summary = $request->desc;
            $ticket->status = 0;
            $ticket->raised_by = 1; // Store the logged-in user's ID
            $ticket->organization_id = 1;
    
            // Handle file upload
            if ($request->hasFile('ticket_file')) {
                $file = $request->file('ticket_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/tickets', $fileName, 'public');
                $ticket->image = $filePath;
            }
    
            // Save ticket
            if ($ticket->save()) {
                return redirect('/user/tickets')->with('success', 'Ticket created successfully.');
            } else {
                return redirect()->back()->with('error', 'Ticket creation failed.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        
    }




    public function list(Request $request)
{
    //    // Get the organization_id from the session
    // $organizationId = session('organization_id');

    // if (!$organizationId) {
    //     dd('No Organization ID in Session');
    //     return response()->json(['error' => 'Unauthorized - No Organization ID in Session'], 401);
    // }
    //  // Fetch the user associated with this organization_id
    //  $user = User::where('organization_id', $organizationId)->first();

        $tickets = Ticket::with('category')->orderBy('id', 'desc')->get();
    
        return DataTables::of($tickets)
            ->addIndexColumn()
            ->addColumn('ticket_id', function($row) {
                return $row->ticket_id;
            })
            // ->addColumn('subject', function($row) {
            //     return $row->subject;
            // })
            // ->addColumn('created_at', function($row) {
            //     return $row->created_at->format('Y-m-d H:i:s'); // Formatting the date
            // })
            ->addColumn('category', function($row) {
                return $row->Category->name ?? '-';
            })
            // ->addColumn('description', function($row) {
            //     return $row->summary;
            // })
            // ->addColumn('updated_at', function($row) {
            //     return $row->updated_at ? $row->updated_at->format('Y-m-d H:i:s') : '-';
            // })
            // ->addColumn('level', function($row) {
            //     return $row->priority ? '<span class="badge bg-info">L' . $row->priority . '</span>' : '-';
            // })
            ->addColumn('status', function($row) {
                if ($row->status == 0) {
                    return '<span class="badge bg-warning">Open</span>';
                }
                elseif ($row->status == 1) {
                    return '<span class="badge bg-info">On Progress</span>';
                }
                elseif ($row->status == 2) {
                    return '<span class="badge bg-success">Solved</span>';
                }
                elseif ($row->status == 3) {
                    return '<span class="badge bg-danger">Rejected</span>';
                }
                else {
                    return '<span class="badge bg-dark">On Hold</span>';
                }
            })
            ->rawColumns(['status'])
            // ->addColumn('action', function($row) {
            //     return '<a href="' . route('edit.ticket', $row->id) . '" class="btn btn-warning btn-sm">Edit</a>
            //             <a href="' . route('delete.ticket', $row->id) . '" class="btn btn-danger btn-sm">Delete</a>';
            // })
            // ->rawColumns(['status', 'level', 'action'])
            ->make(true);
            
}
    

    public function adminTicketsList()
    {

        $tickets = Ticket::with('category','user')->orderBy('id', 'desc')->get();

        return Datatables::of($tickets)
                ->addIndexColumn()
                ->addColumn('ticket_no', function($row){
                    return $row->ticket_id;
                })
               ->addColumn('requested_by', function($row){
                    return $row->user->name;
                })
                ->addColumn('email', function($row){
                    return $row->user->email;
                })
                ->addColumn('title', function($row){
                    return $row->subject;
                })
                // ->addColumn('created_at', function($row){
                //     return $row->created_at;
                // })
                ->addColumn('category', function($row){
                        return !is_null($row->Category) && isset($row->Category) ? $row->Category->name : '-';
                })
                ->addColumn('assigned_to', function($row){
                    if($row->assignee == '4')
                    {
                        return 'Karthikeyan';
                    }
                    else if($row->assignee == '3')
                    {
                        return 'Sabari';
                    }
                    else{
                        return '-';
                    }
                })
                
                ->addColumn('indicator', function($row) {
                    $flag = $row->status ?? 'default';
                    $flag_img = "<img src='" . asset("assets/dist/assets/img/flag-icon/$flag.png") . "' alt='flag' width='50' height='50'>";
                    return $flag_img;
                
                }) 
                ->addColumn('level', function($row){
                   $level_html = is_null($row->priority) ? '-' : '<button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
                                data-bs-title="Edit">
                                <i class="">L'.$row->priority.'</i>
                              </button>';
                    return $level_html;
                })
                ->addColumn('status', function($row){
                    if ($row->status == 0) {
                        $status_btn = '<span class="badge bg-warning">Open</span>';
                    }
                    elseif ($row->status == 1) {
                        $status_btn = '<span class="badge bg-info">On Progress</span>';
                    }
                    elseif ($row->status == 2) {
                        $status_btn = '<span class="badge bg-success">Solved</span>';
                    }
                    elseif($row->status == 3) {
                        $status_btn = '<span class="badge bg-danger">Rejected</span>';
                    }
                    else{
                        $status_btn = '<span class="badge bg-secondary">On Hold</span>';
                    }
                    return $status_btn;
                })
                ->addColumn('created_at', function($row){
                    return $row->created_at;
                })
                ->addColumn('action', function($row) {
                    $btn = '<button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary" title="View Ticket" onclick="viewTicket('.$row->id.')">
                                <i class="bi bi-eye"></i>
                            </button>';
                
                    // Show Assign and Reject buttons only if status is not 3 (Rejected)
                    if ($row->status != 2 && $row->status != 3) {
                        $btn .= '<br/>
                                 <button class="btn btn-outline-warning btn-sm assign-ticket-btn" data-id="'.$row->id.'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-warning" title="Assign Ticket">
                                    <i class="bi bi-pencil-square"></i>
                                 </button>
                                 <br/>
                                 <button class="btn btn-outline-danger btn-sm delete-ticket-btn" data-id="'.$row->id.'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger" title="Reject Ticket">
                                    <i class="bi bi-x-circle"></i>
                                 </button>';
                    }
                
                    return $btn;
                })
                
                ->rawColumns(['action','status','level','indicator'])
                ->make(true);
    }

    public function getTickets(Request $request)
{
    $query = Ticket::query();

    // Map status text to database values
    $statusMapping = [
        "Open" => 0,
        "On Progress" => 1,
        "Solved" => 2,
        "Rejected" => 3,
        "On Hold" => 4
    ];

    // Apply filtering if a search value is provided
    if ($request->has('search') && isset($request->input('search')['value'])) {
        $searchValue = $request->input('search')['value'];
        
        // Convert text status to corresponding number
        if (isset($statusMapping[$searchValue])) {
            $query->where('status', $statusMapping[$searchValue]);
        }
    }

    return DataTables::of($query)
        ->addColumn('status', function($row) {
            $statusLabels = [
                0 => '<span class="badge bg-warning">Open</span>',
                1 => '<span class="badge bg-info">On Progress</span>',
                2 => '<span class="badge bg-success">Solved</span>',
                3 => '<span class="badge bg-danger">Rejected</span>',
                4 => '<span class="badge bg-secondary">On Hold</span>'
            ];
            return $statusLabels[$row->status] ?? '<span class="badge bg-secondary">Unknown</span>';
        })
        ->rawColumns(['status']) // Allow HTML badges
        ->make(true);
}

    public function rejectTicket(Request $request)
{
    $ticket = Ticket::find($request->ticket_id);

    if (!$ticket) {
        return response()->json(['message' => 'Ticket not found!'], 404);
    }

    $ticket->status = 3; // Change status to "Rejected"
    $ticket->closed_at = Carbon::now(); // Store rejection time
    $ticket->save();

    return response()->json(['message' => 'Ticket has been rejected successfully!']);
}


    public function assignTicketadmin(Request $request)
    {

        $ticket = Ticket::find($request->ticket_id);

        // Check if the ticket is already assigned
        if (!is_null($ticket->assignee)) {
            return response()->json(['success' => false, 'message' => 'This ticket is already assigned!'], 400);
        }

        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'assignee' => 'required',
            'priority' => 'required'
        ]);
    
        $ticket = Ticket::find($request->ticket_id);
        $ticket->assignee = $request->assignee;
        $ticket->priority = $request->priority;
        $ticket->save();
    
        return response()->json(['message' => 'Ticket assigned successfully!']);
    }
    

    public function ticketsView()
    {
        return view('supportdesk.tickets');
    }
    public function supportTicketlist()
    {
        // { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        // {data : 'ticket_no', name: 'request_by'},
        // {data: 'title', name: 'email'},
        // {data: 'created_at', name: 'subject'},
        // {data: 'category', name: 'agent'},
        // {data: 'description', name: 'country'},
        // {data: 'status', name: 'status'},
        // {data: 'last_message', name: 'last_message'},
        // {data: 'action', name: 'action', orderable: false, searchable: false},

        $tickets = Ticket::with('user')->orderBy('id', 'desc')->get();

        // dd($tickets->get());

        return Datatables::of($tickets)
        ->addIndexColumn()
        ->addColumn('view', function($row){
            return '<button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary" data-bs-title="Edit">
                              <i class="fa-regular fa-eye"></i>
                            </button>';
        })
        ->addColumn('request_by', function($row){
            // dd($row->user->name);
            return $row->user->name;
        })
        ->addColumn('email', function($row){
            return $row->user->email;
        })
        ->addColumn('subject', function($row){
            return $row->subject;
        })
        ->addColumn('agent', function($row){
            if($row->assignee == '4')
            {
                return 'Karthikeyan';
            }
            else if($row->assignee == '3')
            {
                return 'Sabari';
            }
            else{
                return '-';
            }
 
        })
        ->addColumn('country', function($row){
            return $row->assignee ? 'India' : '-';
        })
        ->addColumn('priority', function($row){
            $level_html = is_null($row->priority) ? '-' : '<button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip"
            data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
            data-bs-title="Edit">
            <i class="">L'.$row->priority.'</i>
          </button>';
             return $level_html;
        })
        ->addColumn('status', function($row){
            if ($row->status == 0) {
                $status_btn = '<span class="badge bg-danger">Pending</span>';
            }
            elseif ($row->status == 1) {
                $status_btn = '<span class="badge bg-info">On Progress</span>';
            }
            elseif ($row->status == 2) {
                $status_btn = '<span class="badge bg-primary">Closed</span>';
            }
            elseif($row->status == 3) {
                $status_btn = '<span class="badge bg-warning">Rejected</span>';
            }
            else{
                $status_btn = '<span class="badge bg-secondary">On Hold</span>';
            }
            return $status_btn;
        })
        ->addColumn('last_message', function($row){
            return "Last message";
        })
        ->addColumn('action', function($row){
            if($row->assignee)
            {
                $btn = '<button id="openModalBtn" data-agent="'.$row->assignee.'" data-priority="'.$row->priority.'" onclick="editTicketAssignment(this,'.$row->id.')" class="btn btn-outline-info btn-sm assign_ticket">Edit Ticket</button>';
                      
            }
            else
            {
                $btn = '<button id="openModalBtn" onclick="AssignAgent('.$row->id.')" class="btn btn-outline-primary btn-sm assign_ticket">Assign Ticket</button>';
            }
           
        //     <button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary" data-bs-title="Edit">
        //     <i class="">L3</i>
        //   </button>
            return $btn;
    })->rawColumns(['view','action','status','priority'])
    ->make(true);
    }

    function assignTicket(Request $request)
    {
        // dd($request->all());
        
        $ticket = Ticket::find($request->ticketid);
        $ticket->assignee = $request->agent;
        $ticket->status = $ticket->status == 0 || is_null($ticket->status) ?  1 : $ticket->status;
        $ticket->priority = $request->priority;
        $ticket->updated_at = date('Y-m-d H:i:s');
        $save_status =  $ticket->save();

        if($save_status)
        {
            return response()->json(['status' => 'success', 'message' => 'Ticket assigned successfully.']);
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Ticket assignment failed.']);
        }
    }

    public function getagentTickets()
    {
        // $ticket = Ticket::find($id);
        // return response()->json(['status' => 'success', 'data' => $ticket]);
        return view('agent.tickets');
    }

    public function getagentholdesTickets()
    {
        // $ticket = Ticket::find($id);
        // return response()->json(['status' => 'success', 'data' => $ticket]);
        return view('agent.holdtickets');
    }

    public function getagenthistoryesTickets()
    {
        // $ticket = Ticket::find($id);
        // return response()->json(['status' => 'success', 'data' => $ticket]);
        return view('agent.historytickets');
    }

    public function ticketsStatusView()
    {
        return view('supportdesk.ticket-status');
    }

    public function ticketsHistoryView()
    {
        return view('supportdesk.ticket-history');
    }

    public function assignedTicketsList()
    {
        $tickets = Ticket::with('category','user')->whereIn('status',['1','2'])->orderBy('id', 'desc')->get();

        return Datatables::of($tickets)
        ->addIndexColumn()
        ->addColumn('ticket_no', function($row) {
            return $row->ticket_id;
        })
        ->addColumn('created_at', function($row) {
            return $row->created_at;
        })
        ->addColumn('category', function($row) {
            return !is_null($row->Category) && isset($row->Category) ? $row->Category->name : '-';
        })
        ->addColumn('description', function($row) {
            return $row->summary;
        })
        ->addColumn('indicator', function($row) {
            $flag = $row->status ?? 'default';
            $flag_img = "<img src='" . asset("assets/dist/assets/img/flag-icon/$flag.png") . "' alt='flag' width='50' height='50'>";
            return $flag_img;
        
        })
        ->addColumn('engineer', function($row) {
            if ($row->assignee == '4') {
                return 'Karthikeyan';
            } elseif ($row->assignee == '3') {
                return 'Sabari';
            } else {
                return '-';
            }
        })
        ->addColumn('status', function($row) {
            if ($row->status == 0) {
                $status_btn = '<span class="badge bg-warning">Open</span>';
            }
            elseif ($row->status == 1) {
                $status_btn = '<span class="badge bg-info">On Progress</span>';
            }
            elseif ($row->status == 2) {
                $status_btn = '<span class="badge bg-success">Solved</span>';
            }
            elseif($row->status == 3) {
                $status_btn = '<span class="badge bg-danger">Rejected</span>';
            }
            else{
                $status_btn = '<span class="badge bg-secondary">On Hold</span>';
            }
            return $status_btn;
        })
        ->addColumn('level', function($row) {
            return !is_null($row->priority) ? "L".$row->priority : '-';
        })
        ->addColumn('closed_at', function($row) {
            return !is_null($row->priority) ? "L".$row->priority : '-';
        })
        ->rawColumns(['level', 'assigned_to','status','indicator'])
        ->make(true);

    }

    public function getagentHoldTickets()
    {
        $tickets = Ticket::with('user')->where('assignee', 4)->where('status', 4)->orderBy('id', 'desc')->get();
        // dd($tickets);
        return Datatables::of($tickets)
        ->addIndexColumn()
        ->addColumn('view', function($row){
            return '<button class="btn btn-outline-primary btn-sm" onclick="viewTicket('.$row->id.')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary" data-bs-title="Edit">
                              <i class="fa-regular fa-eye"></i>
                            </button>';
        })
        ->addColumn('request_by', function($row){
            // dd($row->user->name);
            return $row->user->name;
        })
        ->addColumn('email', function($row){
            return $row->user->email;
        })
        ->addColumn('subject', function($row){
            return $row->subject;
        })
        ->addColumn('priority', function($row){
            $level_html = is_null($row->priority) ? '-' : '<button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip"
            data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
            data-bs-title="Edit">
            <i class="">L'.$row->priority.'</i>
          </button>';
             return $level_html;
        })
        ->addColumn('status', function($row){
            if ($row->status == 0) {
                $status_btn = '<span class="badge bg-warning">Open</span>';
            }
            elseif ($row->status == 1) {
                $status_btn = '<span class="badge bg-info">On Progress</span>';
            }
            elseif ($row->status == 2) {
                $status_btn = '<span class="badge bg-success">Solved</span>';
            }
            elseif($row->status == 3) {
                $status_btn = '<span class="badge bg-danger">Rejected</span>';
            }
            else{
                $status_btn = '<span class="badge bg-secondary">On Hold</span>';
            }
            return $status_btn;
        })
        ->addColumn('last_message', function($row){
            return "Last message";
        })
        ->addColumn('action', function($row){

            $btn = '';
            $hasFeedback = is_null($row->feedback) ? 0 : 1; 
                if($row->status != 2){
                $btn = '<button id="openModalBtn" data-type="close" data-hasfeedback="'.$hasFeedback.'" data-status="'.$row->status.'" onclick="closeRejectTicket(this,'.$row->id.')" class="btn btn-outline-success btn-sm assign_ticket">Solved Ticket</button>
                &nbsp;';
                }

                if($row->status != 3){
                $btn .= '<button id="openModalBtn" data-type="reject" data-hasfeedback="'.$hasFeedback.'" data-status="'.$row->status.'" onclick="closeRejectTicket(this,'.$row->id.')" class="btn btn-outline-danger btn-sm assign_ticket">Reject Ticket</button>&nbsp;';
                }


                if($row->status != 4){
                $btn .= '<button id="openModalBtn" data-type="hold" data-hasfeedback="'.$hasFeedback.'" data-status="'.$row->status.'" onclick="closeRejectTicket(this,'.$row->id.')" class="btn btn-outline-info btn-sm assign_ticket">Hold Ticket</button>';
                }

               
                return $btn;
            })
            ->addColumn('action', function($row){

                $btn = '';
                $hasFeedback = is_null($row->feedback) ? 0 : 1; 
                    if($row->status != 2){
                    $btn = '<button id="openModalBtn" data-type="close" data-hasfeedback="'.$hasFeedback.'" data-status="'.$row->status.'" onclick="closeRejectTicket(this,'.$row->id.')" class="btn btn-outline-success btn-sm assign_ticket">Solved Ticket</button>
                    &nbsp;';
                    }
    
                    if($row->status != 3){
                    $btn .= '<button id="openModalBtn" data-type="reject" data-hasfeedback="'.$hasFeedback.'" data-status="'.$row->status.'" onclick="closeRejectTicket(this,'.$row->id.')" class="btn btn-outline-danger btn-sm assign_ticket">Reject Ticket</button>&nbsp;';
                    }
    
    
                    if($row->status != 4){
                    $btn .= '<button id="openModalBtn" data-type="hold" data-hasfeedback="'.$hasFeedback.'" data-status="'.$row->status.'" onclick="closeRejectTicket(this,'.$row->id.')" class="btn btn-outline-info btn-sm assign_ticket">Hold Ticket</button>';
                    }
    
                   
                return $btn;
        })->rawColumns(['view','action','status','priority'])
        ->make(true);
    }
    public function getagenthistoryTickets()
    {
        $tickets = Ticket::with('user')->where('assignee', 4)->whereIn('status', [2, 3, 4])->orderBy('id', 'desc')->get();
        // dd($tickets);
        return Datatables::of($tickets)
        ->addIndexColumn()
      
        ->addColumn('request_by', function($row){
            // dd($row->user->name);
            return $row->user->name;
        })
        ->addColumn('email', function($row){
            return $row->user->email;
        })
        ->addColumn('subject', function($row){
            return $row->subject;
        })
        ->addColumn('priority', function($row){
            $level_html = is_null($row->priority) ? '-' : '<button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip"
            data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
            data-bs-title="Edit">
            <i class="">L'.$row->priority.'</i>
          </button>';
             return $level_html;
        })
        ->addColumn('status', function($row){
            if ($row->status == 0) {
                $status_btn = '<span class="badge bg-warning">Open</span>';
            }
            elseif ($row->status == 1) {
                $status_btn = '<span class="badge bg-info">On Progress</span>';
            }
            elseif ($row->status == 2) {
                $status_btn = '<span class="badge bg-success">Solved</span>';
            }
            elseif($row->status == 3) {
                $status_btn = '<span class="badge bg-danger">Rejected</span>';
            }
            else{
                $status_btn = '<span class="badge bg-secondary">On Hold</span>';
            }
            return $status_btn;
        })
        ->addColumn('last_message', function($row){
            return "Last message";
        })
     ->rawColumns(['status','priority'])
    ->make(true);
    }
    
    public function allTicketsList(Request $request)
    {
        $query = Ticket::with('category', 'user')
            ->whereNull('assignee')
            ->orderBy('id', 'desc');
    
        // Apply search filter
        if (!empty($request->input('search')['value'])) {
            $search = $request->input('search')['value'];
    
            $query->where(function ($q) use ($search) {
                $q->where('ticket_id', 'LIKE', "%{$search}%")
                  ->orWhere('summary', 'LIKE', "%{$search}%")
                  ->orWhereHas('category', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('email', 'LIKE', "%{$search}%");
                  });
            });
        }
    
        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('ticket_no', function($row) {
                return $row->ticket_id;
            })
            ->addColumn('created_at', function($row) {
                return $row->created_at->format('Y-m-d H:i:s'); // Formatting date
            })
            ->addColumn('description', function($row) {
                return $row->summary ?? '-';
            })
            ->addColumn('category', function($row) {
                return !is_null($row->Category) && isset($row->Category) ? $row->Category->name : '-';
            })
            ->addColumn('users_mail', function($row) {
                return $row->user->email ?? '-';
            })
            ->addColumn('engineers', function($row) {
                return '<select class="form-select engineers" data-id="'.$row->id.'">
                            <option selected="" disabled="" value="">Assign Engineer</option>
                            <option value="4" '.($row->assignee == '4' ? 'selected' : '').'>Karthikeyan</option>
                            <option value="3" '.($row->assignee == '3' ? 'selected' : '').'>Sabari</option>
                        </select>';
            })
            ->addColumn('level', function($row) {
                return '<select class="form-select level" data-id="'.$row->id.'" required="">
                            <option selected="" disabled="" value="">Select Level</option>
                            <option value="1" '.($row->priority == '1' ? 'selected' : '').'>L1</option>
                            <option value="2" '.($row->priority == '2' ? 'selected' : '').'>L2</option>
                            <option value="3" '.($row->priority == '3' ? 'selected' : '').'>L3</option>
                        </select>';
            })
            ->addColumn('action', function($row) {
                return '<button class="btn btn-outline-primary btn-sm update-ticket" data-id="'.$row->id.'">
                            <i class="bi bi-check-circle"></i> Update
                        </button>';
            })
            ->rawColumns(['engineers', 'level', 'action'])
            ->make(true);
    }
    

    public function updateTicket(Request $request, $id)
    {
        $ticket = Ticket::find($id);
    
        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

         // Check if assignee or priority is changing
    if ($ticket->assignee !== $request->assignee || $ticket->priority !== $request->priority) {
        $ticket->assigned_at = now(); // Set assigned_at only when these fields change
    }
    
        $ticket->assignee = $request->assignee;
        $ticket->priority = $request->priority;
        $ticket->save();
    
        return response()->json(['message' => 'Ticket updated successfully!']);
    }
    


    public function solvedTicketsList()
    {
        $tickets = Ticket::with('category','user')->whereIn('status', [3, 4, 1, 2 ,0])->orderBy('id', 'desc')->get();

        return Datatables::of($tickets)
        ->addIndexColumn()
        ->addColumn('ticket_no', function($row) {
            return $row->ticket_id;
        })
        ->addColumn('created_at', function($row) {
            return $row->created_at;
        })
        ->addColumn('description', function($row) {
            return $row->summary ?? '-';
        })
        ->addColumn('category', function($row) {
            return !is_null($row->Category) && isset($row->Category) ? $row->Category->name : '-';
        })
        ->addColumn('indicator', function($row) {
            $flag = $row->status ?? 'default';
            $flag_img = "<img src='" . asset("assets/dist/assets/img/flag-icon/$flag.png") . "' alt='flag' width='50' height='50'>";
            return $flag_img;
        
        })
        ->addColumn('status', function($row) {
            if ($row->status == 0) {
                $status_btn = '<span class="badge bg-warning">Open</span>';
            }
            elseif ($row->status == 1) {
                $status_btn = '<span class="badge bg-info">On Progress</span>';
            }
            elseif ($row->status == 2) {
                $status_btn = '<span class="badge bg-success">Solved</span>';
            }
            elseif($row->status == 3) {
                $status_btn = '<span class="badge bg-danger">Rejected</span>';
            }
            else{
                $status_btn = '<span class="badge bg-secondary">On Hold</span>';
            }
            return $status_btn;
        })
        ->addColumn('level', function($row) {
            return !is_null($row->priority) ? "L".$row->priority : '-';
        })
        ->addColumn('assigned_to', function($row){
            if($row->assignee == '4')
            {
                return 'Karthikeyan';
            }
            else if($row->assignee == '3')
            {
                return 'Sabari';
            }
            else{
                return '-';
            }
        })
        ->rawColumns(['status','indicator'])
        ->make(true);

    }

    public function getTicketById($id)
    {
        $ticket = Ticket::find($id);
        // dd($ticket);
        return response()->json(['status' => 'success', 'data' => $ticket]);

    }
    public function resolveTicket(Request $request)
    {
        if($request->has('feedback'))
        {
            $updateData = ['feedback' => $request->feedback];
        }
        else
        {
            // $updateData = ['status' => $request->status,'closed_at' => $request->status == 3 ? date('Y-m-d H:i:s') : null];

            $updateData = [
                'status' => $request->status,
                'closed_at' => $request->status == 3 ? date('Y-m-d H:i:s')  : null,  // Store closed time for rejected tickets
                'deleted_at' => $request->status == 2 ? date('Y-m-d H:i:s')  : null  // Store deletion time when ticket is solved
            ];
        }

        $solveTicket = Ticket::where('id',$request->ticketId)->update($updateData);

        if($solveTicket)
        {
            if($request->status == 2)
            {
                return response()->json(['status' => 'success', 'message' => 'Ticket resolved successfully.']);
            }
            else if($request->status == 3){
                return response()->json(['status' => 'success', 'message' => 'Ticket Rejected successfully.']);
            }
            else if($request->status == 4){
                return response()->json(['status' => 'success', 'message' => 'Ticket Holded successfully.']);
            }
            else{
                return response()->json(['status' => 'success', 'message' => 'Ticket closed successfully.']);
            }
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Ticket update Failed.']);
        }
    }
    
    public function agentTicketlist()
    {
        $tickets = Ticket::with('user')->where('assignee', 4)->where('status', 0)->orderBy('id', 'desc')->get();
        // dd($tickets);
        return Datatables::of($tickets)
        ->addIndexColumn()
        ->addColumn('view', function($row){
            return '<button class="btn btn-outline-primary btn-sm" onclick="viewTicket('.$row->id.')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary" data-bs-title="Edit">
                              <i class="fa-regular fa-eye"></i>
                            </button>';
        })
        ->addColumn('request_by', function($row){
            // dd($row->user->name);
            return $row->user->name;
        })
        ->addColumn('email', function($row){
            return $row->user->email;
        })
        ->addColumn('subject', function($row){
            return $row->subject;
        })
        ->addColumn('priority', function($row){
            $level_html = is_null($row->priority) ? '-' : '<button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip"
            data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary"
            data-bs-title="Edit">
            <i class="">L'.$row->priority.'</i>
          </button>';
             return $level_html;
        })
        ->addColumn('status', function($row){
            if ($row->status == 0) {
                $status_btn = '<span class="badge bg-warning">Open</span>';
            }
            elseif ($row->status == 1) {
                $status_btn = '<span class="badge bg-info">On Progress</span>';
            }
            elseif ($row->status == 2) {
                $status_btn = '<span class="badge bg-success">Solved</span>';
            }
            elseif($row->status == 3) {
                $status_btn = '<span class="badge bg-danger">Rejected</span>';
            }
            else{
                $status_btn = '<span class="badge bg-secondary">On Hold</span>';
            }
            return $status_btn;
        })
        ->addColumn('last_message', function($row){
            return "Last message";
        })
        ->addColumn('action', function($row){
            $btn = '';
            $hasFeedback = is_null($row->feedback) ? 0 : 1; 
        
            // Hide all buttons if the ticket is solved (status = 2) or rejected (status = 3)
            if ($row->status != 2 && $row->status != 3) {
                if($row->status != 2){
                    $btn = '<button id="openModalBtn" data-type="close" data-hasfeedback="'.$hasFeedback.'" data-status="'.$row->status.'" onclick="closeRejectTicket(this,'.$row->id.')" class="btn btn-outline-success btn-sm assign_ticket">Solved Ticket</button>
                    &nbsp;';
                }
        
                if($row->status != 3){
                    $btn .= '<button id="openModalBtn" data-type="reject" data-hasfeedback="'.$hasFeedback.'" data-status="'.$row->status.'" onclick="closeRejectTicket(this,'.$row->id.')" class="btn btn-outline-danger btn-sm assign_ticket">Reject Ticket</button>&nbsp;';
                }
        
                if($row->status != 4){
                    $btn .= '<button id="openModalBtn" data-type="hold" data-hasfeedback="'.$hasFeedback.'" data-status="'.$row->status.'" onclick="closeRejectTicket(this,'.$row->id.')" class="btn btn-outline-info btn-sm assign_ticket">Hold Ticket</button>';
                }
            }
        
            return $btn;
        })->rawColumns(['view','action','status','priority'])
    ->make(true);
    }

    //Chart Data
    public function getOpenRequests()
    {
        $data = Ticket::selectRaw('priority, COUNT(*) as count')
            ->groupBy('priority')
            ->pluck('count', 'priority');
    
        // Map priority numbers to L1, L2, L3
        $formattedData = [
            'L1' => $data[1] ?? 0,
            'L2' => $data[2] ?? 0,
            'L3' => $data[3] ?? 0
        ];
    
        return response()->json($formattedData);
    }


    
    
}


