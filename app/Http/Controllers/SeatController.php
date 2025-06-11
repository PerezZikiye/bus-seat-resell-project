<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SeatController extends Controller
{
    // Show all available seats for purchase
public function index(Request $request)
{
    $query = Seat::query();

    if ($request->filled('from')) {
        $query->where('from', 'like', '%' . $request->from . '%');
    }

    if ($request->filled('to')) {
        $query->where('to', 'like', '%' . $request->to . '%');
    }

    if ($request->filled('start_date')) {
        $query->whereDate('travel_date', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('travel_date', '<=', $request->end_date);
    }

    $seats = $query->orderBy('travel_date', 'asc')->paginate(10);

    return view('seats.index', compact('seats'));
}



     // Show user transactions
    public function transactions()
    {
        $user = Auth::user();

        $bought = Seat::where('buyer_id', $user->id)->get();
        $sold = Seat::where('seller_id', $user->id)->get();

        return view('seats.transactions', compact('bought', 'sold'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seats.create');
    }

    // Buy a seat
    public function buy(Seat $seat)
{
    if ($seat->status !== 'available') {
        return back()->with('error', 'Seat is already sold.');
    }

    // (Optionally) check buyer's wallet balance here

    $seat->update(['status' => 'sold']);

    return redirect('/dashboard')->with('success', 'You bought the seat!');
}

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
    {
        $request->validate([
        'seat_number' => 'required',
        'price' => 'required|numeric',
        'from' => 'required|string',
        'to' => 'required|string',
        'travel_date' => 'required|date',
        'travel_time' => 'required',
    ]);

  Seat::create([
        'seat_number' => $request->seat_number,
        'price' => $request->price,
        'from' => $request->from,
        'to' => $request->to,
        'travel_date' => $request->travel_date, // ✅ save correct travel date
        'date' => now(), // or remove this if redundant
        'travel_time' => $request->travel_time,
        'user_id' => auth()->id(),
        'status' => 'available',
    ]);

        return redirect()->route('seats.index')->with('success', 'Seat posted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $seat = Seat::findOrFail($id);

    // Optional: ensure only the owner can edit
    if ($seat->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('seats.edit', compact('seat'));
}


    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $seat = Seat::findOrFail($id);

    if ($seat->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'seat_number' => 'required|string|max:20',
        'price' => 'required|numeric|min:100',
    ]);

    $seat->update([
        'seat_number' => $request->seat_number,
        'price' => $request->price,
    ]);

    return redirect()->route('dashboard')->with('success', 'Seat updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $seat = Seat::findOrFail($id);

    if ($seat->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $seat->delete();

    return redirect()->route('dashboard')->with('success', 'Seat deleted successfully.');
}

}
