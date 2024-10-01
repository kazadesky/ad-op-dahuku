@extends('layouts.app')
@section('title', 'Edit Guru Piket')

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
        <span>/ Page / Guru Piket / Edit</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
        <form action="{{ route('sa.teacher-picket.update', $picket->id) }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            @method('PATCH')
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="teacher_id" class="font-medium md:w-40">
                        <span>Nama Guru</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="teacher_id" id="teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('teacher_id') border-red-500 @enderror">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $teacher->id === $picket->teacher_id ? 'selected' : '' }}>
                                {{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('teacher_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="day_id" class="font-medium md:w-40">
                        <span>Jadwal Piket</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="day_id" id="day_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('day_id') border-red-500 @enderror">
                        @foreach ($days as $day)
                            <option value="{{ $day->id }}" {{ $day->id === $picket->day_id ? 'selected' : '' }}>
                                {{ $day->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('day_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="substitute_picket_teacher_id" class="font-medium md:w-40">
                        <span>Piket Pengganti</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="substitute_picket_teacher_id" id="substitute_picket_teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('substitute_picket_teacher_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Guru Pengganti</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ $teacher->id === $picket->substitute_picket_teacher_id ? 'selected' : '' }}>
                                {{ $teacher->name }}</option>
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
                <a href="{{ route('sa.teacher-picket.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Update</button>
            </section>
        </form>
    @endhasrole

    @hasrole('admin')
        <form action="{{ route('admin.teacher-picket.update', $picket->id) }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            @method('PATCH')
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="teacher_id" class="font-medium md:w-40">
                        <span>Nama Guru</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="teacher_id" id="teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('teacher_id') border-red-500 @enderror">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $teacher->id === $picket->teacher_id ? 'selected' : '' }}>
                                {{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('teacher_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="day_id" class="font-medium md:w-40">
                        <span>Jadwal Piket</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="day_id" id="day_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('day_id') border-red-500 @enderror">
                        @foreach ($days as $day)
                            <option value="{{ $day->id }}" {{ $day->id === $picket->day_id ? 'selected' : '' }}>
                                {{ $day->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('day_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="substitute_picket_teacher_id" class="font-medium md:w-40">
                        <span>Piket Pengganti</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="substitute_picket_teacher_id" id="substitute_picket_teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('substitute_picket_teacher_id') border-red-500 @enderror">
                        <option value="">Pilih Guru Pengganti</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ $teacher->id === $picket->substitute_picket_teacher_id ? 'selected' : '' }}>
                                {{ $teacher->name }}</option>
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
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Update</button>
            </section>
        </form>
    @endhasrole

    @hasrole('operator')
        <form action="{{ route('operator.teacher-picket.update', $picket->id) }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            @method('PATCH')
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="teacher_id" class="font-medium md:w-40">
                        <span>Nama Guru</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="teacher_id" id="teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('teacher_id') border-red-500 @enderror">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ $teacher->id === $picket->teacher_id ? 'selected' : '' }}>
                                {{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('teacher_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="day_id" class="font-medium md:w-40">
                        <span>Jadwal Piket</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="day_id" id="day_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('day_id') border-red-500 @enderror">
                        @foreach ($days as $day)
                            <option value="{{ $day->id }}" {{ $day->id === $picket->day_id ? 'selected' : '' }}>
                                {{ $day->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('day_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="substitute_picket_teacher_id" class="font-medium md:w-40">
                        <span>Piket Pengganti</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="substitute_picket_teacher_id" id="substitute_picket_teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('substitute_picket_teacher_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Guru Pengganti</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ $teacher->id === $picket->substitute_picket_teacher_id ? 'selected' : '' }}>
                                {{ $teacher->name }}</option>
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
                <a href="{{ route('operator.teacher-picket.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Update</button>
            </section>
        </form>
    @endhasrole
@endsection
