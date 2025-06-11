<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="min-h-screen flex flex-col">

        <!-- Top Navbar -->
        @include('layouts.navigation')

        <main class="flex flex-1 py-8 px-4 sm:px-6 lg:px-8">
            <div class="flex w-full max-w-7xl mx-auto space-x-6">

                <!-- Sidebar -->
                <x-sidebar />




                <!-- Page Content -->
                <div class="flex-1">
                    @if (isset($header))
                        <header class="mb-6">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $header }}
                            </h2>
                        </header>
                    @endif

                    <div class="bg-white shadow-sm rounded p-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-indigo-800 text-white text-center py-6 mt-10">
            <div class="max-w-6xl mx-auto">
                <p class="text-sm">© {{ date('Y') }} Bus Seat Resell. All rights reserved.</p>
                <p class="text-xs mt-2">Made with ❤️ by Perezoft Infotech</p>
            </div>
        </footer>
    </div>
      @stack('scripts')
</body>
</html>
