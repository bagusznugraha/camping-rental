<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden Attributes
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    // User memiliki banyak penyewaan
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    // User memiliki banyak notifikasi
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // User memiliki banyak chat
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    // User memiliki banyak ulasan
     public function reviews()
     {
          return $this->hasMany(Review::class);
     }


    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    // Jumlah penyewaan
    public function getTotalRentalAttribute()
    {
        return $this->rentals()->count();
    }

    // Jumlah transaksi selesai
    public function getFinishedRentalAttribute()
    {
        return $this->rentals()
            ->where('status', 'Selesai')
            ->count();
    }

    // Total pengeluaran pelanggan
    public function getTotalSpentAttribute()
    {
        return $this->rentals()
            ->sum('total_price');
    }

    // Jumlah review yang pernah diberikan
    public function getTotalReviewAttribute()
    {
        return $this->reviews()->count();
    }

    // Rata-rata rating yang pernah diberikan
    public function getAverageGivenRatingAttribute()
    {
        return round(
            $this->reviews()->avg('rating') ?? 0,
            1
        );
    }
}