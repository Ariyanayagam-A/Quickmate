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
        'raised_by',
        'user_mail',
        'organization_id',
        'closed_at',
        'category',
        'is_approved',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'raised_by');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }
    
    
}
