<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [

    'user_id',
    'rental_id',
    'equipment_id',

    'rating',
    'comment',

    'photo',

];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function equipment()
{
    return $this->belongsTo(Equipment::class);
}
}