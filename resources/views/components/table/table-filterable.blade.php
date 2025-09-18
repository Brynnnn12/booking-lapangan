@props([
    'headers' => [],
    'data' => [],
    'searchable' => true,
    'searchPlaceholder' => 'Cari...',
    'emptyMessage' => 'Tidak ada data ditemukan',
    'emptyIcon' => 'fas fa-search',
])

<div x-data="tableFilterable()" class="w-full">
    <!-- Search Component -->
    @if ($searchable)
        <x-search-filter :placeholder="$searchPlaceholder" :data="$data" x-on:search-updated="updateSearch($event.detail.query)" />
    @endif

    <!-- Table -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <!-- Table Header -->
            <thead class="bg-gray-50">
                <tr>
                    @foreach ($headers as $header)
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200">
                <template x-for="(item, index) in filteredData" :key="index">
                    <tr class="hover:bg-gray-50 transition-colors">
                        {{ $slot }}
                    </tr>
                </template>

                <!-- Empty State -->
                <tr x-show="filteredData.length === 0" x-transition>
                    <td :colspan="$headers->count()" class="px-6 py-12 text-center">
                        <div class="text-gray-500">
                            <i :class="$emptyIcon" class="text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium" x-text="$emptyMessage"></p>
                            <p class="mt-2" x-show="searchQuery.length > 0">
                                Coba ubah kata kunci pencarian Anda
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Results Count -->
    <div x-show="filteredData.length > 0" class="mt-4 text-sm text-gray-600">
        Menampilkan <span x-text="filteredData.length" class="font-medium"></span> hasil
        <span x-show="searchQuery.length > 0">
            untuk "<span x-text="searchQuery" class="font-medium"></span>"
        </span>
    </div>
</div>

<script>
    function tableFilterable() {
        return {
            originalData: @json($data),
            filteredData: @json($data),
            searchQuery: '',

            updateSearch(query) {
                this.searchQuery = query;
                if (query.length === 0) {
                    this.filteredData = this.originalData;
                } else {
                    this.filteredData = this.originalData.filter(item => {
                        // Search in all string properties
                        return Object.values(item).some(value => {
                            if (typeof value === 'string') {
                                return value.toLowerCase().includes(query.toLowerCase());
                            }
                            return false;
                        });
                    });
                }
            }
        }
    }
</script>
