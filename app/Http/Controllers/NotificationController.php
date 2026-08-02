<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function read(Notification $notification)
    {
        if ($notification->user_id != auth()->id()) {
            abort(403);
        }

        $notification->update([
            'is_read' => true,
        ]);

        if ($notification->rental_id) {
            return redirect()->route('profile.rental.detail', $notification->rental_id);
        }

        return redirect()->route('notifications.index');
    }

    public function readAll()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        return back()->with(
            'success',
            'Semua notifikasi telah dibaca.'
        );
    }
}