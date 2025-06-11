<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

     <x-slot name="header">
        <h2 class="text-xl font-bold text-green-700">User Dashboard</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <p>Welcome {{ auth()->user()->name }}!</p>
        <p>Here you can book a seat and view your bookings.</p>
    </div>

    <div class="py-10 max-w-7xl mx-auto">
        <h3 class="text-lg font-semibold mb-4">Available Seats</h3>

        <ul class="space-y-4">
            @foreach($availableSeats as $seat)
                <li class="p-4 bg-white shadow rounded">
                    <strong>Seat #{{ $seat->seat_number }}</strong> – ₦{{ number_format($seat->price) }} <br>
                    Route: {{ $seat->from }} → {{ $seat->to }}<br>
                    Date: {{ \Carbon\Carbon::parse($seat->travel_date)->format('D, j M Y') }} <br>
                    <a href="#" class="text-blue-600 hover:underline">Buy Now</a>
                </li>
            @endforeach
        </ul>

        <div class="mt-6">
            {{ $availableSeats->links() }}
        </div>

        <h3 class="text-lg font-semibold mt-10 mb-4">Your Bookings</h3>
        @if($myBookings->count())
            <ul class="space-y-4">
                @foreach($myBookings as $booking)
                    <li class="p-4 bg-gray-100 rounded">
                        Booking #{{ $booking->id }} – Seat {{ $booking->seat_number }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600 italic">No bookings yet.</p>
        @endif
    </div>
</x-app-layout>
