<x-layout.dashboard title="Manajemen Fields">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Fields</h3>
            <x-ui.button variant="primary" icon="fas fa-plus" onclick="location.href='{{ route('fields.create') }}'">
                Tambah Field
            </x-ui.button>
        </x-slot>


        <!-- Fields Table -->
        <x-table.table :headers="['No', 'Nama', 'Lokasi', 'Harga/Jam', 'Foto', 'Aksi']" striped hover>
            @forelse($fields as $field)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $field->name }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $field->location }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($field->photo)
                            <img src="{{ asset('storage/' . $field->photo) }}" alt="Field Photo"
                                class="w-12 h-12 object-cover rounded">
                        @else
                            <span class="text-gray-400 text-sm">No Photo</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <x-ui.button size="xs" variant="outline" icon="fas fa-eye"
                                onclick="showFieldModal{{ $field->id }}()">
                                View
                            </x-ui.button>
                            <x-ui.button size="xs" variant="outline" icon="fas fa-edit"
                                onclick="location.href='{{ route('fields.edit', $field) }}'">
                                Edit
                            </x-ui.button>
                            <x-ui.button size="xs" variant="danger" icon="fas fa-trash"
                                onclick="sweetConfirm{{ $field->id }}()">
                                Delete
                            </x-ui.button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-futbol text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium">Belum ada field</p>
                            <p class="mt-2 mb-4">Mulai dengan membuat field pertama Anda</p>
                            <x-ui.button variant="primary" icon="fas fa-plus"
                                onclick="location.href='{{ route('fields.create') }}'">
                                Buat Field Pertama
                            </x-ui.button>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-table.table>

        <!-- Sweet Confirm & Modal Components -->
        @forelse($fields as $field)
            <x-ui.sweet-confirm title="Hapus Field?"
                text="Apakah Anda yakin ingin menghapus field '{{ $field->name }}'? Aksi ini tidak bisa dibatalkan!"
                confirm-text="Ya, Hapus" cancel-text="Batal" icon="warning"
                action="{{ route('fields.destroy', $field) }}" method="DELETE" :params="['id' => $field->id]" />

            <x-ui.sweet-modal title="Detail Field: {{ $field->name }}"
                function-name="showFieldModal{{ $field->id }}" width="500" :show-cancel-button="false"
                confirm-text="Tutup">
                <div class="space-y-4">
                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $field->name }}</h3>
                        <span class="text-sm text-gray-500">{{ $field->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                        <span class="text-sm text-gray-700">{{ $field->location }}</span>
                    </div>

                    <!-- Price -->
                    <div class="bg-green-50 p-3 rounded-lg">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="fas fa-money-bill-wave text-green-600"></i>
                            <span class="text-sm font-medium text-gray-900">Harga per Jam</span>
                        </div>
                        <p class="text-xl font-bold text-green-700">Rp
                            {{ number_format($field->price_per_hour, 0, ',', '.') }}</p>
                    </div>

                    <!-- Photo -->
                    @if ($field->photo)
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-image text-blue-600"></i>
                                <span class="text-sm font-medium text-gray-900">Foto Field</span>
                            </div>
                            <img src="{{ asset('storage/' . $field->photo) }}" alt="Field Photo"
                                class="w-full h-32 object-cover rounded-lg">
                        </div>
                    @endif

                    <!-- Meta -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <div class="flex items-center gap-1 mb-1">
                                <i class="fas fa-hashtag text-blue-600"></i>
                                <span class="text-xs font-medium text-blue-900">ID</span>
                            </div>
                            <p class="text-blue-700 font-semibold">#{{ $field->id }}</p>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-lg">
                            <div class="flex items-center gap-1 mb-1">
                                <i class="fas fa-clock text-purple-600"></i>
                                <span class="text-xs font-medium text-purple-900">Update</span>
                            </div>
                            <p class="text-purple-700 text-sm">{{ $field->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Aksi -->
                    <div class="flex gap-2 pt-3 border-t">
                        <button onclick="location.href='{{ route('fields.edit', $field) }}'"
                            class="flex-1 px-3 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </button>
                        <button onclick="Swal.close(); sweetConfirm{{ $field->id }}()"
                            class="flex-1 px-3 py-2 border border-red-300 text-red-700 text-sm rounded-md hover:bg-red-50">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                    </div>
                </div>
            </x-ui.sweet-modal>
        @empty
        @endforelse

        <!-- Pagination -->
        <div class="mt-6">
            {{ $fields->links('vendor.pagination.tailwind') }}
        </div>

    </x-ui.card>
</x-layout.dashboard>
