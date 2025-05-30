<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>

<body class="antialiased" x-data="{ 
    openNotificationModal: false,
    init() {
        // This $watch is no longer needed as the modal component handles its own data fetching
        // this.$watch('openNotificationModal', (value) => {
        //     if (value) {
        //         loadNotificationsModal();
        //     }
        // });
    }
}">
   @include('partials.nav')

   @yield('banner')

   @yield('main')

   @include('partials.footer')

   <!-- SweetAlert2 JS -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
   @stack('scripts')

   @include('sweetalert::alert')

   <!-- Notification Modal (Alpine.js) -->
   @include('components.notification-modal')

</body>
</html>

@push('scripts')
<script>
    // Keep updateNotifications for the badge
    function updateNotifications() {
        fetch('/notifications/unread-count')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('notification-badge');
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            });
    }

    // This function loads notifications into the modal
    // This is now handled within the notification-modal component itself
    // function loadNotificationsModal() { ... }

    function getNotificationIcon(type) {
        switch(type) {
            case 'order_status':
                return 'fa-shopping-bag';
            case 'new_product':
                return 'fa-box';
            case 'discount':
                return 'fa-tag';
             case 'admin_notification':
                return 'fa-bell'; // Assuming a default bell for admin notifications
            default:
                return 'fa-bell';
        }
    }

    // Update notification count every minute
    setInterval(updateNotifications, 60000);
    
    // Initial load of count
    updateNotifications();

</script>
@endpush