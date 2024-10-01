@extends('layouts.app')
@section('title', 'Edit Pencapaian Santri')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white">
        @hasrole('super_admin')
            <span>Super Admin</span>
        @endhasrole
        @hasrole('admin')
            <span>Admin</span>
        @endhasrole
        @hasrole('teacher')
            <span>Operator</span>
        @endhasrole
        <span>/ Page / Pencapaian Santri / Edit</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
        <form action="{{ route('sa.student-achievement.update', [$achievement->id, $student->id]) }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            @method('PATCH')
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="teacher_id" class="font-medium md:w-40">
                        <span>Nama Guru</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="text" name="teacher_id" id="teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('student_id') border-red-500 @enderror"
                        value="{{ $achievement->teacher->name }}" readonly />
                </div>
                @error('teacher_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="student_id" class="font-medium md:w-40">
                        <span>Nama Santri</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="text" name="student_id" id="student_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('student_id') border-red-500 @enderror"
                        value="{{ $achievement->student->name }}" readonly />
                </div>
                @error('student_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-start">
                    <label for="achievement" class="font-medium md:w-40">
                        <span>Pencapaian</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <textarea name="achievement" id="achievement"
                        class="outline-none w-full rounded-md md:min-h-24 max-md:min-h-20 p-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('achievement') border-red-500 @enderror"
                        placeholder="Masukkan pencapaian santri...">{{ $achievement->achievement }}</textarea>
                </div>
                @error('achievement')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('sa.student.show', $student->id) }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Update</button>
            </section>
        </form>
    @endhasrole

    @hasrole('admin')
        <form action="{{ route('admin.student-achievement.update', [$achievement->id, $student->id]) }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            @method('PATCH')
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="teacher_id" class="font-medium md:w-40">
                        <span>Nama Guru</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="text" name="teacher_id" id="teacher_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('student_id') border-red-500 @enderror"
                        value="{{ $achievement->teacher->name }}" readonly />
                </div>
                @error('teacher_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="student_id" class="font-medium md:w-40">
                        <span>Nama Santri</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <input type="text" name="student_id" id="student_id"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('student_id') border-red-500 @enderror"
                        value="{{ $achievement->student->name }}" readonly />
                </div>
                @error('student_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-start">
                    <label for="achievement" class="font-medium md:w-40">
                        <span>Pencapaian</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <textarea name="achievement" id="achievement"
                        class="outline-none w-full rounded-md md:min-h-24 max-md:min-h-20 p-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('achievement') border-red-500 @enderror"
                        placeholder="Masukkan pencapaian santri...">{{ $achievement->achievement }}</textarea>
                </div>
                @error('achievement')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('admin.student.show', $student->id) }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Update</button>
            </section>
        </form>
    @endhasrole

    @hasrole('teacher')
        <form action="{{ route('teacher.student-achievement.update', $achievement->id) }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            @method('PATCH')
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="student_id" class="font-medium md:w-40">
                        <span>Nama Santri</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="student_id" id="student_id" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('student_id') border-red-500 @enderror">
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}"
                                {{ $student->id === $achievement->student_id ? 'selected' : '' }}>{{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('student_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-start">
                    <label for="achievement" class="font-medium md:w-40">
                        <span>Pencapaian</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <textarea name="achievement" id="achievement"
                        class="outline-none w-full rounded-md md:min-h-24 max-md:min-h-20 p-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('achievement') border-red-500 @enderror"
                        placeholder="Masukkan pencapaian santri...">{{ $achievement->achievement }}</textarea>
                </div>
                @error('achievement')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('teacher.student-achievement.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Update</button>
            </section>
        </form>
    @endhasrole
@endsection
