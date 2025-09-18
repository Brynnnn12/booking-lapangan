<section id="about" class="py-24 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Tentang BreezeShield
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Platform booking lapangan olahraga terpercaya yang menghubungkan pemain dengan fasilitas olahraga
                terbaik di sekitar Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Content -->
            <div class="space-y-6">
                <div class="space-y-4">
                    <h3 class="text-2xl font-bold text-gray-900">Mengapa Memilih Kami?</h3>
                    <p class="text-gray-600 leading-relaxed">
                        BreezeShield hadir untuk memudahkan Anda dalam mencari dan memesan lapangan olahraga. Dengan
                        sistem booking online modern, Anda dapat memesan lapangan kapan saja dan di mana saja.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Booking Cepat</h4>
                            <p class="text-gray-600 text-sm">Pesan dalam hitungan menit</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-shield-alt text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Aman & Terpercaya</h4>
                            <p class="text-gray-600 text-sm">Sistem keamanan terdepan</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-purple-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Lokasi Strategis</h4>
                            <p class="text-gray-600 text-sm">Lapangan di seluruh kota</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-star text-orange-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Kualitas Terbaik</h4>
                            <p class="text-gray-600 text-sm">Fasilitas premium</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div class="relative">
                <div class="bg-gradient-to-br from-green-400 to-blue-600 rounded-2xl p-8 text-white">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">{{ \App\Models\User::count() }}</div>
                                <div class="text-white/80">Pengguna Terdaftar</div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-futbol text-2xl"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">{{ \App\Models\Field::count() }}</div>
                                <div class="text-white/80">Lapangan Tersedia</div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar-check text-2xl"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">{{ \App\Models\Booking::count() }}</div>
                                <div class="text-white/80">Booking Berhasil</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
