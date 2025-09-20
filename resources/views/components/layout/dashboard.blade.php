<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans" x-data="{ isSidebarOpen: false, activeTab: '{{ $title ?? 'Dashboard' }}' }">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <x-dashboard.sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <x-dashboard.header />

            <!-- Mobile Sidebar -->
            <x-dashboard.mobile-sidebar />



            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <x-feedback.flash-messages />

                {{ $slot }}
            </main>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script>
        // Global Modal Functions
        function openModal(name) {
            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: name
            }));
        }

        function closeModal(name) {
            window.dispatchEvent(new CustomEvent('close-modal', {
                detail: name
            }));
        }

        // SweetAlert utility functions
        function showSuccess(title, text) {
            Swal.fire({
                title: title,
                text: text,
                icon: 'success',
                confirmButtonColor: '#10b981',
                confirmButtonText: 'OK'
            });
        }

        function showError(title, text) {
            Swal.fire({
                title: title,
                text: text,
                icon: 'error',
                confirmButtonColor: '#dc2626',
                confirmButtonText: 'OK'
            });
        }

        function showConfirm(title, text, callback) {
            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed && callback) {
                    callback();
                }
            });
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Find any open modal and close it
                const openModals = document.querySelectorAll('[x-show="show"]');
                openModals.forEach(modal => {
                    if (modal.style.display !== 'none' && modal.__x) {
                        modal.__x.$data.show = false;
                    }
                });
            }
        });
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>
