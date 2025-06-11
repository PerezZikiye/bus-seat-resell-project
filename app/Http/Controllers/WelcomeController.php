<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;

class WelcomeController extends Controller
{
    public function index()
    {
        $seats = Seat::where('is_sold', false)
                     ->latest()
                     ->take(5)
                     ->get();

        return view('welcome', compact('seats'));
    }
}
// This controller fetches the latest unsold seats and passes them to the welcome view.
// You can customize the number of seats displayed by changing the `take(5)` method.
// Make sure to create a corresponding view file at `resources/views/welcome.blade.php`
// to display the seats as per your design requirements.
