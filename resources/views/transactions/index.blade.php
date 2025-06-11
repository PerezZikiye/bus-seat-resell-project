<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Wallet Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-5xl mx-auto">
        @if($transactions->count())
            <div class="overflow-x-auto">
                <table class="w-full table-auto bg-white rounded shadow text-left text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">Type</th>
                            <th class="px-4 py-2">Amount (₦)</th>
                            <th class="px-4 py-2">From</th>
                            <th class="px-4 py-2">To</th>
                            <th class="px-4 py-2">Seat No</th>
                            <th class="px-4 py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $txn)
                            <tr class="border-t">
                                <td class="px-4 py-2 capitalize {{ $txn->type == 'credit' ? 'text-green-700' : 'text-red-700' }}">
                                    {{ $txn->type }}
                                </td>
                                <td class="px-4 py-2">₦{{ number_format($txn->amount, 2) }}</td>
                                <td class="px-4 py-2">{{ $txn->buyer->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $txn->seller->name ?? 'N/A' }}</td>
                                <td class="px-4 py-2">#{{ $txn->seat->seat_number ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $txn->created_at->format('d M, Y h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        @else
            <p class="text-gray-600 italic">No transactions found.</p>
        @endif
    </div>
</x-app-layout>

<footer class="bg-gray-100 text-center py-4 mt-10">
    <p class="text-sm text-gray-600">© {{ date('Y') }} Bus Seat Resell. All rights reserved.</p>
</footer>
