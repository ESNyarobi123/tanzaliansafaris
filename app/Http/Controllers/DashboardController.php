<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $bookings = Booking::with('package')->where('email', $user->email)->get();
        
        // Stats for trends analysis
        $stats = [
            'total_bookings' => $bookings->count(),
            'pending_bookings' => $bookings->where('status', 'pending')->count(),
            'confirmed_bookings' => $bookings->where('status', 'confirmed')->count(),
            'total_spent' => $bookings->where('status', 'confirmed')->sum(function($b) {
                return $b->package ? $b->package->price_amount : 0;
            }),
        ];

        return view('dashboard', compact('user', 'bookings', 'stats'));
    }
}
