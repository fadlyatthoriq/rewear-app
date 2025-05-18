<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    @stack('styles')
</head>

<body class="antialiased">
   @include('partials.nav')

   @yield('banner')

   @yield('main')

   @include('partials.footer')

   @stack('scripts')

   
   @include('sweetalert::alert')

</body>
</html>