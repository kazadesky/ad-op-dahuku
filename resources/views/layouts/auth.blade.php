<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title') | Darul Huda Kutacane</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.webp') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- PWA  -->
    <meta name="theme-color" content="#1e1f1e" />
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DsV4i52r.css') }}">
    {{-- @vite(['resources/js/app.js', 'resources/css/app.css']) --}}
</head>

<body
    class="w-full flex items-center flex-col font-inter bg-gradient-to-tr from-elf-green to-hitam {{ request()->routeIs(['login', 'password.request', 'password.reset']) ? 'overflow-hidden justify-center h-screen' : 'overflow-x-hidden min-h-screen max-md:pb-10' }}">

    @include('components.alert')

    <section
        class="faded-out w-full max-md:max-w-sm sm:max-w-md z-10 max-md:px-5 {{ request()->routeIs('register') ? 'md:py-10' : 'flex flex-col space-y-3 items-center' }}">
        @yield('content')
    </section>

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
    @stack('script')
</body>

</html>
