@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <div class="w-full text-center">
        <h1 class="font-poppins text-3xl uppercase font-bold text-white">Login</h1>
        <p class="text-gray-200 text-sm capitalize mt-1">Sistem informasi pondok darul huda kutacane</p>
    </div>
    <form action="{{ route('login.proses') }}" method="POST"
        class="w-full mt-2 rounded-lg shadow-lg p-5 border bg-white text-hitam">
        @if (session('error'))
            <section id="alert-danger" class="w-full h-12 flex items-center px-3 bg-red-400 text-white mb-3">
                <p>{{ session('error') }}</p>
            </section>
        @endif
        @csrf
        <div class="mb-4">
            <label for="email" class="block mb-2 font-medium">Email</label>
            <input type="email" name="email" id="email"
                class="outline-none w-full rounded-md h-12 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('email') border-red-500 @enderror"
                placeholder="email@example.com" value="{{ old('email') }}">
            @error('email')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-4">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block font-medium">Password</label>
                <a href="" onclick="return false"
                    class="outline-none capitalize text-gray-600 text-sm underline underline-offset-2 active:text-green-500 focus:text-green-500">forgot
                    password?</a>
            </div>
            <div class="relative w-full">
                <input type="password" name="password" id="password"
                    class="outline-none w-full rounded-md h-12 pl-3 pr-12 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('password')
                        border-red-500
                    @enderror"
                    placeholder="******" value="{{ old('password') }}">
                <button type="button" onclick="passwordShow(event)"
                    class="absolute top-[0.30rem] right-2 text-gray-500 active:text-green-500 w-10 h-10 flex items-center justify-center outline-none focus:text-green-500">
                    <span id="icon" class="material-symbols-outlined">
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
                class="w-full h-11 flex items-center justify-center uppercase font-medium bg-green-500 rounded-md shadow transition duration-300 text-white hover:bg-green-600 focus:bg-green-600 outline-none">login</button>
            <p class="text-center">Belum mempunyai akun? <a href="{{ route('register') }}"
                    class="outline-none underline underline-offset-2 text-green-500 transition duration-300 active:text-green-600">Register.</a>
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
