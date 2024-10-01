@extends('layouts.app')
@section('title', 'Profil')

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
        <span>/ Page / Profil</span>
    </p>
@endsection

@section('content')
    <div id="modal-change-photo"
        class="animation-fade hidden fixed z-50 w-full md:max-w-screen-lg max-md:w-screen justify-center max-md:px-3 max-md:-ml-3">
        <form
            @hasrole('super_admin')
                action="{{ route('sa.profile.update-image', $user->id) }}"
            @endhasrole
            @hasrole('admin')
                action="{{ route('admin.profile.update-image', $user->id) }}"
            @endhasrole
            @hasrole('operator')
                action="{{ route('operator.profile.update-image', $user->id) }}"
            @endhasrole
            @hasrole('teacher')
                action="{{ route('teacher.profile.update-image', $user->id) }}"
            @endhasrole
            method="POST" enctype="multipart/form-data"
            class="w-full md:max-w-md max-md:w-full rounded-md shadow-lg p-5 bg-white max-sm:text-sm">
            @csrf
            @method('PUT')
            <h1 class="mb-5 font-poppins md:text-xl max-md:text-lg capitalize font-bold flex items-center">
                <span class="material-symbols-outlined text-3xl -ml-2">
                    photo_camera
                </span>
                <span>Ganti Foto Profil</span>
            </h1>

            <section class="w-full md:mb-4 max-md:mb-3">
                <label for="profile" class="font-medium block md:mb-2">
                    <span>Foto Profil</span>
                </label>
                <input type="file" name="profile" onchange="profilePreview(event)" id="profile"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 file:outline-none file:h-full file:border-none file:cursor-pointer file:hover:bg-gray-200 file:transition file:duration-300 file:active:bg-gray-200 file:rounded-l-md @error('profile') border-red-500 @enderror"
                    value="{{ old('profile', $user->profile) }}">
                @error('profile')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </section>

            <section class="flex flex-col md:space-y-3 max-md:space-y-2">
                <button type="submit"
                    class="outline-none text-white-text w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-green focus:bg-dark-green">Update</button>
                <a href="" onclick="showChangePhoto(event)"
                    class="text-center outline-none text-slate-800 underline underline-offset-2 transition duration-300 active:text-elf-green">Close</a>
            </section>
        </form>
    </div>

    <div id="modal-change-profile"
        class="animation-fade hidden fixed z-50 w-full md:max-w-screen-lg max-md:w-screen justify-center max-md:px-3 max-md:-ml-3">
        <form
            @hasrole('super_admin')
                action="{{ route('sa.profile.update-account', $user->id) }}"
            @endhasrole
            @hasrole('admin')
                action="{{ route('admin.profile.update-account', $user->id) }}"
            @endhasrole
            @hasrole('operator')
                action="{{ route('operator.profile.update-account', $user->id) }}"
            @endhasrole
            @hasrole('teacher')
                action="{{ route('teacher.profile.update-account', $user->id) }}"
            @endhasrole
            method="POST" enctype="multipart/form-data"
            class="w-full md:max-w-md max-md:w-full rounded-md shadow-lg p-5 bg-white max-sm:text-sm">
            @csrf
            @method('PATCH')
            <h1 class="mb-5 font-poppins md:text-xl max-md:text-lg capitalize font-bold flex items-center">
                <span class="material-symbols-outlined text-3xl -ml-2">
                    border_color
                </span>
                <span>Edit Profil Akun</span>
            </h1>

            <section class="w-full md:mb-4 max-md:mb-3">
                <label for="name" class="font-medium block md:mb-2">
                    <span>Nama Lengkap</span>
                </label>
                <input type="text" name="name" id="name"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 px-3 @error('name') border-red-500 @enderror"
                    value="{{ old('name', $user->name) }}">
                @error('name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </section>

            <section class="w-full md:mb-4 max-md:mb-3">
                <label for="email" class="font-medium block md:mb-2">
                    <span>Email</span>
                </label>
                <input type="email" name="email" id="email"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 px-3 @error('email') border-red-500 @enderror"
                    value="{{ old('email', $user->email) }}">
                @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </section>

            <section class="w-full md:mb-4 max-md:mb-3">
                <label for="nomor_telepon" class="font-medium block md:mb-2">
                    <span>Nomor Telepon</span>
                </label>
                <input type="text" name="nomor_telepon" id="nomor_telepon"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 px-3 @error('nomor_telepon') border-red-500 @enderror"
                    value="{{ old('nomor_telepon', $user->nomor_telepon) }}">
                @error('nomor_telepon')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </section>

            <section class="flex flex-col md:space-y-3 max-md:space-y-2">
                <button type="submit"
                    class="outline-none text-white-text w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-green focus:bg-dark-green">Update</button>
                <a href="" onclick="showChangeProfile(event)"
                    class="text-center outline-none text-slate-800 underline underline-offset-2 transition duration-300 active:text-elf-green">Close</a>
            </section>
        </form>
    </div>

    @include('components.alert')
    <div
        class="w-full grid md:grid-cols-3 max-md:grid-cols-1 md:gap-x-10 max-md:gap-y-3 mb-3 max-md:text-sm bg-white rounded-lg shadow-xl p-5">
        <section class="col-span-1 w-full flex items-center justify-center max-md:mb-3">
            <figure class="relative md:size-72 max-md:size-52 rounded-full overflow-hidden group">
                <img src="{{ !$user->profile ? asset('img/icon/user.png') : url('storage/profile/', $user->profile) }}"
                    alt="{{ $user->name }}" class="md:size-72 max-md:size-52 rounded-full">
                <button type="button" onclick="showChangePhoto(event)"
                    class="absolute -bottom-20 w-full md:h-16 max-md:h-14 bg-gray-500/60 flex items-center justify-center text-white-text transition-all duration-300 ease-in-out group-hover:bottom-0 group-active:bottom-0">
                    <p class="flex items-center space-x-1">
                        <span class="material-symbols-outlined">
                            photo_camera
                        </span>
                        <span>Ubah Foto</span>
                    </p>
                </button>
            </figure>
        </section>
        <section class="col-span-2">
            <div class="w-full flex items-center justify-between">
                <p class="text-gray-500">Selamat datang diprofil akun anda <span
                        class="font-medium italic">{{ $user->name }}.</span></p>
                <button type="button" onclick="showChangeProfile(event)"
                    class="outline-none md:w-28 h-9 max-md:w-24 max-md:text-sm transition duration-300 text-white-text bg-orange-600 flex items-center justify-center space-x-1 rounded-md shadow hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-800">
                    <span class="material-symbols-outlined md:text-[20px] max-md:text-[19px]">
                        border_color
                    </span>
                    <span>Edit</span>
                </button>
            </div>
            <div class="w-full flex flex-col space-y-3 mt-8">
                <p class="flex items-center pb-3 border-b-2">
                    <span class="flex flex-none w-32 font-medium">Nama</span>
                    <span class="flex flex-none w-5 font-medium">:</span>
                    <span>{{ $user->name }}</span>
                </p>
                <p class="flex items-center pb-3 border-b-2">
                    <span class="flex flex-none w-32 font-medium">Email</span>
                    <span class="flex flex-none w-5 font-medium">:</span>
                    <span>{{ $user->email }}</span>
                </p>
                <p class="flex items-center pb-3 border-b-2">
                    <span class="flex flex-none w-32 font-medium">Nomor Telepon</span>
                    <span class="flex flex-none w-5 font-medium">:</span>
                    <span>{{ !$user->nomor_telepon ? '-' : $user->nomor_telepon }}</span>
                </p>
                <p class="flex items-center pb-3 border-b-2">
                    <span class="flex flex-none w-32 font-medium">Status</span>
                    <span class="flex flex-none w-5 font-medium">:</span>
                    <span>{{ !$user->teacher_status ? '-' : $user->teacher_status }}</span>
                </p>
                <p class="flex items-center pb-3 border-b-2">
                    <span class="flex flex-none w-32 font-medium">Status Akun</span>
                    <span class="flex flex-none w-5 font-medium">:</span>
                    <span class="capitalize">{{ $user->roles->pluck('name')->first() }}</span>
                </p>
                <form @hasrole('super_admin')
                    action="#"
                    @endhasrole
                    @hasrole('admin')
                    action="#"
                    @endhasrole
                    @hasrole('operator')
                    action="{{ route('operator.profile.delete', $user->id) }}"
                    @endhasrole
                    @hasrole('teacher')
                    action="{{ route('teacher.profile.delete', $user->id) }}"
                    @endhasrole
                    method="POST" enctype="multipart/form-data"
                    class="flex max-md:flex-col max-md:space-y-3 flex-none items-center justify-between mt-5"
                    onsubmit="return confirm('Are you sure you want to delete your account?')">
                    <p class="text-gray-500 italic text-sm max-md:text-center"><span class="font-medium">Nb:</span> Hapus
                        akun jika anda
                        bukan guru dipondok ini lagi.</p>
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="outline-none w-36 h-10 max-md:text-sm transition duration-300 text-white-text flex items-center justify-center space-x-1 rounded-md shadow  {{ request()->routeIs(['operator.profile*', 'teacher.profile*']) ? 'bg-red-600 hover:bg-red-700 focus:bg-red-700 active:bg-red-800' : 'bg-red-400' }}">
                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                            person_remove
                        </span>
                        <span>Hapus Akun</span>
                    </button>
                </form>
            </div>
        </section>
    </div>
@endsection
