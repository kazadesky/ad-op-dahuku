@extends('layouts.app')
@section('title', 'Ganti Password')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white">
        @hasrole('super_admin')
            <span>Super Admin</span>
        @endhasrole
        @hasrole('admin')
            <span>Admin</span>
        @endhasrole
        @hasrole('operator')
            <span>Operator</span>
        @endhasrole
        @hasrole('teacher')
            <span>Teacher</span>
        @endhasrole
        <span>/ Page / Ganti Password</span>
    </p>
@endsection

@section('content')
    @if (session('success'))
        <div id="banner-success" class="mb-4 p-4 bg-green-100 text-green-800 rounded-md flex items-center justify-between">
            {{ session('success') }}
            <button type="button" onclick="successBanner(event)" class="rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined">
                    close
                </span>
            </button>
        </div>
    @elseif(session('error'))
        <div id="error-banner" class="mb-4 p-4 bg-red-100 text-red-800 rounded-md flex items-center justify-between">
            {{ session('error') }}
            <button type="button" onclick="errorBanner(event)" class="rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined">
                    close
                </span>
            </button>
        </div>
    @endif

    <form @hasrole('super_admin')
    action="{{ route('sa.password.update', $user->id) }}"
    @endhasrole
        @hasrole('admin')
    action="{{ route('admin.password.update', $user->id) }}"
    @endhasrole
        @hasrole('operator')
    action="{{ route('operator.password.update', $user->id) }}"
    @endhasrole
        @hasrole('teacher')
    action="{{ route('teacher.password.update', $user->id) }}"
    @endhasrole method="POST"
        class="bg-white w-full md:rounded-lg max-md:rounded-md border-1 shadow-lg md:p-8 max-md:p-5 max-md:text-sm">
        @csrf
        @method('PUT')
        <div class="md:mb-4 max-md:mb-3">
            <label for="current_password" class="block md:mb-2 max-md:mb-1 font-medium">Password Lama</label>
            <div class="relative w-full">
                <input type="password" name="current_password" id="current_password"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 pl-3 pr-12 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('current_password')
                    border-red-500
                @enderror"
                    placeholder="******" value="{{ old('current_password') }}">
                <button type="button" onclick="currentPassword(event)"
                    class="absolute md:top-[0.30rem] max-md:top-[0.20rem] md:right-2 max-md:right-[4px] text-gray-500 active:text-elf-green w-10 h-10 flex items-center justify-center outline-none focus:text-elf-green">
                    <span id="icon_current" class="material-symbols-outlined">
                        visibility
                    </span>
                </button>
            </div>
            @error('current_password')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="md:mb-4 max-md:mb-3">
            <label for="password" class="block md:mb-2 max-md:mb-1 font-medium">Password Baru</label>
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
        <button type="submit"
            class="w-full md:h-11 max-md:h-10 flex items-center justify-center uppercase font-medium bg-elf-green rounded-md shadow transition duration-300 text-white hover:bg-dark-elf focus:bg-dark-elf outline-none max-md:text-sm">Simpan</button>
    </form>
@endsection

@push('script')
    <script>
        const successBanner = (event) => {
            event.preventDefault();
            document.getElementById("banner-success").classList.add("hidden");
        };

        const errorBanner = (event) => {
            event.preventDefault();
            document.getElementById("error-banner").classList.add("hidden");
        };
    </script>
@endpush
