@extends('layouts.app')
@section('title', 'Tambah Guru Piket')

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
        <span>/ Page / Guru Piket / Tambah</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <form action="{{ route('admin.teacher-picket.store') }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg">
            @csrf
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="teacher_id" class="font-medium md:w-40">
                        <span>Nama Guru</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="teacher_id" id="teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('teacher_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Guru</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('teacher_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="day_id" class="font-medium md:w-40">
                        <span>Jadwal Piket</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="day_id" id="day_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('day_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Hari</option>
                        @foreach ($days as $day)
                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('day_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="substitute_picket_teacher_id" class="font-medium md:w-40">
                        <span>Piket Pengganti</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="substitute_picket_teacher_id" id="substitute_picket_teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('substitute_picket_teacher_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Guru Pengganti</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('substitute_picket_teacher_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('admin.teacher-picket.index') }}"
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