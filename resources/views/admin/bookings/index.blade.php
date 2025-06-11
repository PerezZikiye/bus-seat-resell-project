<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-blue-800">All Bookings</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <div class="mb-4 flex gap-4">
            <a href="{{ route('admin.bookings.export.csv') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Export CSV</a>
            <a href="{{ route('admin.bookings.export.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Export PDF</a>
        </div>

        <table class="w-full text-left table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-sm">
                    <th class="px-4 py-2 border">User</th>
                    <th class="px-4 py-2 border">From</th>
                    <th class="px-4 py-2 border">To</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Time</th>
                    <th class="px-4 py-2 border">Seats</th>
                    <th class="px-4 py-2 border">Amount</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr class="border-b text-sm">
                        <td class="px-4 py-2">{{ $booking->user->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $booking->from }}</td>
                        <td class="px-4 py-2">{{ $booking->to }}</td>
                        <td class="px-4 py-2">{{ $booking->travel_date }}</td>
                        <td class="px-4 py-2">{{ $booking->travel_time }}</td>
                        <td class="px-4 py-2">{{ $booking->seats }}</td>
                        <td class="px-4 py-2">₦{{ number_format($booking->amount, 2) }}</td>
                        <td class="px-4 py-2">{{ ucfirst($booking->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
