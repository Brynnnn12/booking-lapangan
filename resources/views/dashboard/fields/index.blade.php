<x-layout.dashboard title="Manajemen Fields">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Fields</h3>
            <x-ui.button variant="primary" icon="fas fa-plus" onclick="location.href='{{ route('fields.create') }}'">
                Tambah Field
            </x-ui.button>
        </x-slot>


        <!-- Fields Table -->
        <x-table.table :headers="['ID', 'Nama', 'Lokasi', 'Harga/Jam', 'Foto', 'Actions']" striped hover>
            @forelse($fields as $field)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $field->id }}
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

                <!-- Sweet Confirm & Modal Components -->
                <x-ui.sweet-confirm title="Hapus Field?"
                    text="Apakah Anda yakin ingin menghapus field '{{ $field->name }}'? Aksi ini tidak bisa dibatalkan!"
                    confirm-text="Ya, Hapus" cancel-text="Batal" icon="warning"
                    action="{{ route('fields.destroy', $field) }}" method="DELETE" :params="['id' => $field->id]" />

                <x-ui.sweet-modal title="Detail Field: {{ $field->name }}"
                    function-name="showFieldModal{{ $field->id }}" width="600" :show-cancel-button="false"
                    confirm-text="Tutup">
                    <!-- Field Header -->
                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $field->name }}</h3>
                        <div class="flex flex-wrap gap-3">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-map-marker-alt mr-2"></i>{{ $field->location }}
                            </span>
                            <span class="text-sm text-gray-500 flex items-center">
                                <i class="fas fa-calendar-alt mr-1"></i>Dibuat:
                                {{ $field->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Field Price -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-money-bill-wave mr-2 text-green-600"></i>Harga per Jam
                        </h4>
                        <div class="bg-green-50 rounded-lg p-4">
                            <p class="text-2xl font-bold text-green-700">
                                Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Field Photo -->
                    @if ($field->photo)
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-image mr-2 text-blue-600"></i>Foto Field
                            </h4>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <img src="{{ asset('storage/' . $field->photo) }}" alt="Field Photo"
                                    class="w-full h-48 object-cover rounded-lg shadow-sm">
                            </div>
                        </div>
                    @endif

                    <!-- Field Meta Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-blue-900 mb-2 flex items-center">
                                <i class="fas fa-hashtag mr-1"></i>ID Field
                            </h5>
                            <p class="text-blue-700 font-semibold">#{{ $field->id }}</p>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-purple-900 mb-2 flex items-center">
                                <i class="fas fa-clock mr-1"></i>Terakhir Update
                            </h5>
                            <p class="text-purple-700">{{ $field->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button onclick="location.href='{{ route('fields.edit', $field) }}'"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <i class="fas fa-edit mr-2"></i>Edit Field
                            </button>
                            <button onclick="Swal.close(); sweetConfirm{{ $field->id }}()"
                                class="inline-flex items-center justify-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <i class="fas fa-trash mr-2"></i>Hapus Field
                            </button>
                        </div>
                    </div>
                </x-ui.sweet-modal>
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

        <!-- Pagination -->
        <div class="mt-6">
            {{ $fields->links('vendor.pagination.tailwind') }}
        </div>

    </x-ui.card>
</x-layout.dashboard>
