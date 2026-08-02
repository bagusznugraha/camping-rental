<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Form Review
    |--------------------------------------------------------------------------
    */

    public function create(Rental $rental)
    {
        if ($rental->user_id != auth()->id()) {
            abort(403);
        }

        if ($rental->status != 'selesai') {
            return back()->with(
                'error',
                'Review hanya dapat diberikan setelah penyewaan selesai.'
            );
        }

        $review = Review::where('rental_id', $rental->id)
            ->where('user_id', auth()->id())
            ->first();

        return view('reviews.create', compact(
            'rental',
            'review'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Review
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, Rental $rental)
    {
        if ($rental->user_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $photo = null;

if($request->hasFile('photo')){

    $photo = time().'.'.$request->photo->extension();

    $request->photo->move(
        public_path('review'),
        $photo
    );

}

        Review::updateOrCreate(

    [
        'user_id' => auth()->id(),
        'rental_id' => $rental->id,
    ],

    [

        

        'rating' => $request->rating,

        'comment' => $request->comment,

        'photo' => $photo,

    ]

);

        return redirect()
            ->route('profile.edit')
            ->with(
                'success',
                'Terima kasih atas ulasan Anda.'
            );
    }
}