# 🛡️ BreezeShield

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

<p align="center">
  <strong>🚀 Aplikasi Laravel siap pakai dengan autentikasi, manajemen role, dan UI yang indah</strong>
</p>

## 📋 Tentang BreezeShield

BreezeShield adalah aplikasi Laravel yang telah dikonfigurasi sebelumnya dan menyediakan fondasi yang solid untuk membangun aplikasi web modern. Dilengkapi dengan semua yang Anda butuhkan untuk mulai mengembangkan aplikasi dengan cepat - autentikasi, kontrol akses berbasis role, komponen UI yang indah, dan lainnya.

### ✨ Fitur Utama

-   🔐 **Sistem Autentikasi Lengkap** - Menggunakan Laravel Breeze
-   👥 **Manajemen Role & Permission** - Menggunakan Spatie Laravel Permission
-   🎨 **UI Dashboard yang Indah** - Desain modern dan responsif
-   🔔 **Integrasi Sweet Alert** - Alert dan notifikasi yang cantik
-   📱 **Responsif Mobile** - Bekerja sempurna di semua perangkat
-   🎯 **Siap untuk Operasi CRUD** - Tinggal tambahkan logika bisnis Anda
-   🛡️ **Aman Secara Default** - Mengikuti praktik terbaik Laravel

## 🛠️ Stack Teknologi

-   **Backend**: Laravel 11.x
-   **Frontend**: Blade Templates + Tailwind CSS
-   **Autentikasi**: Laravel Breeze
-   **Manajemen Role**: Spatie Laravel Permission
-   **Alert**: SweetAlert2
-   **Database**: MySQL/PostgreSQL/SQLite
-   **Styling**: Tailwind CSS + Komponen Custom

## 📦 Yang Sudah Disediakan

### 🔐 Sistem Autentikasi

-   Registrasi dan login pengguna
-   Fungsi reset password
-   Verifikasi email
-   Fungsi remember me
-   Manajemen profil

### 👥 Sistem Role & Permission

-   Role yang sudah dikonfigurasi (Admin, User)
-   Kontrol akses berbasis permission
-   Interface assignment role
-   Proteksi middleware

### 🎨 Komponen UI

-   Layout dashboard modern
-   Navigasi responsif
-   Halaman welcome yang indah
-   Notifikasi alert
-   Komponen form
-   Tabel data siap pakai

### 🔔 Sistem Notifikasi

-   Integrasi SweetAlert
-   Alert Success/Error/Warning
-   Notifikasi toast
-   Dialog konfirmasi

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
    DB_DATABASE=breezeshield
    DB_USERNAME=username_anda
    DB_PASSWORD=password_anda
    ```

6. **Jalankan migrasi dan seeder**

    ```bash
    php artisan migrate --seed
    ```

7. **Build asset**

    ```bash
    npm run build
    ```

8. **Jalankan aplikasi**
    ```bash
    php artisan serve
    ```

Kunjungi `http://localhost:8000` untuk melihat aplikasi Anda!

## 👤 User Default

Setelah seeding, Anda dapat login dengan:

**User Admin:**

-   Email: `admin@example.com`
-   Password: `password`
-   Role: Admin

**User Biasa:**

-   Email: `user@example.com`
-   Password: `password`
-   Role: User

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
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Model Eloquent
│   ├── Policies/            # Policy otorisasi
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Migrasi database
│   └── seeders/            # Seeder database
├── resources/
│   ├── views/              # Template Blade
│   ├── css/                # Stylesheet
│   └── js/                 # File JavaScript
├── routes/
│   ├── web.php            # Routes web
│   └── auth.php           # Routes autentikasi
└── public/                # Asset publik
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

## 📚 Dokumentasi & Sumber Daya

-   [Dokumentasi Laravel](https://laravel.com/docs)
-   [Dokumentasi Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)
-   [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
-   [Dokumentasi Tailwind CSS](https://tailwindcss.com/docs)
-   [Dokumentasi SweetAlert2](https://sweetalert2.github.io/)

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan buat Pull Request. Untuk perubahan besar, silakan buka issue terlebih dahulu untuk mendiskusikan apa yang ingin Anda ubah.

1. Fork project
2. Buat feature branch Anda (`git checkout -b feature/FiturKeren`)
3. Commit perubahan Anda (`git commit -m 'Tambah FiturKeren'`)
4. Push ke branch (`git push origin feature/FiturKeren`)
5. Buka Pull Request

## 📝 Changelog

### Versi 1.0.0

-   Rilis awal dengan Laravel Breeze
-   Integrasi sistem role dan permission
-   Implementasi SweetAlert
-   Desain dashboard custom
-   Halaman welcome responsif

## 🐛 Issues & Support

Jika Anda mengalami masalah atau membutuhkan dukungan:

1. Periksa [issues](https://github.com/username/breezeshield/issues) yang sudah ada
2. Buat issue baru dengan informasi detail
3. Sertakan langkah-langkah untuk mereproduksi masalah

## 📄 Lisensi

Project ini dilisensikan di bawah MIT License - lihat file [LICENSE](LICENSE) untuk detail.

## 🙏 Penghargaan

-   [Tim Laravel](https://laravel.com/) untuk framework yang luar biasa
-   [Spatie](https://spatie.be/) untuk package permission
-   [Tailwind CSS](https://tailwindcss.com/) untuk framework CSS utility-first
-   [SweetAlert2](https://sweetalert2.github.io/) untuk alert yang cantik

---

<p align="center">
  <strong>Dibuat dengan ❤️ menggunakan Laravel</strong>
</p>

<p align="center">
  <a href="#-breezeshield">Kembali ke atas</a>
</p>
