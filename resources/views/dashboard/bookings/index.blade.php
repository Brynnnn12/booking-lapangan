<x-layout.dashboard title="Manajemen Bookings">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Bookings</h3>
            <x-ui.button variant="primary" icon="fas fa-plus" onclick="location.href='{{ route('bookings.create') }}'">
                Tambah Booking
            </x-ui.button>
        </x-slot>

        <!-- Bookings Table -->
        <x-table.table :headers="[
            'ID',
            'User',
            'Field',
            'Tanggal',
            'Waktu Mulai',
            'Waktu Selesai',
            'Total Harga',
            'Status',
            'Actions',
        ]" striped hover>
            @forelse($bookings as $booking)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $booking->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $booking->user->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $booking->field->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $booking->booking_date->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $booking->start_time }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $booking->end_time }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($booking->status == 'pending')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @elseif($booking->status == 'confirmed')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Confirmed
                            </span>
                        @elseif($booking->status == 'canceled')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Canceled
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <x-ui.button size="xs" variant="outline" icon="fas fa-eye"
                                onclick="showBookingModal{{ $booking->id }}()">
                                View
                            </x-ui.button>
                            <x-ui.button size="xs" variant="outline" icon="fas fa-edit"
                                onclick="location.href='{{ route('bookings.edit', $booking) }}'">
                                Edit
                            </x-ui.button>
                            <x-ui.button size="xs" variant="danger" icon="fas fa-trash"
                                onclick="sweetConfirm{{ $booking->id }}()">
                                Delete
                            </x-ui.button>
                        </div>
                    </td>
                </tr>

                <!-- Sweet Confirm & Modal Components -->
                <x-ui.sweet-confirm title="Hapus Booking?"
                    text="Apakah Anda yakin ingin menghapus booking '{{ $booking->field->name }}' pada {{ $booking->booking_date->format('d M Y') }}? Aksi ini tidak bisa dibatalkan!"
                    confirm-text="Ya, Hapus" cancel-text="Batal" icon="warning"
                    action="{{ route('bookings.destroy', $booking) }}" method="DELETE" :params="['id' => $booking->id]" />

                <x-ui.sweet-modal title="Detail Booking: {{ $booking->field->name }}"
                    function-name="showBookingModal{{ $booking->id }}" width="600" :show-cancel-button="false"
                    confirm-text="Tutup">
                    <!-- Booking Header -->
                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $booking->field->name }}</h3>
                        <div class="flex flex-wrap gap-3">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-user mr-2"></i>{{ $booking->user->name }}
                            </span>
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-calendar-alt mr-2"></i>{{ $booking->booking_date->format('d M Y') }}
                            </span>
                            <span class="text-sm text-gray-500 flex items-center">
                                <i class="fas fa-clock mr-1"></i>Dibuat:
                                {{ $booking->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Booking Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-blue-900 mb-2 flex items-center">
                                <i class="fas fa-clock mr-1"></i>Waktu Mulai
                            </h5>
                            <p class="text-blue-700 font-semibold">{{ $booking->start_time }}</p>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-purple-900 mb-2 flex items-center">
                                <i class="fas fa-clock mr-1"></i>Waktu Selesai
                            </h5>
                            <p class="text-purple-700 font-semibold">{{ $booking->end_time }}</p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-green-900 mb-2 flex items-center">
                                <i class="fas fa-money-bill-wave mr-1"></i>Total Harga
                            </h5>
                            <p class="text-green-700 font-semibold">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-gray-900 mb-2 flex items-center">
                                <i class="fas fa-info-circle mr-1"></i>Status
                            </h5>
                            @if ($booking->status == 'pending')
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($booking->status == 'confirmed')
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Confirmed
                                </span>
                            @elseif($booking->status == 'canceled')
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Canceled
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Field Info -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Informasi Field
                        </h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700"><strong>Lokasi:</strong> {{ $booking->field->location }}</p>
                            <p class="text-gray-700"><strong>Harga per Jam:</strong> Rp
                                {{ number_format($booking->field->price_per_hour, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button onclick="location.href='{{ route('bookings.edit', $booking) }}'"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <i class="fas fa-edit mr-2"></i>Edit Booking
                            </button>
                            <button onclick="Swal.close(); sweetConfirm{{ $booking->id }}()"
                                class="inline-flex items-center justify-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <i class="fas fa-trash mr-2"></i>Hapus Booking
                            </button>
                        </div>
                    </div>
                </x-ui.sweet-modal>
            @empty
                <tr>
                    <td colspan="9" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-calendar-alt text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium">Belum ada booking</p>
                            <p class="mt-2 mb-4">Mulai dengan membuat booking pertama Anda</p>
                            <x-ui.button variant="primary" icon="fas fa-plus"
                                onclick="location.href='{{ route('bookings.create') }}'">
                                Buat Booking Pertama
                            </x-ui.button>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-table.table>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $bookings->links('vendor.pagination.tailwind') }}
        </div>

    </x-ui.card>
</x-layout.dashboard>
