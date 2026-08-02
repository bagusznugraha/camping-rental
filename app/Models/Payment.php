<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [

    'rental_id',

    'payment_method',

    'payment_type',

    'payment_proof',

    'final_payment_proof',

    'status',

    'amount',

    'amount_paid',

    'remaining_amount',

    'deposit_deadline',

    'final_payment_status',

    'admin_note',

    'remaining_payment_proof',

];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}