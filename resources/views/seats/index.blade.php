<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Available Seats for Purchase') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto">

        {{-- Travel Date Filter Preview --}}
        @if(request('start_date') || request('end_date'))
            <div class="mb-4 text-center text-lg font-semibold text-gray-800">
                Showing Travel Dates from
                <span class="text-blue-700">
                    {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('l, d M Y') : '...' }}
                </span>
                to
                <span class="text-blue-700">
                    {{ request('end_date') ? \Carbon\Carbon::parse(request('end_date'))->format('l, d M Y') : '...' }}
                </span>
            </div>
        @else
            <div class="mb-4 text-center text-lg font-semibold text-gray-800">
                All Upcoming Travel Dates (Today is {{ \Carbon\Carbon::now()->format('l, d M Y') }})
            </div>
        @endif

        {{-- Filter Form --}}
        <form method="GET" action="{{ route('seats.index') }}" class="mb-6 flex flex-col sm:flex-row flex-wrap gap-4 justify-center">
            <input type="text" name="from" placeholder="From..." value="{{ request('from') }}"
                   class="px-4 py-2 border border-gray-300 rounded">
            <input type="text" name="to" placeholder="To..." value="{{ request('to') }}"
                   class="px-4 py-2 border border-gray-300 rounded">
            <input type="date" name="start_date" value="{{ request('start_date') }}"
                   class="px-4 py-2 border border-gray-300 rounded">
            <input type="date" name="end_date" value="{{ request('end_date') }}"
                   class="px-4 py-2 border border-gray-300 rounded">

            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
        </form>

        {{-- Seats Table --}}
        @if ($seats->count())
            <div class="overflow-x-auto">
                <table class="w-full table-auto bg-white rounded shadow text-left text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">Seat No</th>
                            <th class="px-4 py-2">Price (₦)</th>
                            <th class="px-4 py-2">From</th>
                            <th class="px-4 py-2">To</th>
                            <th class="px-4 py-2">Posted By</th>
                            <th class="px-4 py-2">Departure Date</th>
                            <th class="px-4 py-2">Departure Time</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                   <tbody>
    @foreach ($seats as $seat)
        <tr class="border-t">
            <td class="px-4 py-2">{{ $seat->seat_number }}</td>
            <td class="px-4 py-2">{{ number_format($seat->price, 2) }}</td>
            <td class="px-4 py-2">{{ $seat->from }}</td>
            <td class="px-4 py-2">{{ $seat->to }}</td>
            <td class="px-4 py-2">{{ $seat->user->name ?? 'N/A' }}</td>
            {{-- Travel Date --}}
            <td>{{ \Carbon\Carbon::parse($seat->travel_date)->format('l, j F Y') }}</td> {{-- ✅ shows user-selected date --}}

            {{-- Travel Time --}}
            <td class="px-4 py-2">
                {{ $seat->travel_time ? \Carbon\Carbon::parse($seat->travel_time)->format('h:i A') : 'N/A' }}
            </td>

            {{-- Status --}}
            <td class="px-4 py-2">
                <span class="{{ $seat->status === 'available' ? 'text-green-600' : 'text-red-600' }}">
                    {{ ucfirst($seat->status) }}
                </span>
            </td>

            <td class="px-4 py-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Buy</a>
                @else
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register to Buy</a>
                @endauth

                {{--Buy Button--}}
                @auth
            @else
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register to Buy</a>
            @endauth
            </td>
        </tr>
    @endforeach
</tbody>

                </table>
            </div>

            <div class="mt-6">
                {{ $seats->withQueryString()->links() }}
            </div>
        @else
            <p class="text-gray-500 italic text-center">
                No seats match your filters. Try again with different criteria.
            </p>
        @endif
    </div>
</x-app-layout>

{{-- Footer --}}
<footer class="bg-indigo-800 text-white text-center py-6">
    <div class="max-w-6xl mx-auto">
        <p class="text-sm">© {{ date('Y') }} Bus Seat Resell. All rights reserved.</p>
        <p class="text-xs mt-2">Made with ❤️ by Perezoft Infotech</p>
    </div>
</footer>
