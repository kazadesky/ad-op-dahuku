@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <div class="w-full text-center">
        <h1 class="font-poppins text-3xl uppercase font-bold text-white">Login</h1>
        <p class="text-gray-200 text-sm capitalize mt-1">Sistem informasi pondok darul huda kutacane</p>
    </div>
    <form action="{{ route('login.proses') }}" method="POST"
        class="w-full mt-2 rounded-lg shadow-lg p-5 border bg-white text-hitam max-md:text-sm">
        @if (session('error'))
            <section id="alert-danger" class="w-full md:h-12 max-md:h-11 flex items-center px-3 bg-red-400 text-white mb-3">
                <p>{{ session('error') }}</p>
            </section>
        @endif
        @csrf
        <div class="md:mb-4 max-md:mb-3">
            <label for="email" class="block md:mb-2 max-md:mb-1 font-medium">Email</label>
            <input type="email" name="email" id="email"
                class="outline-none w-full rounded-md h-12 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('email') border-red-500 @enderror"
                placeholder="email@example.com" value="{{ old('email') }}">
            @error('email')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="md:mb-4 max-md:mb-3">
            <div class="flex items-center justify-between md:mb-2 max-md:mb-1">
                <label for="password" class="block font-medium">Password</label>
                <a href="" onclick="return false"
                    class="outline-none capitalize text-gray-600 md:text-sm max-md:text-xs underline underline-offset-2 active:text-elf-green focus:text-elf-green">forgot
                    password?</a>
            </div>
            <div class="relative w-full">
                <input type="password" name="password" id="password"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 pl-3 pr-12 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('password')
                        border-red-500
                    @enderror"
                    placeholder="******" value="{{ old('password') }}">
                <button type="button" onclick="passwordShow(event)"
                    class="absolute top-[0.30rem] right-2 text-gray-500 active:text-elf-green size-10 flex items-center justify-center outline-none focus:text-elf-green">
                    <span id="icon_pass" class="material-symbols-outlined max-md:text-[22px]">
                        visibility
                    </span>
                </button>
            </div>
            @error('password')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <section class="mt-2 flex flex-col items-center justify-center space-y-2">
            <button type="submit"
                class="w-full md:h-11 max-md:h-10 flex items-center justify-center uppercase font-medium bg-elf-green rounded-md shadow transition duration-300 text-white hover:bg-dark-elf focus:bg-dark-elf outline-none">login</button>
            <p class="text-center">Belum mempunyai akun? <a href="{{ route('register') }}"
                    class="outline-none underline underline-offset-2 text-elf-green transition duration-300 active:text-dark-elf">Register.</a>
            </p>
        </section>
    </form>
@endsection

@push('script')
    <script>
        const alertDanger = document.querySelector('#alert-danger');
        setTimeout(() => {
            alertDanger.classList.add('hidden');
        }, 5000);
    </script>
@endpush
