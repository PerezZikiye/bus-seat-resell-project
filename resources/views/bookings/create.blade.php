<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-blue-800">Book a Seat</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow mt-6">

        <p class="mb-4">Welcome, {{ auth()->user()->name }}! Please fill out the booking form below.</p>
        <!-- Autofill price -->
        @php
            $pricePerSeat = 1000;
        @endphp


        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf

            {{-- From --}}
            <div class="mb-4">
                <label for="from" class="block text-sm font-medium text-gray-700 mb-1">From:</label>
                <select name="from" id="from" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500">
                    @foreach($locations as $location)
                        <option value="{{ $location }}">{{ $location }}</option>
                    @endforeach
                </select>
            </div>

            {{-- To --}}
            <div class="mb-4">
                <label for="to" class="block text-sm font-medium text-gray-700 mb-1">To:</label>
                <select name="to" id="to" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500">
                    @foreach($locations as $location)
                        <option value="{{ $location }}">{{ $location }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Travel Date --}}
            <div class="mb-4">
                <label for="travel_date" class="block text-sm font-medium text-gray-700 mb-1">Travel Date:</label>
                <input type="date" name="travel_date" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required>
            </div>

            {{-- Travel Time --}}
            <div class="mb-4">
                <label for="travel_time" class="block text-sm font-medium text-gray-700 mb-1">Travel Time:</label>
                <input type="time" name="travel_time" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required>
            </div>

            <!-- Number of Seats -->
            <div class="mb-4">
                <label for="seats">Number of Seats:</label>
                <input type="number" name="seats" id="seats" value="1" min="1" max="10"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" required>
            </div>

            <!-- Amount (Calculated) -->
            <div class="mb-4">
                <label for="amount">Amount (₦):</label>
                <input type="number" id="amount" name="amount"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-500"
                    value="{{ $pricePerSeat }}" readonly required>
            </div>

            {{-- User ID --}}


            {{-- Submit --}}
            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition duration-200">
                    Proceed to Payment
                </button>
            </div>
        </form>
       @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const seatInput = document.getElementById('seats');
        const amountInput = document.getElementById('amount');
        const pricePerSeat = {{ $pricePerSeat }};

        function updateAmount() {
            const seats = parseInt(seatInput.value) || 1;
            const total = seats * pricePerSeat;
            amountInput.value = total;
        }

        seatInput.addEventListener('input', updateAmount);
        updateAmount(); // initialize on load
    });
</script>
@endpush


    </div>
</x-app-layout>
