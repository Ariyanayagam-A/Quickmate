<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
    // Fetch messages for a specific ticket
    public function index($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        // dd(Auth::user()->organization_id,"||", $ticket->organization_id);

         if (Auth::user()->organization_id !== $ticket->organization_id) {
            abort(403, 'Unauthorized');
        }

        $messages = Message::where('ticket_id', $ticketId)
            ->with('sender')
            ->orderBy('created_at', 'asc')
            ->get();
            

        return response()->json($messages);
    }

    // Store a new message
    public function store(Request $request)
    {
        
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'message' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);

         if (Auth::user()->organization_id !== $ticket->organization_id) {
            abort(403, 'Unauthorized');
        }

        // dd($ticket->assignee, Auth::id());

        $message = Message::create([
            'ticket_id' => $request->ticket_id,
            'sender_id' => Auth::id(),
            'receiver_id' => $ticket->assignee,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }
    public function agentindex($ticketId)
{
    $ticket = Ticket::findOrFail($ticketId);

    // dd($ticket->assignee, Auth::id());

    // Make sure this engineer is assigned and in same organization
    if ($ticket->assignee !== Auth::id()) {
        abort(403, 'Not allowed');
    }

    return Message::where('ticket_id', $ticketId)
        ->with('sender')
        ->orderBy('created_at', 'asc')
        ->get();
}

public function agentstore(Request $request)
{
    $request->validate([
        'ticket_id' => 'required|exists:tickets,id',
        'message' => 'required|string'
    ]);

    $ticket = Ticket::findOrFail($request->ticket_id);

    if ($ticket->assignee !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    return Message::create([
        'ticket_id' => $request->ticket_id,
        'sender_id' => Auth::id(),
        'receiver_id' => $ticket->user_id, // assuming `user_id` is requester
        'message' => $request->message
    ]);
}

}

