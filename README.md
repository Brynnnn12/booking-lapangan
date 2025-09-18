# ⚽️ BreezeShield - Aplikasi Booking Lapangan Futsal

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Midtrans_Payment-00B4D8?style=for-the-badge&logo=stripe&logoColor=white" alt="Midtrans">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

<p align="center">
  <strong>🚀 Platform booking lapangan futsal online dengan sistem pembayaran terintegrasi</strong>
</p>

## 📋 Tentang BreezeShield

BreezeShield adalah platform booking lapangan futsal online yang memudahkan pengguna untuk memesan lapangan olahraga secara real-time. Aplikasi ini menyediakan sistem booking yang lengkap dengan integrasi pembayaran Midtrans, manajemen lapangan, dan dashboard admin untuk mengelola seluruh operasional.

### ✨ Fitur Utama

-   ⚽️ **Booking Lapangan Real-time** - Sistem booking online 24/7
-   💳 **Pembayaran Terintegrasi** - Menggunakan Midtrans (sandbox & production)
-   🔐 **Sistem Autentikasi Lengkap** - Menggunakan Laravel Breeze
-   👥 **Manajemen Role & Permission** - Menggunakan Spatie Laravel Permission
-   🎨 **UI Dashboard yang Indah** - Desain modern dan responsif
-   🔔 **Integrasi Sweet Alert** - Alert dan notifikasi yang cantik
-   📱 **Responsif Mobile** - Bekerja sempurna di semua perangkat
-   📊 **Dashboard Admin** - Manajemen lapangan, booking, dan pembayaran
-   🛡️ **Aman Secara Default** - Mengikuti praktik terbaik Laravel

## 🛠️ Stack Teknologi

-   **Backend**: Laravel 11.x
-   **Frontend**: Blade Templates + Tailwind CSS + Alpine.js
-   **Autentikasi**: Laravel Breeze
-   **Manajemen Role**: Spatie Laravel Permission
-   **Pembayaran**: Midtrans Payment Gateway
-   **Alert**: SweetAlert2
-   **Database**: MySQL/PostgreSQL/SQLite
-   **Styling**: Tailwind CSS + Komponen Custom
-   **JavaScript**: Vanilla JS + Alpine.js

## 📦 Yang Sudah Disediakan

### ⚽️ Sistem Booking Lapangan

-   **Daftar Lapangan Lengkap** - Menampilkan semua lapangan tersedia
-   **Pencarian & Filter** - Cari berdasarkan lokasi, jenis olahraga
-   **Booking Real-time** - Sistem booking dengan validasi waktu
-   **Kalkulasi Otomatis** - Hitung durasi dan total harga secara real-time
-   **Validasi Booking** - Cek konflik jadwal otomatis
-   **Riwayat Booking** - Lihat semua booking yang pernah dibuat

### 💳 Sistem Pembayaran

-   **Integrasi Midtrans** - Payment gateway terpercaya Indonesia
-   **Mode Sandbox & Production** - Untuk testing dan live
-   **Berbagai Metode Pembayaran** - Transfer bank, e-wallet, kartu kredit
-   **Callback Handler** - Update status pembayaran otomatis
-   **Invoice & Receipt** - Sistem struk pembayaran

### 🔐 Sistem Autentikasi

-   Registrasi dan login pengguna
-   Fungsi reset password
-   Verifikasi email
-   Fungsi remember me
-   Manajemen profil pengguna

### 👥 Sistem Role & Permission

-   Role yang sudah dikonfigurasi (Admin, User)
-   Kontrol akses berbasis permission
-   Interface assignment role
-   Proteksi middleware

### 🎨 Komponen UI

-   Layout dashboard modern
-   Navigasi responsif
-   Halaman welcome yang indah
-   Notifikasi alert dengan SweetAlert
-   Komponen form booking
-   Tabel data siap pakai
-   Card lapangan dengan gambar

### 🔔 Sistem Notifikasi

-   Integrasi SweetAlert untuk alert cantik
-   Alert Success/Error/Warning/Info
-   Notifikasi toast yang responsif
-   Dialog konfirmasi pembayaran
-   Flash messages untuk feedback user

## 🎯 Cara Kerja Aplikasi

### Untuk Pengguna (Customer)

1. **Kunjungi Website** - Akses halaman utama untuk melihat lapangan tersedia
2. **Pilih Lapangan** - Klik tombol "Booking Sekarang" pada lapangan yang diinginkan
3. **Login/Daftar** - Sistem akan redirect ke halaman login jika belum login
4. **Isi Form Booking** - Pilih tanggal, waktu mulai, dan waktu selesai
5. **Konfirmasi Booking** - Sistem akan menghitung durasi dan total harga otomatis
6. **Pembayaran** - Lakukan pembayaran melalui Midtrans popup
7. **Konfirmasi** - Booking berhasil dan akan muncul di halaman "My Bookings"

### Untuk Admin

1. **Login sebagai Admin** - Gunakan akun admin untuk akses dashboard
2. **Kelola Lapangan** - Tambah, edit, hapus data lapangan
3. **Monitor Booking** - Lihat semua booking yang masuk
4. **Kelola Pembayaran** - Pantau status pembayaran
5. **Manajemen User** - Kelola data pengguna dan role

## ⚙️ Konfigurasi Midtrans

### Setup Environment

Tambahkan konfigurasi Midtrans di file `.env`:

```env
# Midtrans Configuration
MIDTRANS_MERCHANT_ID=your_merchant_id
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_IS_PRODUCTION=false  # Set true untuk production
MIDTRANS_SANDBOX_URL=https://app.sandbox.midtrans.com/snap/v1/transactions
MIDTRANS_PRODUCTION_URL=https://app.midtrans.com/snap/v1/transactions
```

### Callback URL

Pastikan callback URL di Midtrans dashboard mengarah ke:

```
https://yourdomain.com/midtrans/callback
```

### Webhook untuk Payment Status

Midtrans akan mengirim webhook ke endpoint:

```
https://yourdomain.com/midtrans/callback
```

## 📊 Struktur Database

### Tabel Utama

-   **users** - Data pengguna
-   **fields** - Data lapangan futsal
-   **bookings** - Data booking
-   **payments** - Data pembayaran
-   **roles & permissions** - Sistem role dan permission

### Relasi Database

```
users (1) ──── (N) bookings
fields (1) ──── (N) bookings
bookings (1) ──── (1) payments
users (N) ──── (N) roles
roles (N) ──── (N) permissions
```

## 🚀 Panduan Cepat

### Prasyarat

-   PHP 8.2 atau lebih tinggi
-   Composer
-   Node.js & NPM
-   MySQL/PostgreSQL/SQLite

### Instalasi

1. **Clone repository**

    ```bash
    git clone https://github.com/username/breezeshield.git
    cd breezeshield
    ```

2. **Install dependensi PHP**

    ```bash
    composer install
    ```

3. **Install dependensi Node.js**

    ```bash
    npm install
    ```

4. **Setup environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Konfigurasi database**
   Edit file `.env` dengan kredensial database Anda:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=breezeshield_futsal
    DB_USERNAME=username_anda
    DB_PASSWORD=password_anda
    ```

6. **Konfigurasi Midtrans**
   Tambahkan konfigurasi Midtrans di file `.env`:

    ```env
    # Midtrans Configuration
    MIDTRANS_MERCHANT_ID=your_merchant_id
    MIDTRANS_CLIENT_KEY=your_client_key
    MIDTRANS_SERVER_KEY=your_server_key
    MIDTRANS_IS_PRODUCTION=false
    ```

7. **Jalankan migrasi dan seeder**

    ```bash
    php artisan migrate --seed
    ```

8. **Buat storage link untuk upload gambar lapangan**

    ```bash
    php artisan storage:link
    ```

9. **Build asset**

    ```bash
    npm run build
    ```

10. **Jalankan aplikasi**
    ```bash
    php artisan serve
    ```

Kunjungi `http://localhost:8000` untuk melihat aplikasi booking futsal Anda!

## 👤 User Default

Setelah seeding, Anda dapat login dengan akun berikut:

**Admin (untuk mengelola sistem):**

-   Email: `admin@example.com`
-   Password: `password`
-   Role: Admin
-   Akses: Dashboard admin, kelola lapangan, monitor booking

**User Biasa (untuk booking):**

-   Email: `user@example.com`
-   Password: `password`
-   Role: User
-   Akses: Booking lapangan, lihat riwayat booking

## 🎯 Panduan Penggunaan

### 📋 Cara Booking Lapangan

1. **Akses Halaman Utama**

    - Kunjungi `http://localhost:8000`
    - Lihat daftar lapangan yang tersedia

2. **Pilih Lapangan**

    - Klik tombol "Booking Sekarang" pada lapangan yang diinginkan
    - Sistem akan redirect ke halaman login jika belum login

3. **Login atau Daftar**

    - Jika belum punya akun, klik "Register"
    - Isi form registrasi dengan data lengkap

4. **Isi Form Booking**

    - Pilih tanggal booking (minimal hari ini)
    - Tentukan waktu mulai dan waktu selesai
    - Sistem akan menghitung durasi dan total harga otomatis

5. **Konfirmasi dan Bayar**

    - Klik "Booking Sekarang"
    - Sistem akan validasi jadwal (tidak bentrok)
    - Jika valid, akan muncul popup pembayaran Midtrans
    - Pilih metode pembayaran (transfer, e-wallet, dll)

6. **Selesai**
    - Setelah pembayaran berhasil, Anda akan diarahkan ke halaman "My Bookings"
    - Status booking akan berubah menjadi "Confirmed"

### 📊 Fitur Admin Dashboard

1. **Kelola Lapangan**

    - Tambah lapangan baru dengan foto, nama, lokasi, harga
    - Edit informasi lapangan
    - Hapus lapangan yang tidak aktif

2. **Monitor Booking**

    - Lihat semua booking yang masuk
    - Update status booking
    - Lihat detail booking dan pembayaran

3. **Manajemen User**
    - Lihat daftar semua user
    - Assign role ke user
    - Kelola permission

### 💰 Sistem Pembayaran

-   **Sandbox Mode**: Untuk testing (default)
-   **Production Mode**: Untuk live (set `MIDTRANS_IS_PRODUCTION=true`)
-   **Metode Pembayaran**: Transfer bank, GoPay, OVO, Dana, LinkAja, Kartu Kredit
-   **Callback**: Status pembayaran diupdate otomatis
-   **Refund**: Dapat dilakukan melalui dashboard Midtrans

## 🔧 Troubleshooting

### Masalah Umum

**1. SweetAlert tidak muncul**

```
Solusi: Pastikan CDN SweetAlert sudah ter-load dengan benar
```

**2. Pembayaran Midtrans gagal**

```
Solusi:
- Cek konfigurasi MIDTRANS_* di .env
- Pastikan server key benar
- Cek status sandbox/production
```

**3. Booking bentrok jadwal**

```
Solusi: Sistem otomatis mendeteksi konflik waktu
- Pilih waktu yang berbeda
- Atau pilih lapangan lain
```

**4. Gambar lapangan tidak muncul**

```
Solusi: Jalankan php artisan storage:link
```

### Log Error

Cek log Laravel di `storage/logs/laravel.log` untuk debugging error.

### Midtrans Testing

Gunakan kartu testing Midtrans:

-   Visa: `4811 1111 1111 1114`
-   CVV: `123`
-   Expiry: Bulan/Tahun berapapun di masa depan

## 🔗 API Endpoints

### Public Routes (Tidak perlu login)

```
GET  /              - Halaman utama
GET  /fields        - Daftar semua lapangan
GET  /login         - Halaman login
GET  /register      - Halaman registrasi
```

### Protected Routes (Perlu login)

```
GET  /booking/create           - Form booking (dengan field_id opsional)
POST /booking                  - Proses booking
GET  /my-bookings              - Riwayat booking user
GET  /dashboard                - Dashboard admin
```

### Admin Routes (Role Admin)

```
GET  /dashboard/fields         - CRUD lapangan
GET  /dashboard/bookings       - CRUD booking
GET  /dashboard/payments       - CRUD pembayaran
```

### API Routes (untuk AJAX)

```
POST /midtrans/callback        - Callback pembayaran Midtrans
GET  /payment/check/{bookingId} - Cek status pembayaran
```

## 🚀 Deployment

### Persiapan Production

1. **Environment Setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

2. **Database Production**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=your_production_host
    DB_DATABASE=your_production_db
    DB_USERNAME=your_production_user
    DB_PASSWORD=your_production_pass
    ```

3. **Midtrans Production**

    ```env
    MIDTRANS_IS_PRODUCTION=true
    MIDTRANS_MERCHANT_ID=your_production_merchant_id
    MIDTRANS_CLIENT_KEY=your_production_client_key
    MIDTRANS_SERVER_KEY=your_production_server_key
    ```

4. **Storage & Cache**

    ```bash
    php artisan storage:link
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

5. **SSL Certificate**
    - Pastikan domain menggunakan HTTPS
    - Update callback URL Midtrans ke HTTPS

### Hosting Requirements

-   **PHP**: 8.2 atau lebih tinggi
-   **Database**: MySQL 5.7+ / PostgreSQL 9.6+ / SQLite 3.8.8+
-   **Web Server**: Apache/Nginx dengan mod_rewrite
-   **SSL**: Certificate untuk HTTPS
-   **Storage**: Space untuk upload gambar lapangan

### Monitoring & Maintenance

1. **Log Monitoring**

    ```bash
    tail -f storage/logs/laravel.log
    ```

2. **Queue Worker** (jika menggunakan queue)

    ```bash
    php artisan queue:work
    ```

3. **Backup Database**
    ```bash
    php artisan db:backup
    ```

## 🎯 Cara Penggunaan

### Membuat Operasi CRUD

BreezeShield menyediakan fondasi yang solid. Untuk menambahkan operasi CRUD Anda sendiri:

1. **Buat Model dan Migration**

    ```bash
    php artisan make:model ModelAnda -mc
    ```

2. **Definisikan relasi dan fillable fields**

    ```php
    // app/Models/ModelAnda.php
    protected $fillable = ['nama', 'deskripsi'];
    ```

3. **Buat method Controller**

    ```php
    // app/Http/Controllers/ModelAndaController.php
    public function index()
    {
        $items = ModelAnda::paginate(10);
        return view('model-anda.index', compact('items'));
    }
    ```

4. **Tambahkan routes**

    ```php
    // routes/web.php
    Route::resource('model-anda', ModelAndaController::class)
        ->middleware(['auth', 'verified']);
    ```

5. **Buat views menggunakan komponen yang ada**

    ```blade
    {{-- resources/views/model-anda/index.blade.php --}}
    <x-app-layout>
        <x-slot name="header">
            <h2>Model Anda</h2>
        </x-slot>

        <!-- Konten Anda di sini -->
    </x-app-layout>
    ```

### Menambah Permission

1. **Buat permission**

    ```bash
    php artisan tinker
    ```

    ```php
    use Spatie\Permission\Models\Permission;
    Permission::create(['name' => 'kelola postingan']);
    ```

2. **Assign ke role**

    ```php
    $role = Role::findByName('admin');
    $role->givePermissionTo('kelola postingan');
    ```

3. **Proteksi routes**
    ```php
    Route::get('/posts', [PostController::class, 'index'])
        ->middleware(['auth', 'permission:kelola postingan']);
    ```

## 📁 Struktur Project

```
breezeshield/
├── app/
│   ├── Http/Controllers/
│   │   ├── Home/BookingController.php    # Controller booking untuk user
│   │   ├── Dashboard/
│   │   │   ├── FieldController.php       # CRUD lapangan
│   │   │   ├── BookingController.php     # CRUD booking
│   │   │   └── PaymentController.php     # CRUD pembayaran
│   ├── Models/
│   │   ├── User.php                      # Model user
│   │   ├── Field.php                     # Model lapangan
│   │   ├── Booking.php                   # Model booking
│   │   └── Payment.php                   # Model pembayaran
│   ├── Services/
│   │   └── PaymentService.php            # Service Midtrans
│   └── Policies/                         # Policy otorisasi
├── database/
│   ├── migrations/                       # Migrasi database
│   │   ├── create_fields_table.php       # Tabel lapangan
│   │   ├── create_bookings_table.php     # Tabel booking
│   │   └── create_payments_table.php     # Tabel pembayaran
│   └── seeders/
│       ├── FieldSeeder.php               # Data dummy lapangan
│       ├── BookingSeeder.php             # Data dummy booking
│       └── RoleSeeder.php                # Setup role & permission
├── resources/
│   ├── views/
│   │   ├── home/
│   │   │   ├── booking-create.blade.php  # Form booking
│   │   │   ├── bookings.blade.php        # Riwayat booking
│   │   │   └── fields.blade.php          # Daftar lapangan
│   │   ├── dashboard/
│   │   │   ├── fields/                   # CRUD lapangan
│   │   │   ├── bookings/                 # CRUD booking
│   │   │   └── payments/                 # CRUD pembayaran
│   │   └── components/
│   │       ├── layout/landing.blade.php  # Layout public
│   │       ├── ui/sweet-alert.blade.php  # Komponen SweetAlert
│   │       └── feedback/flash-messages.blade.php
├── routes/
│   ├── web.php                           # Routes utama
│   └── auth.php                          # Routes autentikasi
├── public/
│   └── storage/                          # Storage link untuk gambar
└── config/
    └── midtrans.php                      # Konfigurasi Midtrans
```

## 🔧 Kustomisasi

### Styling

-   Edit `resources/css/app.css` untuk style custom
-   Modifikasi konfigurasi Tailwind di `tailwind.config.js`
-   Update komponen di `resources/views/components/`

### Dashboard

-   Kustomisasi layout dashboard di `resources/views/dashboard.blade.php`
-   Tambah item navigasi baru di `resources/views/layouts/navigation.blade.php`

### Halaman Welcome

-   Modifikasi halaman welcome di `resources/views/welcome.blade.php`
-   Update styling dan konten sesuai kebutuhan

## � API Endpoints

### Public Routes (Tidak perlu login)

```
GET  /              - Halaman utama
GET  /fields        - Daftar semua lapangan
GET  /login         - Halaman login
GET  /register      - Halaman registrasi
```

### Protected Routes (Perlu login)

```
GET  /booking/create           - Form booking (dengan field_id opsional)
POST /booking                  - Proses booking
GET  /my-bookings              - Riwayat booking user
GET  /dashboard                - Dashboard admin
```

### Admin Routes (Role Admin)

```
GET  /dashboard/fields         - CRUD lapangan
GET  /dashboard/bookings       - CRUD booking
GET  /dashboard/payments       - CRUD pembayaran
```

### API Routes (untuk AJAX)

```
POST /midtrans/callback        - Callback pembayaran Midtrans
GET  /payment/check/{bookingId} - Cek status pembayaran
```

## 🚀 Deployment

### Persiapan Production

1. **Environment Setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

2. **Database Production**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=your_production_host
    DB_DATABASE=your_production_db
    DB_USERNAME=your_production_user
    DB_PASSWORD=your_production_pass
    ```

3. **Midtrans Production**

    ```env
    MIDTRANS_IS_PRODUCTION=true
    MIDTRANS_MERCHANT_ID=your_production_merchant_id
    MIDTRANS_CLIENT_KEY=your_production_client_key
    MIDTRANS_SERVER_KEY=your_production_server_key
    ```

4. **Storage & Cache**

    ```bash
    php artisan storage:link
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

5. **SSL Certificate**
    - Pastikan domain menggunakan HTTPS
    - Update callback URL Midtrans ke HTTPS

### Hosting Requirements

-   **PHP**: 8.2 atau lebih tinggi
-   **Database**: MySQL 5.7+ / PostgreSQL 9.6+ / SQLite 3.8.8+
-   **Web Server**: Apache/Nginx dengan mod_rewrite
-   **SSL**: Certificate untuk HTTPS
-   **Storage**: Space untuk upload gambar lapangan

### Monitoring & Maintenance

1. **Log Monitoring**

    ```bash
    tail -f storage/logs/laravel.log
    ```

2. **Queue Worker** (jika menggunakan queue)

    ```bash
    php artisan queue:work
    ```

3. **Backup Database**

    ```bash
    php artisan db:backup
    ```

4. **Clear Cache**
    ```bash
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
    ```

## ⚡ Optimasi & Performa

### Database Optimization

1. **Indexing**

    ```sql
    -- Index untuk performa booking query
    CREATE INDEX idx_bookings_field_date ON bookings(field_id, booking_date);
    CREATE INDEX idx_bookings_user_status ON bookings(user_id, status);
    ```

2. **Query Optimization**
    - Gunakan eager loading untuk relasi
    - Implementasi pagination untuk data besar
    - Cache hasil query yang sering digunakan

### Frontend Optimization

1. **Asset Optimization**

    ```bash
    npm run build  # Minify CSS & JS
    ```

2. **Image Optimization**
    - Kompres gambar lapangan sebelum upload
    - Gunakan format WebP untuk performa lebih baik
    - Implementasi lazy loading untuk gambar

## 📚 Dokumentasi & Sumber Daya

-   [Dokumentasi Laravel](https://laravel.com/docs)
-   [Dokumentasi Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)
-   [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
-   [Dokumentasi Tailwind CSS](https://tailwindcss.com/docs)
-   [Dokumentasi SweetAlert2](https://sweetalert2.github.io/)
-   [Dokumentasi Midtrans](https://docs.midtrans.com/)
-   [Laravel Best Practices](https://github.com/alexeymezenin/laravel-best-practices)

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan buat Pull Request. Untuk perubahan besar, silakan buka issue terlebih dahulu untuk mendiskusikan apa yang ingin Anda ubah.

1. Fork project
2. Buat feature branch Anda (`git checkout -b feature/FiturKeren`)
3. Commit perubahan Anda (`git commit -m 'Tambah FiturKeren'`)
4. Push ke branch (`git push origin feature/FiturKeren`)
5. Buka Pull Request

## 📝 Changelog

### Versi 1.0.0

-   ✅ Sistem booking lapangan futsal lengkap
-   ✅ Integrasi pembayaran Midtrans
-   ✅ Dashboard admin untuk manajemen
-   ✅ Sistem autentikasi dengan role & permission
-   ✅ UI responsif dengan Tailwind CSS
-   ✅ SweetAlert untuk notifikasi
-   ✅ Validasi booking real-time
-   ✅ Callback handler pembayaran
-   ✅ Flash messages dengan komponen

## 🐛 Issues & Support

Jika Anda mengalami masalah atau membutuhkan dukungan:

1. Periksa [issues](https://github.com/username/breezeshield/issues) yang sudah ada
2. Buat issue baru dengan informasi detail
3. Sertakan langkah-langkah untuk mereproduksi masalah
4. Include log error dari `storage/logs/laravel.log`

## � Support & Contact

-   **Email**: support@breezeshield.com
-   **Documentation**: [Wiki](https://github.com/username/breezeshield/wiki)
-   **Forum**: [Discussions](https://github.com/username/breezeshield/discussions)

## �📄 Lisensi

Project ini dilisensikan di bawah MIT License - lihat file [LICENSE](LICENSE) untuk detail.

## 🙏 Penghargaan

-   [Tim Laravel](https://laravel.com/) untuk framework yang luar biasa
-   [Spatie](https://spatie.be/) untuk package permission
-   [Tailwind CSS](https://tailwindcss.com/) untuk framework CSS utility-first
-   [SweetAlert2](https://sweetalert2.github.io/) untuk alert yang cantik
-   [Midtrans](https://midtrans.com/) untuk payment gateway terpercaya

---

<p align="center">
  <strong>Dibuat dengan ❤️ menggunakan Laravel untuk kemajuan olahraga Indonesia</strong>
</p>

<p align="center">
  <a href="#-breezeshield---aplikasi-booking-lapangan-futsal">Kembali ke atas</a>
</p>
