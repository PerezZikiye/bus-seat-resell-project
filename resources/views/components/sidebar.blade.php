@php
    $user = Auth::user();
@endphp

<aside class="w-64 bg-blue-50 dark:bg-gray-800 p-4 rounded shadow-md">
    <div class="mb-6 text-center">
      <!--  <img src="{{ asset('images/logo.png') }}" alt="Bus Seat Resell Logo" class="w-24 h-24 mx-auto mb-2"> -->
        <p class="text-sm text-blue-700 dark:text-gray-300">Welcome, {{ $user->name }}!</p>
    </div>
    <nav class="space-y-4">
        <a href="{{ route('dashboard') }}"
           class="block font-semibold px-3 py-2 rounded
           {{ request()->routeIs('dashboard') ? 'bg-blue-200 text-blue-900' : 'text-blue-800 hover:text-blue-600' }}">
            🏠 Dashboard
        </a>

        <a href="{{ route('seats.index') }}"
           class="block font-semibold px-3 py-2 rounded
           {{ request()->routeIs('seats.index') ? 'bg-blue-200 text-blue-900' : 'text-blue-800 hover:text-blue-600' }}">
            🎫 View Seats
        </a>

        <a href="{{ route('seats.create') }}"
           class="block font-semibold px-3 py-2 rounded
           {{ request()->routeIs('seats.create') ? 'bg-blue-200 text-blue-900' : 'text-blue-800 hover:text-blue-600' }}">
            ➕ Sell Seat
        </a>

        <!-- Booking Link -->
<li>
    <a href="{{ route('bookings.create') }}"
       class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded
              {{ request()->routeIs('bookings.create') ? 'bg-blue-100 font-bold text-blue-800' : '' }}">
        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 10h1l1 9h14l1-9h1M5 6h14v4H5z"/>
        </svg>
        Book a Seat
    </a>
</li>


        <a href="{{ route('wallet.fund') }}"
           class="block font-semibold px-3 py-2 rounded
           {{ request()->routeIs('wallet.fund') ? 'bg-blue-200 text-blue-900' : 'text-blue-800 hover:text-blue-600' }}">
            💰 Fund Wallet
        </a>

        @if(Route::has('profile.show'))
            <a href="{{ route('profile.show') }}"
               class="block font-semibold px-3 py-2 rounded
               {{ request()->routeIs('profile.show') ? 'bg-blue-200 text-blue-900' : 'text-blue-800 hover:text-blue-600' }}">
                👤 Profile
            </a>
        @endif

        <!-- Show this link only to admin -->
        @if($user->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               class="block font-semibold px-3 py-2 rounded
               {{ request()->routeIs('admin.dashboard') ? 'bg-blue-200 text-blue-900' : 'text-blue-800 hover:text-blue-600' }}">
                🛠 Admin Panel
            </a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full text-left font-semibold px-3 py-2 rounded
                    text-blue-800 hover:text-blue-600">
                🚪 Logout
            </button>
        </form>
    </nav>
</aside>

