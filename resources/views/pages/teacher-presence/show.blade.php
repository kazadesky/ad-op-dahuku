@extends('layouts.app')
@section('title', 'Detail Absensi Guru')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white">
        @hasrole('super_admin')
            <span>Super Admin</span>
        @endhasrole
        @hasrole('admin')
            <span>Admin</span>
        @endhasrole
        @hasrole('teacher')
            <span>Teacher</span>
        @endhasrole
        <span>/ Page / Absensi Guru / Detail</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
        <div class="w-full flex items-center justify-end mb-3 max-md:text-sm">
            <a href="{{ route('sa.teacher-presence.index') }}"
                class="outline-none md:h-11 max-md:h-10 rounded-md text-white-text md:w-36 max-md:w-28 flex items-center justify-center font-medium bg-red-600 shadow transition duration-300 hover:bg-red-700 focus:bg-red-700">Kembali</a>
        </div>

        <div class="w-full p-5 rounded-md shadow-lg bg-white mb-10 max-md:text-sm">
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Nama Guru</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->teacher->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Mata Pelajaran</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->lesson->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Kelas</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->classRoom->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Hari, Tanggal</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">
                    {{ $presence->day->name }}, {{ \Carbon\Carbon::parse($presence->created_at)->format('d-m-Y') }}
                </p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Jam Pelajaran</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">
                    {{ \Carbon\Carbon::parse($presence->time->start)->format('H:i') }} -
                    {{ \Carbon\Carbon::parse($presence->time->finish)->format('H:i') }}
                </p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Keterangan</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->status }}</p>
            </div>
            @if ($presence->substituteTeacher)
                <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                    <p class="md:font-bold max-md:font-semibold w-44">Guru Pengganti</p>
                    <p class="w-5 font-bold">:</p>
                    <p class="w-full">{{ $presence->substituteTeacher->name }}</p>
                </div>
            @endif
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Guru Piket</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->teacherPicket->name }}</p>
            </div>
            @if ($presence->created_at != $presence->updated_at)
                <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                    <p class="md:font-bold max-md:font-semibold w-44">Tanggal Update</p>
                    <p class="w-5 font-bold">:</p>
                    <p class="w-full">{{ \Carbon\Carbon::parse($presence->updated_at)->format('d-m-Y') }}</p>
                </div>
                <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                    <p class="md:font-bold max-md:font-semibold w-44">Diupdate Oleh</p>
                    <p class="w-5 font-bold">:</p>
                    <p class="w-full">{{ $presence->updatedBy->name }}</p>
                </div>
            @endif
        </div>
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-end mb-3 max-md:text-sm">
            <a href="{{ route('admin.teacher-presence.index') }}"
                class="outline-none md:h-11 max-md:h-10 rounded-md text-white-text md:w-36 max-md:w-28 flex items-center justify-center font-medium bg-red-600 shadow transition duration-300 hover:bg-red-700 focus:bg-red-700">Kembali</a>
        </div>

        <div class="w-full p-5 rounded-md shadow-lg bg-white mb-10 max-md:text-sm">
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Nama Guru</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->teacher->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Mata Pelajaran</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->lesson->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Kelas</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->classRoom->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Hari, Tanggal</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">
                    {{ $presence->day->name }}, {{ \Carbon\Carbon::parse($presence->created_at)->format('d-m-Y') }}
                </p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Jam Pelajaran</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">
                    {{ \Carbon\Carbon::parse($presence->time->start)->format('H:i') }} -
                    {{ \Carbon\Carbon::parse($presence->time->finish)->format('H:i') }}
                </p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Keterangan</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->status }}</p>
            </div>
            @if ($presence->substituteTeacher)
                <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                    <p class="md:font-bold max-md:font-semibold w-44">Guru Pengganti</p>
                    <p class="w-5 font-bold">:</p>
                    <p class="w-full">{{ $presence->substituteTeacher->name }}</p>
                </div>
            @endif
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Guru Piket</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->teacherPicket->name }}</p>
            </div>
        </div>
    @endhasrole

    @hasrole('teacher')
        <div class="w-full flex items-center justify-end mb-3 max-md:text-sm">
            <a href="{{ route('teacher.teacher-presence.index') }}"
                class="outline-none md:h-11 max-md:h-10 rounded-md text-white-text md:w-36 max-md:w-28 flex items-center justify-center font-medium bg-red-600 shadow transition duration-300 hover:bg-red-700 focus:bg-red-700">Kembali</a>
        </div>

        <div class="w-full p-5 rounded-md shadow-lg bg-white mb-10 max-md:text-sm">
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Nama Guru</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->teacher->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Mata Pelajaran</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->lesson->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Kelas</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->classRoom->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Hari, Tanggal</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">
                    {{ $presence->day->name }}, {{ \Carbon\Carbon::parse($presence->created_at)->format('d-m-Y') }}
                </p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Jam Pelajaran</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">
                    {{ \Carbon\Carbon::parse($presence->time->start)->format('H:i') }} -
                    {{ \Carbon\Carbon::parse($presence->time->finish)->format('H:i') }}
                </p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Keterangan</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->status }}</p>
            </div>
            @if ($presence->substituteTeacher)
                <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                    <p class="md:font-bold max-md:font-semibold w-44">Guru Pengganti</p>
                    <p class="w-5 font-bold">:</p>
                    <p class="w-full">{{ $presence->substituteTeacher->name }}</p>
                </div>
            @endif
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Guru Piket</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $presence->teacherPicket->name }}</p>
            </div>
            @if ($presence->created_at != $presence->updated_at)
                <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                    <p class="md:font-bold max-md:font-semibold w-44">Tanggal Update</p>
                    <p class="w-5 font-bold">:</p>
                    <p class="w-full">{{ \Carbon\Carbon::parse($presence->updated_at)->format('d-m-Y') }}</p>
                </div>
                <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                    <p class="md:font-bold max-md:font-semibold w-44">Diupdate Oleh</p>
                    <p class="w-5 font-bold">:</p>
                    <p class="w-full">{{ $presence->updatedBy->name }}</p>
                </div>
            @endif
        </div>
    @endhasrole
@endsection
