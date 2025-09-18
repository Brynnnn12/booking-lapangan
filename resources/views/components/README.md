# Advanced Table Components

Komponen-komponen untuk membuat tabel dengan fitur pencarian real-time dan pagination yang advanced.

## Struktur Folder Lengkap

```
resources/views/components/
├── app/                        # Komponen aplikasi spesifik
│   └── application-logo.blad## Kategori Folder & Fungsi

### 🎯 **app/** - Komponen Aplikasi Spesifik
Komponen yang spesifik untuk aplikasi ini seperti logo aplikasi.

### 🔐 **auth/** - Komponen Autentikasi
Komponen yang berkaitan dengan autentikasi pengguna seperti status sesi.

### 📊 **dashboard/** - Komponen Dashboard
Komponen khusus untuk layout dashboard seperti sidebar, header, dll.

### 💬 **feedback/** - Komponen Feedback & Notifikasi
Komponen untuk menampilkan pesan feedback seperti flash messages dan alerts.

### 📝 **form/** - Komponen Form
Komponen untuk form inputs dan validasi (untuk pengembangan future).

### 🎨 **layout/** - Komponen Layout
Komponen untuk layout utama aplikasi seperti dashboard layout.

### 🧭 **navigation/** - Komponen Navigasi
Komponen untuk navigasi seperti dropdown menu, nav links, dll.

### 📄 **pagination/** - Komponen Pagination
Komponen untuk pagination dan kontrol jumlah data per halaman.

### 🔍 **search/** - Komponen Pencarian
Komponen untuk fitur pencarian dan filter data.

### 📋 **table/** - Komponen Tabel
Komponen untuk menampilkan data dalam format tabel.

### 🎛️ **ui/** - Komponen UI Umum
Komponen UI dasar seperti buttons, inputs, cards, modals, dll.├── auth/                        # Komponen autentikasi
│   └── auth-session-status.blade.php
├── dashboard/                   # Komponen dashboard
│   ├── header.blade.php
│   ├── mobile-sidebar.blade.php
│   └── sidebar.blade.php
├── feedback/                    # Komponen feedback & notifikasi
│   └── flash-messages.blade.php
├── form/                        # Komponen form (untuk pengembangan future)
├── layout/                      # Komponen layout
│   └── dashboard.blade.php
├── navigation/                  # Komponen navigasi
│   ├── dropdown-link.blade.php
│   ├── dropdown.blade.php
│   ├── nav-link.blade.php
│   └── responsive-nav-link.blade.php
├── pagination/                  # Komponen pagination
│   ├── data-per-page-selector.blade.php
│   ├── enhanced-pagination.blade.php
│   └── pagination.blade.php
├── search/                      # Komponen pencarian
│   ├── search-filter.blade.php
│   └── search-results-info.blade.php
├── table/                       # Komponen tabel
│   ├── table-filterable.blade.php
│   └── table.blade.php
└── ui/                          # Komponen UI umum
    ├── button.blade.php
    ├── card.blade.php
    ├── danger-button.blade.php
    ├── input.blade.php
    ├── input-error.blade.php
    ├── input-label.blade.php
    ├── modal.blade.php
    ├── primary-button.blade.php
    ├── secondary-button.blade.php
    ├── sweet-alert.blade.php
    ├── sweet-confirm.blade.php
    ├── sweet-input.blade.php
    ├── sweet-modal.blade.php
    └── text-input.blade.php
```

## Komponen yang Tersedia

### 1. Search Components (`x-search.*`)

#### `x-search.search-filter`

Komponen untuk pencarian real-time menggunakan Alpine.js.

**Props:**

-   `placeholder` (string): Placeholder text untuk input search
-   `value` (string): Nilai awal search query
-   `name` (string): Nama field untuk form submission

**Fitur:**

-   Real-time filtering dengan debounce 300ms
-   Clear button untuk menghapus filter
-   Emit event `search-updated` untuk parent component

**Contoh Penggunaan:**

```blade
<x-search.search-filter
    placeholder="Cari berdasarkan nama..."
    :value="request('search')"
    name="search"
/>
```

#### `x-search.search-results-info`

Komponen untuk menampilkan informasi hasil pencarian.

**Props:**

-   `total` (int): Total data
-   `filtered` (int): Jumlah data yang difilter
-   `searchQuery` (string): Query pencarian
-   `show` (bool): Tampilkan komponen

**Fitur:**

-   Informasi hasil pencarian
-   Link untuk clear filter
-   Conditional display

**Contoh Penggunaan:**

```blade
<x-search.search-results-info
    :total="$paginator->total()"
    :filtered="$paginator->count()"
    :search-query="request('search')"
    show="true"
/>
```

### 2. Pagination Components (`x-pagination.*`)

#### `x-pagination.enhanced-pagination`

Komponen pagination yang comprehensive dengan informasi detail.

**Props:**

-   `paginator` (object): Laravel paginator instance
-   `showInfo` (bool): Tampilkan info pagination (default: true)
-   `showPerPage` (bool): Tampilkan selector per page (default: true)
-   `perPageOptions` (array): Opsi jumlah data per halaman

**Fitur:**

-   Informasi lengkap tentang hasil
-   Selector jumlah data per halaman
-   Responsive layout
-   Preserve query parameters

**Contoh Penggunaan:**

```blade
<x-pagination.enhanced-pagination
    :paginator="$items"
    show-info="true"
    show-per-page="true"
    :per-page-options="[10, 25, 50, 100]"
/>
```

#### `x-pagination.data-per-page-selector`

Komponen untuk memilih jumlah data per halaman.

**Props:**

-   `perPage` (int): Jumlah data per halaman saat ini
-   `options` (array): Array opsi jumlah data [10, 25, 50, 100]
-   `route` (string): URL untuk form submission (opsional)

**Fitur:**

-   Auto-submit form saat pilihan berubah
-   Preserve query parameters lainnya
-   Responsive design

**Contoh Penggunaan:**

```blade
<x-pagination.data-per-page-selector
    :per-page="$paginator->perPage()"
    :options="[10, 25, 50, 100]"
/>
```

### 3. Table Components (`x-table.*`)

#### `x-table.table-filterable`

Komponen tabel dengan filtering menggunakan Alpine.js.

**Props:**

-   `headers` (array): Array header tabel
-   `data` (array): Data untuk tabel
-   `searchable` (bool): Enable search functionality
-   `searchPlaceholder` (string): Placeholder untuk search
-   `emptyMessage` (string): Pesan saat tidak ada data
-   `emptyIcon` (string): Icon untuk empty state

**Fitur:**

-   Real-time filtering
-   Empty state dengan icon
-   Responsive design
-   Alpine.js integration

**Contoh Penggunaan:**

```blade
<x-table.table-filterable
    :headers="['ID', 'Nama', 'Aksi']"
    :data="$items"
    searchable="true"
    empty-message="Tidak ada data ditemukan"
    empty-icon="fas fa-search"
>
    <!-- Table rows content -->
</x-table.table-filterable>
```

## Setup Alpine.js

Pastikan Alpine.js sudah ditambahkan ke layout:

```blade
<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

## Controller Setup

Untuk menggunakan fitur pencarian dan pagination, update controller:

```php
public function index(Request $request)
{
    $query = Field::query();

    // Search functionality
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
        });
    }

    // Pagination with per_page
    $perPage = $request->get('per_page', 10);
    $fields = $query->paginate($perPage)->appends($request->query());

    return view('dashboard.fields.index', compact('fields'));
}
```

## Contoh Lengkap Penggunaan

```blade
<x-layout.dashboard title="Manajemen Data">
    <x-card>
        <x-slot name="header">
            <h3>Data Management</h3>
            <x-button variant="primary" icon="fas fa-plus">
                Tambah Data
            </x-button>
        </x-slot>

        <!-- Search Component -->
        <x-search.search-filter
            placeholder="Cari data..."
            :value="request('search')"
            name="search"
        />

        <!-- Table with Filtering -->
        <x-table.table-filterable
            :headers="['ID', 'Nama', 'Aksi']"
            :data="$items"
            searchable="false"
        >
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <x-button size="xs" variant="outline">Edit</x-button>
                    </td>
                </tr>
            @endforeach
        </x-table.table-filterable>

        <!-- Results Info -->
        <x-search.search-results-info
            :total="$paginator->total()"
            :filtered="$paginator->count()"
            :search-query="request('search')"
        />

        <!-- Enhanced Pagination -->
        <x-pagination.enhanced-pagination
            :paginator="$paginator"
            :per-page-options="[10, 25, 50, 100]"
        />
    </x-card>
</x-layout.dashboard>
```

## Keuntungan Struktur Folder

-   **📁 Organisasi yang Jelas**: Komponen dikelompokkan berdasarkan fungsi
-   **🔍 Mudah Dicari**: Developer dapat dengan cepat menemukan komponen yang dibutuhkan
-   **🛠️ Maintenance**: Lebih mudah untuk update dan maintain komponen
-   **📚 Scalability**: Mudah untuk menambah komponen baru ke kategori yang sesuai
-   **👥 Collaboration**: Tim dapat bekerja pada komponen yang berbeda tanpa konflik

## Fitur Utama

-   ✅ **Real-time Search**: Pencarian langsung tanpa reload halaman
-   ✅ **Advanced Pagination**: Kontrol jumlah data per halaman
-   ✅ **Responsive Design**: Kompatibel dengan mobile dan desktop
-   ✅ **Alpine.js Integration**: Interaktivitas tanpa jQuery
-   ✅ **Laravel Integration**: Menggunakan Laravel pagination dan request
-   ✅ **Reusable Components**: Mudah digunakan di berbagai halaman
-   ✅ **Accessibility**: Support untuk screen readers dan keyboard navigation
-   ✅ **Organized Structure**: Struktur folder yang rapi dan terorganisir
