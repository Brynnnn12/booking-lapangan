<x-layout.dashboard title="Create New Payment">
    <div class="container mx-auto px-4 py-8">
        <div class=" mx-auto bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Create New Payment</h1>

            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="booking_id" class="block text-sm font-medium text-gray-700">Booking</label>
                    <select name="booking_id" id="booking_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="">Pilih Booking</option>
                        @foreach (\App\Models\Booking::with(['user', 'field'])->get() as $booking)
                            <option value="{{ $booking->id }}"
                                {{ old('booking_id') == $booking->id ? 'selected' : '' }}>
                                #{{ $booking->id }} - {{ $booking->user->name }} - {{ $booking->field->name }}
                                ({{ $booking->booking_date->format('d M Y') }})
                            </option>
                        @endforeach
                    </select>
                    @error('booking_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="snap_token" class="block text-sm font-medium text-gray-700">Snap Token</label>
                    <input type="text" name="snap_token" id="snap_token" value="{{ old('snap_token') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('snap_token')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount (Rp)</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="">Pilih Status</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                        </option>
                        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid
                        </option>
                        <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('payments.index') }}"
                        class="mr-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create
                        Payment</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.dashboard>
