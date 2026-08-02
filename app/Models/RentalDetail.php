<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'equipment_id',
        'quantity',
        'price',
        'subtotal',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}