<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $seats = Seat::latest()->paginate(10);
            return view('dashboard.admin', compact('seats'));
        }

        if ($user->isBuyer()) {
            $availableSeats = Seat::where('status', 'available')->latest()->paginate(10);
            $myBookings = $user->bookings()->latest()->paginate(5);
            return view('dashboard.buyer', compact('availableSeats', 'myBookings'));
        }

        // Default fallback for any other roles
        return view('dashboard.general');
    }
}
