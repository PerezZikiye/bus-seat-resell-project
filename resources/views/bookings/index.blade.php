<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-blue-800">My Bookings</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6 p-6 bg-white rounded shadow">
        @if($bookings->count())
            <table class="w-full text-sm text-left border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">From</th>
                        <th class="p-2">To</th>
                        <th class="p-2">Date</th>
                        <th class="p-2">Time</th>
                        <th class="p-2">Seats</th>
                        <th class="p-2">Amount</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr class="border-t">
                            <td class="p-2">{{ $booking->from }}</td>
                            <td class="p-2">{{ $booking->to }}</td>
                            <td class="p-2">{{ \Carbon\Carbon::parse($booking->travel_date)->format('l, d M Y') }}</td>
                            <td class="p-2">{{ \Carbon\Carbon::parse($booking->travel_time)->format('h:i A') }}</td>
                            <td class="p-2">{{ $booking->seats }}</td>
                            <td class="p-2">₦{{ number_format($booking->amount, 2) }}</td>
                            <td class="p-2">{{ ucfirst($booking->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $bookings->links() }}
            </div>
        @else
            <p class="text-gray-600 italic">You have no bookings yet.</p>
        @endif
    </div>
</x-app-layout>
