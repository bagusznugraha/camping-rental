<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipment';

    protected $fillable = [
        'category_id',
        'name',
        'stock',
        'rent_count',
        'price',
        'description',
        'specification',
        'watt',
        'image',
        'total_unit',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    // Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Detail penyewaan
    public function rentalDetails()
    {
        return $this->hasMany(RentalDetail::class);
    }

    // Review pelanggan
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor
    |--------------------------------------------------------------------------
    */

    // Jumlah pelanggan yang pernah menyewa
    public function getTotalRenterAttribute()
    {
        return $this->rentalDetails()
            ->distinct('rental_id')
            ->count('rental_id');
    }

    // Rata-rata rating
    public function getAverageRatingAttribute()
    {
        return round(
            $this->reviews()->avg('rating') ?? 0,
            1
        );
    }

    // Jumlah review
    public function getReviewCountAttribute()
    {
        return $this->reviews()->count();
    }

    // Total bintang
    public function getTotalStarAttribute()
    {
        return $this->reviews()->sum('rating');
    }

    // Persentase rating (0-100%)
    public function getRatingPercentAttribute()
    {
        if ($this->review_count == 0) {
            return 0;
        }

        return ($this->average_rating / 5) * 100;
    }
}