{{-- resources/views/seats/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create a Seat</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('seats.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">Seat Number</label>
                        <input type="text" name="seat_number" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">Price (₦)</label>
                        <input type="number" name="price" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">From</label>
                        <input type="text" name="from" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-1">To</label>
                        <input type="text" name="to" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="travel_date">Travel Date</label>
                        <input type="date" name="travel_date" class="w-full border border-gray-300 rounded px-3 py-2" id="travel_date" required>

                    </div>

                    <div class="mb-4">
                        <label for="travel_time" class="block text-sm font-medium text-gray-700">Travel Time</label>
                        <input type="time" name="travel_time" id="travel_time"
                            class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 shadow-sm"
                            value="{{ old('travel_time') }}">
                    </div>



                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Post Seat
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<footer class="bg-indigo-800 text-white text-center py-6">
    <div class="max-w-6xl mx-auto">
        <p class="text-sm">© {{ date('Y') }} Bus Seat Resell. All rights reserved.</p>
        <p class="text-xs mt-2">Made with ❤️ by Perezoft Infotech</p>
    </div>
</footer>
{{-- This is the footer section of the page --}}
