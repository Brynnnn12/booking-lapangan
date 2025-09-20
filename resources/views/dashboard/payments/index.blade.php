<x-layout.dashboard title="Manajemen Payments">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Payments</h3>
        </x-slot>

        <!-- Payments Table -->
        <x-table.table :headers="['No', 'Booking', 'User', 'Amount', 'Status', 'Aksi']" striped hover>
            @forelse($payments as $payment)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $payment->booking->booking_date->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $payment->booking->user->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        Rp {{ number_format($payment->amount, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($payment->status == 'pending')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @elseif($payment->status == 'paid')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Paid
                            </span>
                        @elseif($payment->status == 'failed')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Failed
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <x-ui.button size="xs" variant="outline" icon="fas fa-eye"
                                onclick="showPaymentModal{{ $payment->id }}()">
                                View
                            </x-ui.button>
                            <x-ui.button size="xs" variant="outline" icon="fas fa-edit"
                                onclick="location.href='{{ route('payments.edit', $payment) }}'">
                                Edit
                            </x-ui.button>
                            <x-ui.button size="xs" variant="danger" icon="fas fa-trash"
                                onclick="sweetConfirm{{ $payment->id }}()">
                                Delete
                            </x-ui.button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-credit-card text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium">Belum ada payment</p>
                            <p class="mt-2 mb-4">Mulai dengan membuat payment pertama Anda</p>
                            <x-ui.button variant="primary" icon="fas fa-plus"
                                onclick="location.href='{{ route('payments.create') }}'">
                                Buat Payment Pertama
                            </x-ui.button>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-table.table>

        <!-- Sweet Confirm & Modal Components -->
        @forelse($payments as $payment)
            <x-ui.sweet-confirm title="Hapus Payment?"
                text="Apakah Anda yakin ingin menghapus payment untuk booking #{{ $payment->booking_id }}? Aksi ini tidak bisa dibatalkan!"
                confirm-text="Ya, Hapus" cancel-text="Batal" icon="warning"
                action="{{ route('payments.destroy', $payment) }}" method="DELETE" :params="['id' => $payment->id]" />

            <x-ui.sweet-modal title="Detail Payment: Booking #{{ $payment->booking_id }}"
                function-name="showPaymentModal{{ $payment->id }}" width="600" :show-cancel-button="false"
                confirm-text="Tutup">
                <!-- Payment Header -->
                <div class="border-b border-gray-200 pb-3 mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Payment #{{ $payment->id }}</h3>
                    <div class="flex flex-wrap gap-2 text-sm">
                        <span class="inline-flex items-center px-2 py-1 rounded-full bg-blue-100 text-blue-800">
                            <i class="fas fa-hashtag mr-1"></i>Booking #{{ $payment->booking_id }}
                        </span>
                        <span class="text-gray-500 flex items-center">
                            <i class="fas fa-calendar-alt mr-1"></i>{{ $payment->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="space-y-4">
                    <!-- Amount -->
                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                            <span class="text-sm font-medium text-gray-900">Total Pembayaran</span>
                        </div>
                        <p class="text-2xl font-bold text-green-700">Rp
                            {{ number_format($payment->amount, 0, ',', '.') }}</p>
                    </div>

                    <!-- Status -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-info-circle text-gray-600"></i>
                            <span class="text-sm font-medium text-gray-900">Status Pembayaran</span>
                        </div>
                        @if ($payment->status == 'paid')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-2"></i>Lunas
                            </span>
                        @elseif ($payment->status == 'pending')
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-2"></i>Pending
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-2"></i>Gagal
                            </span>
                        @endif
                    </div>

                    <!-- Booking Info -->
                    @if ($payment->booking)
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-calendar-check text-blue-600"></i>
                                <span class="text-sm font-medium text-gray-900">Informasi Booking</span>
                            </div>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Lapangan:</span>
                                    <span class="font-medium">{{ $payment->booking->field->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">User:</span>
                                    <span class="font-medium">{{ $payment->booking->user->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tanggal:</span>
                                    <span
                                        class="font-medium">{{ $payment->booking->booking_date->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Waktu:</span>
                                    <span class="font-medium">{{ $payment->booking->start_time }} -
                                        {{ $payment->booking->end_time }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Payment Method -->
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-credit-card text-purple-600"></i>
                            <span class="text-sm font-medium text-gray-900">Metode Pembayaran</span>
                        </div>
                        <p class="text-purple-700 font-medium">{{ $payment->payment_method ?? 'Midtrans' }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 pt-3 border-t">
                        <button onclick="Swal.close(); sweetConfirm{{ $payment->id }}()"
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
            {{ $payments->links('vendor.pagination.tailwind') }}
        </div>

    </x-ui.card>
</x-layout.dashboard>
