<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [

    'user_id',

    'start_date',

    'rental_date',

    'return_date',

    'rental_days',

    'phone',

    'address',

    'pickup_method',

    'delivery_fee',

    'pickup_deadline',

    'pickup_deadline_time',

    'total_price',

    'deposit_amount',

    'remaining_payment',

    'deposit_deadline',

    'deposit_status',

    'status',

    'returned_at',
'late_days',
'late_fee',
'late_fee_status',

];


    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    // Pemilik penyewaan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Detail barang yang disewa
    public function rentalDetails()
    {
        return $this->hasMany(RentalDetail::class);
    }

    // Pembayaran
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Chat
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    // Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    // Total barang
    public function getTotalItemAttribute()
    {
        return $this->rentalDetails->sum('quantity');
    }

    // Grand Total
    public function getGrandTotalAttribute()
    {
        return $this->total_price + ($this->delivery_fee ?? 0);
    }

    // Apakah sudah selesai
    public function getIsFinishedAttribute()
    {
        return $this->status == 'selesai';
    }

    // Sudah direview semua?
    public function getIsReviewedAttribute()
    {
        return $this->reviews()->count() ==
               $this->rentalDetails()->count();
    }
}