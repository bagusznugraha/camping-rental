<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'user_id',
        'visitor_name',
        'role',
        'visit_date',
        'visit_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}