<section id="home"
    class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 pt-16">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div
            class="absolute top-1/4 left-1/4 w-64 h-64 bg-green-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float">
        </div>
        <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"
            style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-float"
            style="animation-delay: 4s;"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto text-center px-4">
        <!-- Hero Content -->
        <div class="space-y-6 animate-slide-up">
            <h1
                class="text-5xl md:text-7xl font-bold bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent">
                Booking Lapangan
            </h1>
            <h2 class="text-3xl md:text-5xl font-semibold text-gray-800">
                Mudah & Cepat
            </h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Pesan lapangan olahraga favorit Anda dengan mudah. Sistem booking online modern untuk semua kebutuhan
                olahraga Anda.
            </p>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-12 animate-slide-up"
            style="animation-delay: 0.2s;">
            <a href="#fields"
                class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-green-600 to-blue-600 rounded-xl hover:from-green-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-search mr-2"></i>
                Cari Lapangan
            </a>
            <a href="#about"
                class="inline-flex items-center px-8 py-4 text-lg font-semibold text-gray-800 bg-white rounded-xl hover:bg-gray-100 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl border border-gray-200">
                <i class="fas fa-info-circle mr-2"></i>
                Pelajari Lebih Lanjut
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16 animate-slide-up" style="animation-delay: 0.4s;">
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ \App\Models\Field::count() }}</div>
                <div class="text-gray-600 font-medium">Lapangan Tersedia</div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ \App\Models\Booking::count() }}</div>
                <div class="text-gray-600 font-medium">Booking Berhasil</div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg">
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ \App\Models\User::count() }}</div>
                <div class="text-gray-600 font-medium">Pengguna Aktif</div>
            </div>
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg">
                <div class="text-3xl font-bold text-orange-600 mb-2">24/7</div>
                <div class="text-gray-600 font-medium">Layanan Online</div>
            </div>
        </div>
    </div>
</section>
