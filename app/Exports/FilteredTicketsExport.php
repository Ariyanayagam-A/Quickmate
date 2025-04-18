<?php

namespace App\Exports;

use App\Models\Ticket;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Session;

class FilteredTicketsExport implements FromCollection, WithHeadings
{
    protected $engineerId;
    protected $engineer;

    public function __construct($engineerId = null)
    {
        $this->engineerId = $engineerId;

        // ✅ Safely fetch engineer object once here
        if (is_numeric($this->engineerId)) {
            $this->engineer = User::find($this->engineerId);
        }
    }

    public function collection()
    {
        $orgId = session('organization')->id;

        $tickets = Ticket::with('category', 'user')
            ->where('organization_id', $orgId)
            ->when($this->engineerId, function ($query) {
                $query->where('assignee', $this->engineerId);
            })
            ->orderBy('id', 'desc')
            ->get();

            

        return $tickets->map(function ($ticket) {
            $user = User::where('email', $ticket->user_mail)->first();

            // ✅ Fetch engineer from preloaded one or fallback to query
            $engineer = $this->engineer ?? User::where('id', $ticket->assignee)->where('role', 2)->first();

            return [
                'Ticket ID' => $ticket->ticket_id ?? '-',
                'Requested By' => $user ? $user->name : '-',
                'Email' => $ticket->user_mail ?? '-',
                'Subject' => $ticket->subject ?? '-',
                'Category' => $ticket->category ? $ticket->Category->name : '-',
                'Engineer' => $engineer ? $engineer->name : '-',
                'Indicator' => $this->mapStatusText($ticket->status),
                'Level' => $ticket->priority ? 'L' . $ticket->priority : '-',
                'Status' => $this->mapStatusText($ticket->status),
                'Created At' => $ticket->created_at ?? '-',
                'Assigned At' => $ticket->assigned_at ?? '-',
                'Solved At' => $ticket->deleted_at ?? '-', // Solved time
                'Rejected At' => $ticket->closed_at ?? '-', // Rejected time
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Ticket ID',
            'Requested By',
            'Email',
            'Subject',
            'Category',
            'Engineer',
            'Indicator',
            'Level',
            'Status',
            'Created At',
            'Assigned At',
            'Solved At',
            'Rejected At'
        ];
    }

    private function mapStatusText($status)
    {
        switch ($status) {
            case 0: return 'Open';
            case 1: return 'On Progress';
            case 2: return 'Solved';
            case 3: return 'Rejected';
            default: return 'On Hold';
        }
    }
}
