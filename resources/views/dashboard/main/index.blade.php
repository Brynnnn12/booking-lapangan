<x-layout.dashboard title="Dashboard Overview">
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Stat Card 1 -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mr-4">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Total Pendapatan</h3>
                    <p class="text-2xl font-semibold text-gray-800">Rp
                        {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                    <p class="text-xs text-green-500 flex items-center">
                        <i class="fas fa-check-circle mr-1"></i> Dari pembayaran berhasil
                    </p>
                </div>
            </div>

            <!-- Stat Card 2 -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mr-4">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Total Booking</h3>
                    <p class="text-2xl font-semibold text-gray-800">{{ number_format($stats['total_orders']) }}</p>
                    <p class="text-xs text-blue-500 flex items-center">
                        <i class="fas fa-calendar mr-1"></i> Booking diterima
                    </p>
                </div>
            </div>

            <!-- Stat Card 3 -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600 mr-4">
                    <i class="fas fa-futbol text-xl"></i>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Total Lapangan</h3>
                    <p class="text-2xl font-semibold text-gray-800">{{ number_format($stats['total_fields']) }}</p>
                    <p class="text-xs text-purple-500 flex items-center">
                        <i class="fas fa-map-marker-alt mr-1"></i> Lapangan aktif
                    </p>
                </div>
            </div>

            <!-- Stat Card 4 -->
            <div class="bg-white rounded-xl shadow-sm p-6 flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600 mr-4">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Booking Dikonfirmasi</h3>
                    <p class="text-2xl font-semibold text-gray-800">{{ number_format($stats['confirmed_bookings']) }}
                    </p>
                    <p class="text-xs text-yellow-500 flex items-center">
                        <i class="fas fa-check mr-1"></i> Sudah dikonfirmasi
                    </p>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pendapatan Bulanan</h3>
                <canvas id="revenueChart" height="300"></canvas>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Jenis Lapangan</h3>
                <canvas id="categoryChart" height="300"></canvas>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Booking Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelanggan</th>
                            <th
                                class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Lapangan</th>
                            <th
                                class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal & Waktu</th>
                            <th
                                class="px-4 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentBookings as $booking)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-semibold">
                                                {{ substr($booking->user->name, 0, 1) }}</div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $booking->user->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $booking->field->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->field->location }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                    <br>
                                    <span class="text-xs">{{ $booking->start_time }} - {{ $booking->end_time }}</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if ($booking->status == 'confirmed')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Dikonfirmasi
                                        </span>
                                    @elseif($booking->status == 'pending')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @elseif($booking->status == 'cancelled')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Dibatalkan
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $booking->status }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                    Belum ada booking
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan (Juta Rupiah)',
                    data: @json($monthlyRevenue),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });

        // Category Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(@json($fieldCategories)),
                datasets: [{
                    data: Object.values(@json($fieldCategories)),
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#9ca3af', '#ef4444',
                        '#06b6d4'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-layout.dashboard>
