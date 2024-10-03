<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Darul Huda Kutacane</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.jpg') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}"> --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body
    class="w-full h-screen flex items-center justify-center font-inter bg-gradient-to-tr from-elf-green to-hitam overflow-hidden">

    <figure class="w-full flex justify-center items-center flex-col space-y-5">
        <img src="{{ asset('img/logo.jpg') }}" alt="logo dahuku"
            class="welcome-fade md:size-64 max-md:size-44 rounded-full drop-shadow-lg">
        <figcaption
            class="title-load md:text-3xl max-md:text-2xl font-bold text-white-text drop-shadow-lg font-poppins flex items-center max-md:justify-center space-x-2 max-md:text-center">
            <span class="custom-loader max-md:size-11"></span>
            <span>Darul Huda Kutacane</span>
        </figcaption>
    </figure>

    <script>
        setTimeout(() => {
            window.location.href = "{{ route('login') }}";
        }, 5000);
    </script>
</body>

</html>
