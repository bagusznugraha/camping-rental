<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Rental;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PROFIL
    |--------------------------------------------------------------------------
    */

    public function edit(Request $request): View
    {
        $user = $request->user();

        $rentals = Rental::with([
            'payment',
            'rentalDetails.equipment',
            'reviews'
        ])
        ->where('user_id', $user->id)
        ->latest()
        ->get();

        return view('profile.edit', compact(
            'user',
            'rentals'
        ));
    }

    public function detailRental(\App\Models\Rental $rental)
   {
     if ($rental->user_id != auth()->id()) {
        abort(403);
    }

     $rental->load([
    'payment',
    'rentalDetails.equipment',
    'reviews'
]);

     return view('profile.detail', compact('rental'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFIL
    |--------------------------------------------------------------------------
    */

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS AKUN
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}