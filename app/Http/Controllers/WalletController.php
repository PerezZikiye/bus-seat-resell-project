<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    public function showFundForm()
    {
        return view('wallet.fund');
    }

    public function processFund(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1200',
        ]);

        $user = Auth::user();
        $tx_ref = 'TX-' . strtoupper(Str::random(10)); // unique transaction reference
        $amount = $request->amount;

        // Flutterwave sandbox redirect
        $redirectUrl = route('wallet.fund.callback');

        $paymentData = [
            'tx_ref' => $tx_ref,
            'amount' => $amount,
            'currency' => 'NGN',
            'redirect_url' => $redirectUrl,
            'customer' => [
                'email' => $user->email,
                'name' => $user->name,
            ],
            'customizations' => [
                'title' => 'Fund Wallet',
                'description' => 'Add funds to your wallet',
            ],
        ];

        // Redirect to Flutterwave hosted payment
        $paymentUrl = "https://checkout.flutterwave.com/v3/hosted/pay?" . http_build_query(['tx_ref' => $tx_ref]);

        session([
            'payment_tx_ref' => $tx_ref,
            'payment_amount' => $amount,
        ]);

        return redirect()->away($paymentUrl);
    }

    public function paymentCallback(Request $request)
    {
        $tx_ref = $request->get('tx_ref');
        $status = $request->get('status');

        if ($status === 'successful' && $tx_ref === session('payment_tx_ref')) {
            // Update user wallet here
            $user = Auth::user();
            $amount = session('payment_amount');

            // You can store to a wallet_transactions table (optional)
            $user->wallet_balance += $amount;
            $user->save();

            session()->forget(['payment_tx_ref', 'payment_amount']);

            return redirect()->route('wallet.fund')->with('success', 'Wallet funded successfully!');
        }

        return redirect()->route('wallet.fund')->with('error', 'Payment failed or cancelled.');
    }
}
