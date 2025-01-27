<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'status',
    ];

    protected $table = 'categories';


    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'category_id');
    }
}
