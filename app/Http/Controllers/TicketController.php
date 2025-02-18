<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DataTables;

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
        $categories = Category::where('status',1)->get();
        return view('customer.raise-ticket')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
     try{
        // dd($request->all());
       $validator =  Validator::make($request->all(), [
        'title' => 'required',
        'desc' => 'required',
        'category' => 'required',
    ]);

        if ($validator->fails()) {
            // die('error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ticket = new Ticket();
        $ticket->subject = $request->title;
        $ticket->ticket_id = 'TKT'.rand(100000,999999);
        // $ticket->image = $request->image;
        $ticket->raised_by = Auth::user()->id;
        $ticket->category = $request->category;
        $ticket->summary = $request->desc;
        $ticket->status =  0;
        
        $ticket_save = $ticket->save();

        if ($ticket_save) {
            // die('saved');
            return redirect()->back()->with('success', 'Ticket created successfully.');
        }
        else {
            return redirect()->back()->with('error', 'Ticket creation failed.');
        }
    }
    catch (\Exception $e) {
        die('error'.$e->getMessage());
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


    public function list()
    {
        if(Auth::user()->role == 1 )
        {
            $tickets = Ticket::with('category')->orderBy('id', 'desc');

        }
        else
        {
            $tickets = Ticket::with('category')->where('raised_by',Auth::user()->id)->orderBy('id', 'desc');
        }

        return Datatables::of($tickets)
                ->addIndexColumn()
                ->addColumn('ticket_no', function($row){
                    return $row->ticket_id;
                })
                ->addColumn('title', function($row){
                    return $row->subject;
                })
                ->addColumn('created_at', function($row){
                    return $row->created_at;
                })
                ->addColumn('category', function($row){
                        return !is_null($row->Category) && isset($row->Category) ? $row->Category->name : '-';
                })
                ->addColumn('description', function($row){
                    return $row->summary;
                })
                ->addColumn('updated_at', function($row){
                    return $row->updated_at;
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
                ->addColumn('action', function($row){
   
                    $btn = '<button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-primary" title="View Ticket">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-warning" title="Edit Ticket">
                    <a href="'.route('edit.ticket', $row->id).'"> 
                    <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger" title="Delete Ticket">
                      <a href="'.route('delete.ticket', $row->id).'"> 
                        <i class="fa-regular fa-trash-can"></i>
                    </button>';
                
                    return $btn;
                })
                ->rawColumns(['action','status','level'])
                ->make(true);
        // return view('admin.tickets', compact('tickets'));
    }

    public function adminTicketsList()
    {

        $tickets = Ticket::with('category','user')->orderBy('id', 'desc');

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
                
                ->addColumn('indicator', function($row){
                    return '-';
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
                ->addColumn('created_at', function($row){
                    return $row->created_at;
                })
                ->addColumn('action', function($row){
   
                    $btn = '<button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placemeznt="top" data-bs-custom-class="custom-tooltip-primary" title="View Ticket">
                        <i class="bi bi-eye"></i>
                    </button>
                    <br/>
                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-warning" title="Edit Ticket">
                    <a href="'.route('edit.ticket', $row->id).'"> 
                    <i class="bi bi-pencil-square"></i>
                    </button><br/>
                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip-danger" title="Delete Ticket">
                      <a href="'.route('delete.ticket', $row->id).'"> 
                        <i class="bi bi-trash"></i>
                    </button>';
                
                    return $btn;
                })
                ->rawColumns(['action','status','level'])
                ->make(true);
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
            $updateData = ['status' => $request->status,'closed_at' => $request->status == 3 ? date('Y-m-d H:i:s') : null];
        }

        $solveTicket = Ticket::where('id',$request->ticketId)->update($updateData);

        if($solveTicket)
        {
            if($request->status == 2)
            {
                return response()->json(['status' => 'success', 'message' => 'Ticket Closed successfully.']);
            }
            else if($request->status == 3){
                return response()->json(['status' => 'success', 'message' => 'Ticket Rejected successfully.']);
            }
            else if($request->status == 4){
                return response()->json(['status' => 'success', 'message' => 'Ticket Holded successfully.']);
            }
            else{
                return response()->json(['status' => 'success', 'message' => 'Ticket resolved successfully.']);
            }
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Ticket update Failed.']);
        }
    }
    
    public function agentTicketlist()
    {
        $tickets = Ticket::with('user')->where('assignee',Auth::user()->id)->orderBy('id', 'desc')->get();

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

            $btn = '';
            $hasFeedback = is_null($row->feedback) ? 0 : 1; 
                if($row->status != 2){
                $btn = '<button id="openModalBtn" data-type="close" data-hasfeedback="'.$hasFeedback.'" data-status="'.$row->status.'" onclick="closeRejectTicket(this,'.$row->id.')" class="btn btn-outline-primary btn-sm assign_ticket">Close Ticket</button>
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
}
