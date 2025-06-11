<x-app-layout>
    <x-slot name="header">
        {{ __('Fund Wallet') }}
    </x-slot>

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
</x-app-layout>
