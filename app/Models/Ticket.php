<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'subject',
        'image',
        'summary',
        'feedback',
        'priority',
        'assignee',
        'status',
        'closed_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'raised_by');
    }
}
