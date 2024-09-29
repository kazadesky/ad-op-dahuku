@extends('layouts.app')
@section('title', 'Tambah Pembelajaran')

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
        <span>/ Page / Tambah Pembelajaran</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <form action="{{ route('admin.lesson.store') }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="name" class="font-medium md:w-40">
                        <span>Mata Pelajaran</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="text" name="name" id="name"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror"
                        placeholder="Mata Pelajaran" value="{{ old('name') }}">
                </div>
                @error('name')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('admin.lesson.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-600 font-medium transition duration-300 md:hover:bg-gray-700 md:focus:bg-gray-700 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-green-500">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-green-600 rounded shadow-sm transition duration-300 hover:bg-green-700 focus:bg-green-700 max-md:mb-2">Tambah</button>
            </section>
        </form>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection
