<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin - {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" type="image/x-icon">

    <!-- Styles -->
    @vite('public/assets-admin/src/style.css')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

</head>
<body>
    @include('partials.nav-admin')

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        @include('partials.side-admin')

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                @yield('content')
            </main>

            @include('partials.footer-admin')
        </div>
    </div>

    @stack('scripts')

    @include('sweetalert::alert')


    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('assets-admin/src/constants.js') }}"></script>
    <script src="{{ asset('assets-admin/src/index.js') }}"></script>
    <script src="{{ asset('assets-admin/src/charts.js') }}"></script>
    <script src="{{ asset('assets-admin/src/dark-mode.js') }}"></script>
    <script src="{{ asset('assets-admin/src/sidebar.js') }}"></script>

</body>
</html>