<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $table = 'organizations';
    protected $fillable = [
        'organization_name',
        'password',
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
        'token', 
        'is_active',
        'realm_id',
        'realm',
        'master_orgid',
        'is_authorize',
        'secret',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'realm_id', 'realm_id'); // One organization has many users
    }
}
