@extends('layouts.app')
@section('title', 'Detail Pelanggaran')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white">
        @hasrole('teacher')
            <span>Teacher</span>
        @endhasrole
        <span>/ Page / Absensi Guru / Detail</span>
    </p>
@endsection

@section('content')
    @hasrole('teacher')
        <div class="w-full flex items-center justify-end mb-3 max-md:text-sm">
            <a href="{{ route('teacher.student-misconduct.index') }}"
                class="outline-none md:h-11 max-md:h-10 rounded-md text-white-text md:w-36 max-md:w-28 flex items-center justify-center font-medium bg-red-600 shadow transition duration-300 hover:bg-red-700 focus:bg-red-700">Kembali</a>
        </div>

        <div class="w-full p-5 rounded-md shadow-lg bg-white mb-10 max-md:text-sm">
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Nama Santri</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $misconduct->student->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Tanggal</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ \Carbon\Carbon::parse($misconduct->created_at)->format('d-m-Y') }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:min-h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Pelanggaran</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $misconduct->misconduct }}</p>
            </div>
            @if ($misconduct->created_at != $misconduct->updated_at)
                <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                    <p class="md:font-bold max-md:font-semibold w-44">Tanggal Update</p>
                    <p class="w-5 font-bold">:</p>
                    <p class="w-full">{{ \Carbon\Carbon::parse($misconduct->updated_at)->format('d-m-Y, H:i:s') }}</p>
                </div>
                <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                    <p class="md:font-bold max-md:font-semibold w-44">Diupdate Oleh</p>
                    <p class="w-5 font-bold">:</p>
                    <p class="w-full">{{ $misconduct->updatedBy->name }}</p>
                </div>
            @endif
        </div>
    @endhasrole
@endsection
