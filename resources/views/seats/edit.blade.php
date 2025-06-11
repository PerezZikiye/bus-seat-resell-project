<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Edit Seat') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
            <form action="{{ route('seats.update', $seat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="seat_number" class="block text-gray-700">Seat Number</label>
                    <input type="text" name="seat_number" value="{{ old('seat_number', $seat->seat_number) }}" class="w-full mt-1 p-2 border rounded">
                    @error('seat_number') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700">Price (₦)</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $seat->price) }}" class="w-full mt-1 p-2 border rounded">
                    @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Update Seat
                    </button>
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
