<x-layout.dashboard title="Manajemen Payments">

    <x-ui.card>
        <x-slot name="header">
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Payments</h3>
            <x-ui.button variant="primary" icon="fas fa-plus" onclick="location.href='{{ route('payments.create') }}'">
                Tambah Payment
            </x-ui.button>
        </x-slot>

        <!-- Payments Table -->
        <x-table.table :headers="['ID', 'Booking', 'User', 'Amount', 'Status', 'Snap Token', 'Actions']" striped hover>
            @forelse($payments as $payment)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $payment->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        #{{ $payment->booking_id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $payment->bookings->user->name }}
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
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <span class="font-mono text-xs">{{ Str::limit($payment->snap_token, 20) }}</span>
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

                <!-- Sweet Confirm & Modal Components -->
                <x-ui.sweet-confirm title="Hapus Payment?"
                    text="Apakah Anda yakin ingin menghapus payment untuk booking #{{ $payment->booking_id }}? Aksi ini tidak bisa dibatalkan!"
                    confirm-text="Ya, Hapus" cancel-text="Batal" icon="warning"
                    action="{{ route('payments.destroy', $payment) }}" method="DELETE" :params="['id' => $payment->id]" />

                <x-ui.sweet-modal title="Detail Payment: Booking #{{ $payment->booking_id }}"
                    function-name="showPaymentModal{{ $payment->id }}" width="600" :show-cancel-button="false"
                    confirm-text="Tutup">
                    <!-- Payment Header -->
                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Payment #{{ $payment->id }}</h3>
                        <div class="flex flex-wrap gap-3">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-hashtag mr-2"></i>Booking #{{ $payment->booking_id }}
                            </span>
                            <span class="text-sm text-gray-500 flex items-center">
                                <i class="fas fa-calendar-alt mr-1"></i>Dibuat:
                                {{ $payment->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-blue-900 mb-2 flex items-center">
                                <i class="fas fa-user mr-1"></i>User
                            </h5>
                            <p class="text-blue-700 font-semibold">{{ $payment->bookings->user->name }}</p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-green-900 mb-2 flex items-center">
                                <i class="fas fa-money-bill-wave mr-1"></i>Amount
                            </h5>
                            <p class="text-green-700 font-semibold">Rp
                                {{ number_format($payment->amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-purple-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-purple-900 mb-2 flex items-center">
                                <i class="fas fa-info-circle mr-1"></i>Status
                            </h5>
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
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-gray-900 mb-2 flex items-center">
                                <i class="fas fa-clock mr-1"></i>Terakhir Update
                            </h5>
                            <p class="text-gray-700">{{ $payment->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Snap Token -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-key mr-2 text-blue-600"></i>Snap Token
                        </h4>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="font-mono text-sm break-all">{{ $payment->snap_token }}</p>
                        </div>
                    </div>

                    <!-- Booking Info -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-calendar-alt mr-2 text-green-600"></i>Informasi Booking
                        </h4>
                        <div class="bg-green-50 rounded-lg p-4">
                            <p class="text-gray-700"><strong>Field:</strong> {{ $payment->bookings->field->name }}</p>
                            <p class="text-gray-700"><strong>Tanggal:</strong>
                                {{ $payment->bookings->booking_date->format('d M Y') }}</p>
                            <p class="text-gray-700"><strong>Waktu:</strong> {{ $payment->bookings->start_time }} -
                                {{ $payment->bookings->end_time }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button onclick="location.href='{{ route('payments.edit', $payment) }}'"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <i class="fas fa-edit mr-2"></i>Edit Payment
                            </button>
                            <button onclick="Swal.close(); sweetConfirm{{ $payment->id }}()"
                                class="inline-flex items-center justify-center px-4 py-2 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                <i class="fas fa-trash mr-2"></i>Hapus Payment
                            </button>
                        </div>
                    </div>
                </x-ui.sweet-modal>
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

        <!-- Pagination -->
        <div class="mt-6">
            {{ $payments->links('vendor.pagination.tailwind') }}
        </div>

    </x-ui.card>
</x-layout.dashboard>
