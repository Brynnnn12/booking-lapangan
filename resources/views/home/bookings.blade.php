<x-layout.landing>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-6 py-8">
                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-3xl font-bold text-gray-900">Riwayat Booking Saya</h1>
                        <a href="{{ route('home.booking.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                            Booking Baru
                        </a>
                    </div>

                    @if (session('status'))
                        <div
                            class="mb-4 p-4 rounded-md {{ session('status') === 'paid' ? 'bg-green-50 text-green-800' : 'bg-yellow-50 text-yellow-800' }}">
                            {{ session('status') === 'paid' ? 'Pembayaran berhasil!' : 'Pembayaran sedang diproses.' }}
                        </div>
                    @endif

                    @if ($bookings->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Lapangan
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Waktu
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pembayaran
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $booking->field->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $booking->start_time }} - {{ $booking->end_time }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    Rp {{ number_format($booking->total_price) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $booking->status === 'confirmed'
                                                    ? 'bg-green-100 text-green-800'
                                                    : ($booking->status === 'pending'
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : 'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($booking->payment)
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $booking->payment->status === 'paid'
                                                        ? 'bg-green-100 text-green-800'
                                                        : ($booking->payment->status === 'pending'
                                                            ? 'bg-yellow-100 text-yellow-800'
                                                            : 'bg-red-100 text-red-800') }}">
                                                        {{ ucfirst($booking->payment->status) }}
                                                    </span>
                                                @else
                                                    <span class="text-sm text-gray-500">Belum dibayar</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada booking</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai booking lapangan pertama Anda.</p>
                            <div class="mt-6">
                                <a href="{{ route('home.booking.create') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Booking Sekarang
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout.landing>
