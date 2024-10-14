@extends('layouts.auth')
@section('title', 'Lupa Password')

@section('content')
    <div class="w-full text-center">
        <h1 class="font-poppins md:text-3xl max-md:text-2xl uppercase font-bold text-white">Forgot Password</h1>
        <p class="text-gray-200 text-sm capitalize mt-1">Enter your email to reset your password</p>
    </div>
    <form action="{{ route('password.email') }}" method="POST"
        class="w-full mt-2 rounded-lg shadow-lg p-5 border bg-white text-hitam max-md:text-sm">
        @if (session('error'))
            <section id="alert-danger" class="w-full md:h-12 max-md:h-11 flex items-center px-3 bg-red-400 text-white mb-3">
                <p>{{ session('error') }}</p>
            </section>
        @endif
        @csrf
        <section class="md:mb-4 max-md:mb-3">
            <label for="email" class="block md:mb-2 max-md:mb-1 font-medium">Email</label>
            <input type="email" name="email" id="email"
                class="outline-none w-full rounded-md h-12 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('email') border-red-500 @enderror"
                placeholder="email@example.com" value="{{ old('email') }}">
            @error('email')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </section>
        <section class="mt-2 flex flex-col items-center justify-center space-y-2">
            <button type="submit"
                class="w-full md:h-11 max-md:h-10 flex items-center justify-center uppercase font-medium bg-elf-green rounded-md shadow transition duration-300 text-white hover:bg-dark-elf focus:bg-dark-elf outline-none max-md:capitalize">Send
                Password Reset Link</button>
            <a href="{{ route('login') }}"
                class="outline-none underline underline-offset-2 text-elf-green transition duration-300 active:text-dark-elf text-center">Back
                to Login.</a>
        </section>
    </form>
@endsection
