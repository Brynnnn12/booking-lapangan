@props(['name', 'title' => '', 'show' => false, 'maxWidth' => '2xl', 'closeable' => true])

@php
    $maxWidthClasses = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
    ];

    $maxWidthClass = $maxWidthClasses[$maxWidth] ?? $maxWidthClasses['2xl'];
@endphp

<div x-data="{
    show: @js($show),
    modalName: '{{ $name }}',
    open() {
        this.show = true;
        document.body.style.overflow = 'hidden';
    },
    close() {
        this.show = false;
        document.body.style.overflow = 'auto';
    }
}" x-init="$watch('show', value => {
    if (value) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = 'auto';
    }
});"
    x-on:open-modal.window="if ($event.detail === '{{ $name }}') open()"
    x-on:close-modal.window="if ($event.detail === '{{ $name }}') close()"
    x-on:keydown.escape.window="show && close()" x-show="show" x-cloak class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;">
    <!-- Backdrop -->
    <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="close()"></div>

    <!-- Modal Container -->
    <div class="flex min-h-screen items-center justify-center p-4">
        <div x-show="show" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-10"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-10"
            class="relative w-full {{ $maxWidthClass }} transform rounded-lg bg-white shadow-xl transition-all"
            @click.stop>
            @if ($title)
                <!-- Header -->
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                    @if ($closeable)
                        <button @click="close()"
                            class="rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    @endif
                </div>
            @endif

            <!-- Body -->
            <div class="px-6 py-4">
                {{ $slot }}
            </div>

            @isset($footer)
                <!-- Footer -->
                <div class="flex justify-end space-x-3 border-t border-gray-200 px-6 py-4">
                    {{ $footer }}
                </div>
            @endisset
        </div>
    </div>
</div>
