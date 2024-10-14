@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
    <div class="w-full text-center max-md:pt-12">
        <h1 class="font-poppins md:text-3xl max-md:text-2xl uppercase font-bold text-white">Reset Password</h1>
        <p class="text-gray-200 text-sm capitalize mt-1">Please enter your new password</p>
    </div>
    <form action="{{ route('password.update') }}" method="POST" enctype="multipart/form-data"
        class="w-full mt-2 rounded-lg shadow-lg p-5 border bg-white text-hitam max-md:text-sm">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div class="md:mb-4 max-md:mb-3">
            <label for="password" class="block md:mb-2 max-md:mb-1 font-medium">Password</label>
            <div class="relative w-full">
                <input type="password" name="password" id="password"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 pl-3 pr-12 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('password')
                    border-red-500
                @enderror"
                    placeholder="******" value="{{ old('password') }}">
                <button type="button" onclick="passwordShow(event)"
                    class="absolute md:top-[0.30rem] max-md:top-[0.20rem] md:right-2 max-md:right-[4px] text-gray-500 active:text-elf-green w-10 h-10 flex items-center justify-center outline-none focus:text-elf-green">
                    <span id="icon_pass" class="material-symbols-outlined">
                        visibility
                    </span>
                </button>
            </div>
            @error('password')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="md:mb-4 max-md:mb-3">
            <label for="password_confirmation" class="block md:mb-2 max-md:mb-1 font-medium">Konfirmasi Password</label>
            <div class="relative w-full">
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 pl-3 pr-12 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('password_confirmation')
                    border-red-500
                @enderror"
                    placeholder="******" value="{{ old('password') }}">
                <button type="button" onclick="passwordConfirmShow(event)"
                    class="absolute md:top-[0.30rem] max-md:top-[0.20rem] md:right-2 max-md:right-[4px] text-gray-500 active:text-elf-green w-10 h-10 flex items-center justify-center outline-none focus:text-elf-green">
                    <span id="icon_confirm" class="material-symbols-outlined">
                        visibility
                    </span>
                </button>
            </div>
            @error('password_confirmation')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <section class="mt-2 flex flex-col items-center justify-center space-y-2">
            <button type="submit"
                class="w-full md:h-11 max-md:h-10 flex items-center justify-center uppercase font-medium bg-elf-green rounded-md shadow transition duration-300 text-white hover:bg-dark-elf focus:bg-dark-elf outline-none">daftar</button>
            <a href="{{ route('login') }}"
                class="outline-none underline underline-offset-2 text-elf-green transition duration-300 active:text-dark-elf text-center">Back
                to Login.</a>
        </section>
    </form>
@endsection
