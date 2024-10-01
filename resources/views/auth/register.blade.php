@extends('layouts.auth')
@section('title', 'Register')

@section('content')
    <div class="w-full text-center max-md:pt-12">
        <h1 class="font-poppins text-3xl uppercase font-bold text-white">Register</h1>
        <p class="text-gray-200 text-sm capitalize mt-1">Sistem informasi pondok darul huda kutacane</p>
    </div>
    <form action="{{ route('register.proses') }}" method="POST" enctype="multipart/form-data"
        class="w-full mt-2 rounded-lg shadow-lg p-5 border bg-white text-hitam max-md:text-sm">
        @csrf
        <div id="preview-figure" class="hidden mb-3 w-full flex-col items-center space-y-2">
            <figure class="size-28 overflow-hidden rounded">
                <img id="preview" src="" alt="Gambar Profil" class="w-full">
            </figure>
            <figcaption class="text-center font-medium text-sm">Preview Foto Profil</figcaption>
        </div>
        <div class="md:mb-4 max-md:mb-3">
            <label for="profile" class="block md:mb-2 max-md:mb-1 font-medium">Foto Profil</label>
            <input type="file" name="profile" onchange="profilePreview(event)" id="profile"
                class="outline-none w-full rounded-md md:h-12 max-md:h-11 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 file:outline-none file:h-full file:border-none file:cursor-pointer file:hover:bg-gray-200 file:transition file:duration-300 file:active:bg-gray-200 file:rounded-l-md @error('profile') border-red-500 @enderror"
                value="{{ old('profile') }}">
            @error('profile')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="md:mb-4 max-md:mb-3">
            <label for="name" class="block md:mb-2 max-md:mb-1 font-medium">Nama Lengkap</label>
            <input type="text" name="name" id="name"
                class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror"
                placeholder="Name Lengkap" value="{{ old('name') }}">
            @error('name')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="md:mb-4 max-md:mb-3">
            <label for="email" class="block md:mb-2 max-md:mb-1 font-medium">Email</label>
            <input type="email" name="email" id="email"
                class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('email') border-red-500 @enderror"
                placeholder="email@example.com" value="{{ old('email') }}">
            @error('email')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="md:mb-4 max-md:mb-3">
            <label for="nomor_telepon" class="block md:mb-2 max-md:mb-1 font-medium">Nomor Telepon</label>
            <input type="number" name="nomor_telepon" id="nomor_telepon"
                class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('nomor_telepon') border-red-500 @enderror"
                placeholder="0822xxxxxxxx" value="{{ old('nomor_telepon') }}">
            @error('nomor_telepon')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="md:mb-4 max-md:mb-3">
            <label for="password" class="block md:mb-2 max-md:mb-1 font-medium">Password</label>
            <div class="relative w-full">
                <input type="password" name="password" id="password"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 pl-3 pr-12 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('password')
                        border-red-500
                    @enderror"
                    placeholder="******" value="{{ old('password') }}">
                <button type="button" onclick="passwordShow(event)"
                    class="absolute top-[0.30rem] right-2 text-gray-500 active:text-elf-green w-10 h-10 flex items-center justify-center outline-none focus:text-elf-green">
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
                    class="absolute top-[0.30rem] right-2 text-gray-500 active:text-elf-green w-10 h-10 flex items-center justify-center outline-none focus:text-elf-green">
                    <span id="icon_confirm" class="material-symbols-outlined">
                        visibility
                    </span>
                </button>
            </div>
            @error('password_confirmation')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="md:mb-4 max-md:mb-3">
            <label for="teacher_status" class="block md:mb-2 max-md:mb-1 font-medium">Status</label>
            <select name="teacher_status" id="teacher_status" size="-1"
                class="outline-none w-full rounded-md md:h-12 max-md:h-11 pl-3 pr-12 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('teacher_status')
                        border-red-500
                    @enderror">
                <option value="" hidden>Pilih Status</option>
                @foreach ($status as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
            @error('teacher_status')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <section class="mt-2 flex flex-col items-center justify-center space-y-2">
            <button type="submit"
                class="w-full md:h-11 max-md:h-10 flex items-center justify-center uppercase font-medium bg-elf-green rounded-md shadow transition duration-300 text-white hover:bg-dark-elf focus:bg-dark-elf outline-none">daftar</button>
            <p class="text-center">Sudah mempunyai akun? <a href="{{ route('login') }}"
                    class="outline-none underline underline-offset-2 text-elf-green transition duration-300 active:text-dark-elf">Login.</a>
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
