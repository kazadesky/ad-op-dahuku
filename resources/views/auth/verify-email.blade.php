@extends('layouts.auth')
@section('title', 'Verifikasi Email')

@section('content')
    <div class="flex justify-center h-screen items-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-md p-6 text-center max-md:text-sm">
            <h2 class="md:text-xl max-md:text-lg font-bold md:mb-4 max-md:mb-2 text-hitam">Verifikasi Email</h2>
            @if (session('email-verify'))
                <div id="banner-alert"
                    class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-3 -mt-1"
                    role="alert">
                    <span class="block sm:inline">{{ session('email-verify') }}</span>
                </div>
            @endif
            <p class="text-gray-600 md:mb-4 max-md:mb-3 max-md:leading-snug">Silakan verifikasi email Anda dengan mengklik link yang telah kami kirimkan ke
                alamat email Anda.</p>
            <form action="{{ route('resend-verify') }}" method="POST">
                @csrf
                <button type="submit"
                    class="outline-none transition duration-300 bg-elf-green hover:bg-dark-elf focus:bg-dark-elf text-white-text font-medium py-2 px-4 rounded shadow-sm">Kirim
                    Ulang Verifikasi</button>
            </form>
        </div>
    </div>
@endsection
