<x-layout.dashboard title="Manajemen Bookings">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Bookings</h3>
            <x-ui.button variant="primary" icon="fas fa-plus" onclick="location.href='{{ route('bookings.create') }}'">
                Tambah Booking
            </x-ui.button>
        </x-slot>

        <!-- Bookings Table -->
        <x-table.table :headers="['ID', 'User', 'Field', 'Tanggal', 'Waktu Mulai', 'Waktu Selesai', 'Total Harga', 'Status', 'Aksi']" striped hover>
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
                            <x-ui.button size="xs" variant="success" icon="fas fa-print"
                                onclick="window.open('{{ route('bookings.receipt', $booking) }}', '_blank')">
                                Print
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

        <!-- Sweet Confirm & Modal Components -->
        @forelse($bookings as $booking)
            <x-ui.sweet-confirm title="Hapus Booking?"
                text="Apakah Anda yakin ingin menghapus booking '{{ $booking->field->name }}' pada {{ $booking->booking_date->format('d M Y') }}? Aksi ini tidak bisa dibatalkan!"
                confirm-text="Ya, Hapus" cancel-text="Batal" icon="warning"
                action="{{ route('bookings.destroy', $booking) }}" method="DELETE" :params="['id' => $booking->id]" />

            <x-ui.sweet-modal title="Detail Booking: {{ $booking->field->name }}"
                function-name="showBookingModal{{ $booking->id }}" width="600" :show-cancel-button="false"
                confirm-text="Tutup">
                <div class="space-y-4">
                    <!-- Header -->
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $booking->field->name }}</h3>
                        <span class="text-sm text-gray-500">{{ $booking->created_at->format('d M Y') }}</span>
                    </div>

                    <!-- Booking Info -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-3 rounded-lg">
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-user text-blue-600"></i>
                                <span class="text-sm font-medium text-gray-900">Pemesan</span>
                            </div>
                            <p class="text-blue-700 font-semibold">{{ $booking->user->name }}</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-calendar text-green-600"></i>
                                <span class="text-sm font-medium text-gray-900">Tanggal</span>
                            </div>
                            <p class="text-green-700 font-semibold">{{ $booking->booking_date->format('d M Y') }}</p>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-lg">
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-clock text-purple-600"></i>
                                <span class="text-sm font-medium text-gray-900">Waktu</span>
                            </div>
                            <p class="text-purple-700 font-semibold">{{ $booking->start_time }} -
                                {{ $booking->end_time }}</p>
                        </div>
                        <div class="bg-yellow-50 p-3 rounded-lg">
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-money-bill-wave text-yellow-600"></i>
                                <span class="text-sm font-medium text-gray-900">Total</span>
                            </div>
                            <p class="text-yellow-700 font-semibold">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="fas fa-info-circle text-gray-600"></i>
                            <span class="text-sm font-medium text-gray-900">Status</span>
                        </div>
                        @if ($booking->status == 'pending')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Pending
                            </span>
                        @elseif ($booking->status == 'confirmed')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>Confirmed
                            </span>
                        @elseif ($booking->status == 'cancelled')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times mr-1"></i>Cancelled
                            </span>
                        @endif
                    </div>

                    <!-- Payment Info -->
                    @if ($booking->payment)
                        <div class="bg-indigo-50 p-3 rounded-lg">
                            <div class="flex items-center gap-2 mb-1">
                                <i class="fas fa-credit-card text-indigo-600"></i>
                                <span class="text-sm font-medium text-gray-900">Pembayaran</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Status:</span>
                                @if ($booking->payment->status == 'paid')
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Lunas
                                    </span>
                                @elseif ($booking->payment->status == 'pending')
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times mr-1"></i>Gagal
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex gap-2 pt-3 border-t">
                        <button onclick="window.open('{{ route('bookings.receipt', $booking) }}', '_blank')"
                            class="flex-1 px-3 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700">
                            <i class="fas fa-print mr-1"></i>Cetak Struk
                        </button>
                        @if ($booking->status == 'pending')
                            <button onclick="location.href='{{ route('bookings.edit', $booking) }}'"
                                class="flex-1 px-3 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </button>
                        @endif
                        <button onclick="Swal.close(); sweetConfirm{{ $booking->id }}()"
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
            {{ $bookings->links('vendor.pagination.tailwind') }}
        </div>

    </x-ui.card>
</x-layout.dashboard>
