<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

     <x-slot name="header">
        <h2 class="text-xl font-bold text-blue-700">Admin Dashboard</h2>
    </x-slot>

    <div class="p-6 bg-white rounded shadow">
        <p>Welcome Admin, {{ auth()->user()->name }}!</p>
        <p>Here you can manage bookings, users, and exports.</p>
    </div>

    <div class="py-10 max-w-7xl mx-auto">
        <h3 class="text-lg font-semibold mb-4">All Posted Seats</h3>

        <table class="table-auto w-full text-left bg-white rounded shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Seat</th>
                    <th class="px-4 py-2">Route</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($seats as $seat)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $seat->seat_number }}</td>
                        <td class="px-4 py-2">{{ $seat->from }} → {{ $seat->to }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($seat->travel_date)->format('d M Y') }}</td>
                        <td class="px-4 py-2">{{ $seat->user->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ ucfirst($seat->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $seats->links() }}
        </div>
    </div>
</x-app-layout>
