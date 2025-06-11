<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-blue-800">Complete Your Payment</h2>
    </x-slot>

    <div class="max-w-lg mx-auto p-6 bg-white mt-6 rounded shadow">
        <p class="mb-4">Hi {{ auth()->user()->name }}, please complete payment to confirm your seat(s).</p>

        <ul class="mb-4">
            <li><strong>From:</strong> {{ $booking->from }}</li>
            <li><strong>To:</strong> {{ $booking->to }}</li>
            <li><strong>Date:</strong> {{ $booking->travel_date }}</li>
            <li><strong>Time:</strong> {{ $booking->travel_time }}</li>
            <li><strong>Seats:</strong> {{ $booking->seats }}</li>
            <li><strong>Total Amount:</strong> ₦{{ number_format($booking->amount, 2) }}</li>
        </ul>

        <a href="https://paystack.com/pay/sample-link" target="_blank"
           class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            Pay with Paystack
        </a>
    </div>
</x-app-layout>
