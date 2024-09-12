@extends('layouts.app')
@section('title', 'Tambah Data Santri')

@section('subtitle')
    @hasrole('super_admin')
        <p class="flex items-center space-x-px capitalize text-white">
            <span>Super Admin</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span>Page</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span>Data Santri</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span class="text-gray-200">Tambah</span>
        </p>
    @endhasrole

    @hasrole('admin')
        <p class="flex items-center space-x-px capitalize text-white">
            <span>Admin</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span>Page</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span>Data Santri</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span class="text-gray-200">Tambah</span>
        </p>
    @endhasrole

    @hasrole('operator')
        <p class="flex items-center space-x-px capitalize text-white">
            <span>Operator</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span>Page</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span>Data Santri</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span class="text-gray-200">Tambah</span>
        </p>
    @endhasrole
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <form action="{{ route('admin.student.store') }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg">
            @csrf
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="name" class="font-medium md:w-40">
                        <span>Nama Lengkap</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="text" name="name" id="name"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror"
                        placeholder="Nama Lengkap" value="{{ old('name') }}">
                </div>
                @error('name')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="nis" class="font-medium md:w-40">
                        <span>NIS</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="number" inputmode="numeric" name="nis" id="nis"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('nis') border-red-500 @enderror"
                        placeholder="123456" value="{{ old('nis') }}">
                </div>
                @error('nis')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="nisn" class="font-medium md:w-40">
                        <span>NISN</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="number" inputmode="numeric" name="nisn" id="nisn"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('nisn') border-red-500 @enderror"
                        placeholder="1234" value="{{ old('nisn') }}">
                </div>
                @error('nisn')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="class_id" class="font-medium md:w-40">
                        <span>Kelas</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="class_id" id="class_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('class_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Kelas</option>
                        @foreach ($classRoom as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('class_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="tempat_lahir" class="font-medium md:w-40">
                        <span>Tempat Lahir</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="text" name="place_of_birth" id="tempat_lahir"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('place_of_birth') border-red-500 @enderror"
                        placeholder="Tempat Lahir" value="{{ old('place_of_birth') }}">
                </div>
                @error('place_of_birth')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="tanggal_lahir" class="font-medium md:w-40">
                        <span>Tanggal Lahir</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="date" name="date_of_birth" id="tanggal_lahir"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('date_of_birth') border-red-500 @enderror"
                        value="{{ old('date_of_birth') }}">
                </div>
                @error('date_of_birth')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="gender" class="font-medium md:w-40">
                        <span>Jenis Kelamin</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="gender" id="gender"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('gender') border-red-500 @enderror">
                        <option value="" hidden>Pilih Jenis Kelamin</option>
                        @foreach ($genders as $gender)
                            <option value="{{ $gender }}">{{ $gender }}</option>
                        @endforeach
                    </select>
                </div>
                @error('gender')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-start">
                    <label for="address" class="font-medium md:w-40 pt-1">
                        <span>Alamat</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <textarea name="address" id="address" cols="30" rows="5"
                        class="outline-none w-full rounded-md p-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('address') border-red-500 @enderror"
                        placeholder="Alamat Lengkap" value="{{ old('address') }}"></textarea>
                </div>
                @error('address')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('admin.student.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-600 font-medium transition duration-300 md:hover:bg-gray-700 md:focus:bg-gray-700 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-green-500">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full h-11 flex items-center justify-center font-medium bg-green-600 rounded shadow-sm transition duration-300 hover:bg-green-700 focus:bg-green-700 max-md:mb-3">Tambah</button>
            </section>
        </form>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection
