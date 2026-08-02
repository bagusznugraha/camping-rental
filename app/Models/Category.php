<?php

namespace App\Models;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }
}