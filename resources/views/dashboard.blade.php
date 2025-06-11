<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fund Wallet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex gap-6">


            {{-- Main Content --}}
            <main class="flex-1 bg-white p-6 rounded shadow-sm">
                @if(session('success'))
                    <div class="mb-4 text-green-600 font-semibold">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="mb-4 text-red-600 font-semibold">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('wallet.fund.process') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="amount" class="block font-medium text-sm text-gray-700">Amount (₦)</label>
                        <input id="amount" type="number" name="amount" min="1200"
                               class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                    </div>

                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                        Fund Wallet
                    </button>
                </form>
            </main>
        </div>
    </div>
</x-app-layout>

{{-- Footer --}}
<footer class="bg-indigo-800 text-white text-center py-6 mt-10">
    <div class="max-w-6xl mx-auto">
        <p class="text-sm">© {{ date('Y') }} Bus Seat Resell. All rights reserved.</p>
        <p class="text-xs mt-2">Made with ❤️ by Perezoft Infotech</p>
    </div>
</footer>


