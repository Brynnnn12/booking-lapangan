<x-layout.dashboard title="Edit Field">
    <div class="container mx-auto px-4 py-8">
        <div class=" mx-auto bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Field</h1>

            <form action="{{ route('fields.update', $field) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $field->name) }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $field->location) }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price_per_hour" class="block text-sm font-medium text-gray-700">Price per Hour
                        (Rp)</label>
                    <input type="number" name="price_per_hour" id="price_per_hour"
                        value="{{ old('price_per_hour', $field->price_per_hour) }}"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @error('price_per_hour')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                    @if ($field->photo)
                        <img src="{{ asset('storage/' . $field->photo) }}" alt="Current Photo"
                            class="w-16 h-16 object-cover rounded mb-2">
                    @endif
                    <input type="file" name="photo" id="photo"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        accept="image/*">
                    @error('photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('fields.index') }}"
                        class="mr-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update
                        Field</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.dashboard>
