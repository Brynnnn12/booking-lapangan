<x-layout.dashboard title="Create New Booking">
    <div class="container mx-auto px-4 py-8">
        <div class=" mx-auto bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Create New Booking</h1>

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="field_id" class="block text-sm font-medium text-gray-700">Field</label>
                    <select name="field_id" id="field_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="">Pilih Field</option>
                        @foreach (\App\Models\Field::all() as $field)
                            <option value="{{ $field->id }}" {{ old('field_id') == $field->id ? 'selected' : '' }}>
                                {{ $field->name }} - {{ $field->location }}
                            </option>
                        @endforeach
                    </select>
                    @error('field_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="booking_date" class="block text-sm font-medium text-gray-700">Tanggal Booking</label>
                    <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('booking_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        @error('start_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                        <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        @error('end_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="total_price" class="block text-sm font-medium text-gray-700">Total Harga (Rp)</label>
                    <input type="number" name="total_price" id="total_price" value="{{ old('total_price') }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('total_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                        <option value="">Pilih Status</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed
                        </option>
                        <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('bookings.index') }}"
                        class="mr-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create
                        Booking</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.dashboard>
