@extends('layouts.app')
@section('title', 'Tambah Akun')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white">
        @hasrole('super_admin')
            <span>Super Admin</span>
        @endhasrole
        @hasrole('admin')
            <span>Admin</span>
        @endhasrole
        <span>/ Page / Akun Wali Santri / Tambah</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
        <form action="{{ route('sa.student-guardian.store') }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            <section class="md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="name" class="font-medium md:w-56">
                        <span>Nama Wali</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="text" name="name" id="name"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror"
                        placeholder="Name Lengkap" value="{{ old('name') }}">
                </div>
                @error('name')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full max-md:mb-3 md:mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="student_id" class="font-medium md:w-56">
                        <span>Nama Santri</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="student_id" id="student_id" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror">
                        <option hidden>Pilih Nama Santri</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('student_id')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="nis" class="font-medium md:w-56">
                        <span>NIS</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="number" name="nis" id="nis"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('nis') border-red-500 @enderror"
                        placeholder="12345678" value="{{ old('nis') }}">
                </div>
                @error('nis')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="no_tel" class="font-medium md:w-56">
                        <span>Nomor Telepon</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="number" name="no_tel" id="no_tel"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('no_tel') border-red-500 @enderror"
                        placeholder="08xxxxxxxxxx" value="{{ old('no_tel') }}">
                </div>
                @error('no_tel')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            {{-- <section class="md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="password" class="font-medium md:w-56">
                        <span>Password</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
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
                </div>
                @error('password')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="password_confirmation" class="font-medium md:w-56">
                        <span>Konfirmasi Password</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
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
                </div>
                @error('password_confirmation')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section> --}}
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('sa.student-guardian.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Tambah</button>
            </section>
        </form>
    @endhasrole

    @hasrole('admin')
        <form action="{{ route('admin.student-guardian.store') }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            <section class="md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="name" class="font-medium md:w-56">
                        <span>Nama Wali</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="text" name="name" id="name"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror"
                        placeholder="Name Lengkap" value="{{ old('name') }}">
                </div>
                @error('name')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full max-md:mb-3 md:mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="student_id" class="font-medium md:w-56">
                        <span>Nama Santri</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="student_id" id="student_id" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror">
                        <option hidden>Pilih Nama Santri</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('student_id')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="nis" class="font-medium md:w-56">
                        <span>NIS</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="number" name="nis" id="nis"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('nis') border-red-500 @enderror"
                        placeholder="12345678" value="{{ old('nis') }}">
                </div>
                @error('nis')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="no_tel" class="font-medium md:w-56">
                        <span>Nomor Telepon</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="number" name="no_tel" id="no_tel"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('no_tel') border-red-500 @enderror"
                        placeholder="08xxxxxxxxxx" value="{{ old('no_tel') }}">
                </div>
                @error('no_tel')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            {{-- <section class="md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="password" class="font-medium md:w-56">
                        <span>Password</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
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
                </div>
                @error('password')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="password_confirmation" class="font-medium md:w-56">
                        <span>Konfirmasi Password</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
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
                </div>
                @error('password_confirmation')
                    <div class="w-full md:pl-52">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section> --}}
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('admin.student-guardian.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Tambah</button>
            </section>
        </form>
    @endhasrole
@endsection
