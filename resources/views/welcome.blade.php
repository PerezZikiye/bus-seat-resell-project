<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bus Seat Resell App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Figtree', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-indigo-700 to-blue-600 text-white py-20 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-3xl sm:text-5xl font-extrabold leading-tight mb-4">🚍 Bus Seat Resell App</h1>
            <p class="text-base sm:text-lg md:text-xl mb-6 max-w-3xl mx-auto">
                Instantly resell or purchase bus seats. Secure. Simple. Fast.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-white text-blue-700 font-semibold px-6 py-3 rounded shadow hover:bg-gray-200">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-blue-700 font-semibold px-6 py-3 rounded shadow hover:bg-gray-200">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded shadow">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </section>

    {{-- How It Works --}}
    <section class="py-16 px-4 bg-white text-center">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-bold mb-10">How It Works</h2>
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-2">1. Register & Fund Wallet</h3>
                    <p>Sign up and fund your wallet with ₦1,200 minimum to access seat listings.</p>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-2">2. List or Buy Seats</h3>
                    <p>List a seat for sale or buy one. Each transaction deducts ₦100 from buyer and seller.</p>
                </div>
                <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold mb-2">3. Get WhatsApp Alerts</h3>
                    <p>You'll receive instant WhatsApp notifications when a seat is successfully sold or bought.</p>
                </div>
            </div>
        </div>
    </section>

        {{-- Seat Listings Preview --}}
    <section class="py-16 px-4 bg-gray-50 text-center">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-bold mb-6">Available Seats (Preview)</h2>
            <p class="text-gray-600 mb-4">Real-time seats posted by verified sellers will appear here.</p>

            @if ($seats->count())
                <div class="overflow-x-auto">
                    <table class="w-full table-auto bg-white rounded shadow text-left text-sm">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2">Seat No</th>
                                <th class="px-4 py-2">Price (₦)</th>
                                <th class="px-4 py-2">From</th>
                                <th class="px-4 py-2">To</th>
                                <th class="px-4 py-2">Departure Date</th>
                                <th class="px-4 py-2">Departure Time</th>
                                <th class="px-4 py-2">Posted By</th>
                                <th class="px-4 py-2">Date</th>
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

    {{-- Travel Date --}}
    <td>{{ \Carbon\Carbon::parse($seat->travel_date)->format('l, j F Y') }}</td> {{-- ✅ shows user-selected date --}}

    {{-- Travel Time --}}
    <td class="px-4 py-2">
        {{ $seat->travel_time ? \Carbon\Carbon::parse($seat->travel_time)->format('h:i A') : 'N/A' }}
    </td>

    {{-- Posted By --}}
    <td class="px-4 py-2">{{ $seat->user->name ?? 'N/A' }}</td>

    {{-- Posted On --}}
    <td class="px-4 py-2">{{ $seat->created_at->format('d M, Y') }}</td>

    {{-- Action --}}
    <td class="px-4 py-2">
        @auth
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Buy</a>
        @else
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register to Buy</a>
        @endauth
    </td>
</tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 italic">No seats available at the moment. Check back soon!</p>
            @endif
        </div>
    </section>


    {{-- Benefits Section --}}


    {{-- FAQs --}}
    <section class="py-16 px-4 bg-white text-center">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-bold mb-8">Frequently Asked Questions</h2>
            <div class="space-y-8 text-left">
                <div>
                    <h4 class="font-semibold text-lg">💳 How do I fund my wallet?</h4>
                    <p>Go to your dashboard and click “Fund Wallet”. Minimum amount is ₦1,200.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-lg">🔄 Can I resell any type of seat?</h4>
                    <p>Yes, any valid intercity or regional seat can be resold if it’s not used.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-lg">📲 Do I get notified?</h4>
                    <p>Yes, you’ll receive WhatsApp alerts on every successful transaction.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-indigo-800 text-white text-center py-6">
        <div class="max-w-7xl mx-auto px-4">
             <div class="max-w-6xl mx-auto">
            <p class="text-sm">© {{ date('Y') }} Bus Seat Resell. All rights reserved.</p>
            <p class="text-xs mt-2">Made with ❤️ by Perezoft Infotech</p>
        </div>
            <p class="text-sm mt-2">
                📞 Contact us on
                <a href="https://wa.me/2347068107476" class="underline text-green-300 hover:text-green-100" target="_blank">
                    WhatsApp
                </a>
            </p>
        </div>
    </footer>

</body>
</html>
