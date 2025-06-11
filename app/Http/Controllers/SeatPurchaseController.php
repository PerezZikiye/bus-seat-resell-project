<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Wallet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SeatPurchaseController extends Controller
{
    public function buy($seat_id)
    {
        $seat = Seat::findOrFail($seat_id);
        $buyer = Auth::user();

        // Check seat validity
        if ($seat->is_sold || $seat->buyer_id || $seat->seller_id == $buyer->id) {
            return back()->with('error', 'Invalid seat transaction.');
        }

        // Check if buyer has at least ₦100
        if ($buyer->wallet->balance < 100) {
            return back()->with('error', 'Insufficient balance. Minimum ₦100 required to purchase a seat.');
        }

        DB::transaction(function () use ($seat, $buyer) {
            // Mark seat as sold
            $seat->buyer_id = $buyer->id;
            $seat->is_sold = true;
            $seat->save();

            // Deduct ₦100 from buyer's wallet
            $buyer->wallet->decrement('balance', 100);

            // Get seller and credit them price minus ₦100
            $seller = $seat->seller;
            if ($seller && $seller->wallet) {
                $seller->wallet->increment('balance', $seat->price - 100);
            }

            // Send WhatsApp notifications
            $this->notifyViaWhatsapp($seller->phone, "Your seat #{$seat->seat_number} has been sold. ₦" . ($seat->price - 100) . " has been credited to your wallet.");
            $this->notifyViaWhatsapp($buyer->phone, "You successfully purchased seat #{$seat->seat_number}. ₦100 has been deducted from your wallet.");
        });

        return redirect()->route('dashboard')->with('success', 'Seat purchased successfully!');
    }

    private function notifyViaWhatsapp($phone, $message)
    {
        // Replace with actual WA API endpoint and credentials
        Http::post('https://api.whatsapp.example.com/send', [
            'phone' => $phone,
            'message' => $message,
        ]);
    }
}
