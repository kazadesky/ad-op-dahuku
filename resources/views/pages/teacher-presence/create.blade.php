@extends('layouts.app')
@section('title', 'Tambah Absensi Guru')

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
        <span>/ Page / Absensi Guru / Tambah</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
        <form action="{{ route('sa.teacher-presence.store') }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            <section class="w-full md:mb-4 max-md:mb-3">
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
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="lesson_id" class="font-medium md:w-40">
                        <span>Mata Pelajaran</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="lesson_id" id="lesson_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('lesson_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Pelajaran</option>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('lesson_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="class_id" class="font-medium md:w-40">
                        <span>Kelas</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="class_id" id="class_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('class_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Kelas</option>
                        @foreach ($classRooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('class_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="day_id" class="font-medium md:w-40">
                        <span>Hari</span>
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
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="time_id" class="font-medium md:w-40">
                        <span>Jadwal Pelajaran</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="time_id" id="time_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('time_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Jadwal</option>
                        @foreach ($times as $time)
                            <option value="{{ $time->id }}">{{ $time->start }} - {{ $time->finish }}</option>
                        @endforeach
                    </select>
                </div>
                @error('time_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="status" class="font-medium md:w-40">
                        <span>Status Absensi</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="status" id="status"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('status') border-red-500 @enderror">
                        <option value="" hidden>Pilih Status</option>
                        @foreach ($status as $s)
                            <option value="{{ $s }}">{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                @error('status')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="substitute_teacher_id" class="font-medium md:w-40">
                        <span>Guru Pengganti</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="substitute_teacher_id" id="substitute_teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('substitute_teacher_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Guru Pengganti</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('substitute_teacher_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('sa.teacher-presence.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Tambah</button>
            </section>
        </form>
    @endhasrole

    @hasrole('admin')
        <form action="{{ route('admin.teacher-presence.store') }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            <section class="w-full md:mb-4 max-md:mb-3">
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
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="lesson_id" class="font-medium md:w-40">
                        <span>Mata Pelajaran</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="lesson_id" id="lesson_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('lesson_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Pelajaran</option>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('lesson_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="class_id" class="font-medium md:w-40">
                        <span>Kelas</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="class_id" id="class_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('class_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Kelas</option>
                        @foreach ($classRooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('class_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="day_id" class="font-medium md:w-40">
                        <span>Hari</span>
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
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="time_id" class="font-medium md:w-40">
                        <span>Jadwal Pelajaran</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="time_id" id="time_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('time_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Jadwal</option>
                        @foreach ($times as $time)
                            <option value="{{ $time->id }}">{{ $time->start }} - {{ $time->finish }}</option>
                        @endforeach
                    </select>
                </div>
                @error('time_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="status" class="font-medium md:w-40">
                        <span>Status Absensi</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="status" id="status"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('status') border-red-500 @enderror">
                        <option value="" hidden>Pilih Status</option>
                        @foreach ($status as $s)
                            <option value="{{ $s }}">{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                @error('status')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="substitute_teacher_id" class="font-medium md:w-40">
                        <span>Guru Pengganti</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="substitute_teacher_id" id="substitute_teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('substitute_teacher_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Guru Pengganti</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('substitute_teacher_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('admin.teacher-presence.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Tambah</button>
            </section>
        </form>
    @endhasrole

    @hasrole('teacher')
        <form action="{{ route('teacher.teacher-presence.store') }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            <section class="w-full md:mb-4 max-md:mb-3">
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
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="lesson_id" class="font-medium md:w-40">
                        <span>Mata Pelajaran</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="lesson_id" id="lesson_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('lesson_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Pelajaran</option>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('lesson_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="class_id" class="font-medium md:w-40">
                        <span>Kelas</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="class_id" id="class_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('class_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Kelas</option>
                        @foreach ($classRooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('class_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="day_id" class="font-medium md:w-40">
                        <span>Hari</span>
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
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="time_id" class="font-medium md:w-40">
                        <span>Jadwal Pelajaran</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="time_id" id="time_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('time_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Jadwal</option>
                        @foreach ($times as $time)
                            <option value="{{ $time->id }}">{{ $time->start }} - {{ $time->finish }}</option>
                        @endforeach
                    </select>
                </div>
                @error('time_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="status" class="font-medium md:w-40">
                        <span>Status Absensi</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="status" id="status"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('status') border-red-500 @enderror">
                        <option value="" hidden>Pilih Status</option>
                        @foreach ($status as $s)
                            <option value="{{ $s }}">{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                @error('status')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="substitute_teacher_id" class="font-medium md:w-40">
                        <span>Guru Pengganti</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="substitute_teacher_id" id="substitute_teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('substitute_teacher_id') border-red-500 @enderror">
                        <option value="" hidden>Pilih Guru Pengganti</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('substitute_teacher_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('teacher.teacher-presence.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Tambah</button>
            </section>
        </form>
    @endhasrole
@endsection
