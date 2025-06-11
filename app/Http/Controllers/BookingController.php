<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        // Get all bookings for the authenticated user
        $bookings = Booking::where('user_id', Auth::id())->latest()->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $locations = [
            'Nigerdelta University (Wilberforce Island)',
            'Igbogene 1',
            'Igbogene 2',
            'Law faculty (criss cross)',
            'Law faculty (inside town 1)',
            'Law faculty (inside town 2)',
            'Law faculty (Express)',
            'Law faculty (Intervention express line)',
        ];

        return view('bookings.create', compact('locations'));
    }

    public function store(Request $request)
{
    $request->validate([
        'from' => 'required|string',
        'to' => 'required|string',
        'travel_date' => 'required|date',
        'travel_time' => 'required',
        'seats' => 'required|integer|min:1',
        'amount' => 'required|numeric|min:1',
    ]);

    Booking::create([
        'user_id' => auth()->id(),
        'from' => $request->from,
        'to' => $request->to,
        'travel_date' => $request->travel_date,
        'travel_time' => $request->travel_time,
        'seats' => $request->seats,
        'amount' => $request->amount,
        'status' => 'pending',
    ]);

    return redirect()->route('bookings.index')->with('success', 'Booking created! Proceed to payment.');
}


    public function payment($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.payment', compact('booking'));
    }
}
