<section id="fields" class="py-24 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Pilih Lapangan Anda
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Temukan lapangan olahraga terbaik di sekitar Anda. Berbagai jenis olahraga tersedia dengan fasilitas
                lengkap.
            </p>
        </div>

        <!-- Fields Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse(\App\Models\Field::take(6)->get() as $field)
                <div
                    class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Field Image -->
                    <div class="relative h-48 bg-gradient-to-r from-green-400 to-blue-600">
                        @if ($field->photo)
                            <img src="{{ asset('storage/' . $field->photo) }}" alt="{{ $field->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-futbol text-white text-4xl"></i>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full">
                            <span class="text-sm font-semibold text-gray-900">Rp
                                {{ number_format($field->price_per_hour, 0, ',', '.') }}/jam</span>
                        </div>
                    </div>

                    <!-- Field Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $field->name }}</h3>
                        <div class="flex items-center text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>{{ $field->location }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span class="text-sm text-gray-600">4.5 (120 reviews)</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500">Tersedia</span>
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            </div>
                        </div>

                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('home.booking.create', ['field_id' => $field->id]) }}"
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-2 px-4 rounded-lg transition-colors duration-200 font-medium">
                                Booking Sekarang
                            </a>
                            <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-futbol text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada lapangan tersedia</h3>
                    <p class="text-gray-600">Lapangan akan segera ditambahkan ke sistem kami.</p>
                </div>
            @endforelse
        </div>

        <!-- View More Button -->
        @if (\App\Models\Field::count() > 6)
            <div class="text-center mt-12">
                <a href="{{ route('home.fields.index') }}"
                    class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-green-600 to-blue-600 rounded-xl hover:from-green-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-search mr-2"></i>
                    Lihat Semua Lapangan
                </a>
            </div>
        @endif
    </div>
</section>
