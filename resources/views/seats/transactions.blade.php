<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('My Transactions') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-6xl mx-auto space-y-10">
        <div>
            <h3 class="text-lg font-bold mb-3">Seats Bought</h3>
            @if($bought->count())
                <ul class="space-y-2">
                    @foreach($bought as $seat)
                        <li class="bg-gray-100 p-3 rounded">Seat #{{ $seat->seat_number }} — ₦{{ number_format($seat->price, 2) }}</li>
                    @endforeach
                </ul>
            @else
                <p>No seats bought.</p>
            @endif
        </div>

        <div>
            <h3 class="text-lg font-bold mb-3">Seats Sold</h3>
            @if($sold->count())
                <ul class="space-y-2">
                    @foreach($sold as $seat)
                        <li class="bg-green-100 p-3 rounded">Seat #{{ $seat->seat_number }} — ₦{{ number_format($seat->price, 2) }}</li>
                    @endforeach
                </ul>
            @else
                <p>No seats sold.</p>
            @endif
        </div>
    </div>
</x-app-layout>
    <footer class="bg-indigo-800 text-white text-center py-6">
        <div class="max-w-6xl mx-auto">
            <p class="text-sm">© {{ date('Y') }} Bus Seat Resell. All rights reserved.</p>
            <p class="text-xs mt-2">Made with ❤️ by Perezoft Infotech</p>
        </div>
    </footer>
