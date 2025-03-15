<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_name',
        'industry',
        'organization_type',
        'website_url',
        'organization_size',
        'logo',
        'official_email',
        'phone_number',
        'address',
        'admin_name',
        'admin_email',
        'admin_phone',
        'designation',
        'domain_name', 
        'is_active',
    ];
}
