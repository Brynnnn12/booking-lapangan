<x-layout.landing>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-6 py-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Booking Lapangan</h1>

                    <form id="bookingForm" class="space-y-6">
                        @csrf

                        <!-- Field Selection -->
                        <div>
                            <label for="field_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Pilih Lapangan
                            </label>
                            <select id="field_id" name="field_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Lapangan</option>
                                @foreach ($fields as $field)
                                    <option value="{{ $field->id }}" data-price="{{ $field->price_per_hour }}">
                                        {{ $field->name }} - Rp {{ number_format($field->price_per_hour) }}/jam
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Booking Date -->
                        <div>
                            <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Booking
                            </label>
                            <input type="date" id="booking_date" name="booking_date" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                min="{{ date('Y-m-d') }}">
                        </div>

                        <!-- Time Selection -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">
                                    Waktu Mulai
                                </label>
                                <input type="time" id="start_time" name="start_time" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">
                                    Waktu Selesai
                                </label>
                                <input type="time" id="end_time" name="end_time" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <!-- Price Calculation Display -->
                        <div id="priceDisplay" class="bg-gray-50 p-4 rounded-md hidden">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">Durasi:</span>
                                <span id="duration" class="font-medium">0 jam</span>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-sm text-gray-600">Harga per jam:</span>
                                <span id="pricePerHour" class="font-medium">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center mt-2 pt-2 border-t">
                                <span class="text-lg font-semibold text-gray-900">Total:</span>
                                <span id="totalPrice" class="text-lg font-bold text-blue-600">Rp 0</span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                id="submitBtn">
                                <span id="btnText">Booking Sekarang</span>
                                <div id="loadingSpinner" class="hidden ml-2">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Pembayaran</h3>
                <div id="paymentContent"></div>
                <div class="flex justify-end mt-4">
                    <button id="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Snap Midtrans --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        const fieldSelect = document.getElementById("field_id");
        const startInput = document.getElementById("start_time");
        const endInput = document.getElementById("end_time");
        const priceDisplay = document.getElementById("priceDisplay");
        const durationEl = document.getElementById("duration");
        const pricePerHourEl = document.getElementById("pricePerHour");
        const totalPriceEl = document.getElementById("totalPrice");

        function calculatePrice() {
            const pricePerHour = fieldSelect.selectedOptions[0]?.dataset.price || 0;
            const start = startInput.value;
            const end = endInput.value;

            if (pricePerHour && start && end) {
                const [sh, sm] = start.split(":").map(Number);
                const [eh, em] = end.split(":").map(Number);
                const startMinutes = sh * 60 + sm;
                const endMinutes = eh * 60 + em;

                let duration = (endMinutes - startMinutes) / 60;
                if (duration > 0) {
                    const total = duration * pricePerHour;
                    durationEl.textContent = duration + " jam";
                    pricePerHourEl.textContent = "Rp " + Number(pricePerHour).toLocaleString();
                    totalPriceEl.textContent = "Rp " + total.toLocaleString();
                    priceDisplay.classList.remove("hidden");
                } else {
                    priceDisplay.classList.add("hidden");
                }
            } else {
                priceDisplay.classList.add("hidden");
            }
        }

        fieldSelect.addEventListener("change", calculatePrice);
        startInput.addEventListener("change", calculatePrice);
        endInput.addEventListener("change", calculatePrice);

        // Booking form submit
        document.getElementById("bookingForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const btn = document.getElementById("submitBtn");
            const btnText = document.getElementById("btnText");
            const spinner = document.getElementById("loadingSpinner");

            btn.disabled = true;
            btnText.textContent = "Memproses...";
            spinner.classList.remove("hidden");

            let formData = new FormData(this);

            fetch("{{ route('home.bookings.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "Accept": "application/json",
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    btn.disabled = false;
                    btnText.textContent = "Booking Sekarang";
                    spinner.classList.add("hidden");

                    if (data.snap_token) {
                        // Panggil Midtrans popup
                        snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                alert("Pembayaran berhasil!");
                                window.location.href = "/my-bookings";
                            },
                            onPending: function(result) {
                                alert("Menunggu pembayaran...");
                                window.location.href = "/my-bookings";
                            },
                            onError: function(result) {
                                alert("Pembayaran gagal!");
                            },
                            onClose: function() {
                                alert("Popup ditutup tanpa bayar");
                            }
                        });
                    } else {
                        alert("Gagal membuat booking.");
                    }
                })
                .catch(err => {
                    console.error(err);
                    btn.disabled = false;
                    btnText.textContent = "Booking Sekarang";
                    spinner.classList.add("hidden");
                    alert("Terjadi kesalahan, coba lagi.");
                });
        });

        // Tutup modal manual (kalau kamu tetap pakai modal)
        document.getElementById("closeModal").addEventListener("click", function() {
            document.getElementById("paymentModal").classList.add("hidden");
        });
    </script>


</x-layout.landing>
