@extends('layouts.app')
@section('title', 'Detail Akun')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white">
        @hasrole('super_admin')
            <span>Super Admin</span>
        @endhasrole
        @hasrole('admin')
            <span>Admin</span>
        @endhasrole
        <span>/ Page / Akun Wali Santri / Detail</span>
    </p>
@endsection

@section('content')
    <div
        class="w-full grid md:grid-cols-3 max-md:grid-cols-1 md:gap-x-10 max-md:gap-y-3 mb-3 max-md:text-sm bg-white rounded-lg shadow-xl p-5">
        <section class="col-span-1 w-full flex items-center justify-center max-md:mb-3">
            <figure class="relative md:size-72 max-md:size-44 rounded-full overflow-hidden group">
                <img src="{{ !$studentGuardian->profile ? asset('img/icon/user.png') : url('storage/profile/guardian/', $studentGuardian->profile) }}"
                    alt="{{ $studentGuardian->name }}" class="w-full">
            </figure>
        </section>
        <section class="col-span-2 max-md:flex max-md:flex-col-reverse">
            <div class="w-full flex items-center justify-end max-md:mt-5">
                @hasrole('super_admin')
                    <a href="{{ route('sa.student-guardian.index') }}" type="button"
                        class="outline-none md:w-28 h-9 max-md:w-24 max-md:text-sm transition duration-300 text-white-text bg-red-600 flex items-center justify-center space-x-1 rounded-md shadow hover:bg-red-700 focus:bg-red-700 active:bg-red-800">
                        <span>Kembali</span>
                    </a>
                @endhasrole

                @hasrole('admin')
                    <a href="{{ route('admin.student-guardian.index') }}" type="button"
                        class="outline-none md:w-28 h-9 max-md:w-24 max-md:text-sm transition duration-300 text-white-text bg-red-600 flex items-center justify-center space-x-1 rounded-md shadow hover:bg-red-700 focus:bg-red-700 active:bg-red-800">
                        <span>Kembali</span>
                    </a>
                @endhasrole
            </div>
            <div class="w-full flex flex-col space-y-3 md:mt-8 overflow-hidden">
                <div class="w-full relative overflow-x-auto">
                    <p class="flex items-center py-3 border-b-2">
                        <span class="flex flex-none w-32 font-medium">Nama Wali</span>
                        <span class="flex flex-none w-5 font-medium">:</span>
                        <span>{{ $studentGuardian->name }}</span>
                    </p>
                    <p class="flex items-center py-3 border-b-2">
                        <span class="flex flex-none w-32 font-medium">Nama Santri</span>
                        <span class="flex flex-none w-5 font-medium">:</span>
                        <span>{{ $studentGuardian->student->name }}</span>
                    </p>
                    <p class="flex items-center py-3 border-b-2">
                        <span class="flex flex-none w-32 font-medium">NIS</span>
                        <span class="flex flex-none w-5 font-medium">:</span>
                        <span>{{ $studentGuardian->student->nis }}</span>
                    </p>
                    <p class="flex items-center py-3 border-b-2">
                        <span class="flex flex-none w-32 font-medium">NISN</span>
                        <span class="flex flex-none w-5 font-medium">:</span>
                        <span>{{ $studentGuardian->student->nisn }}</span>
                    </p>
                    <p class="flex items-center py-3 border-b-2">
                        <span class="flex flex-none w-32 font-medium">Kelas</span>
                        <span class="flex flex-none w-5 font-medium">:</span>
                        <span>{{ $studentGuardian->student->classRoom->name }}</span>
                    </p>
                    <p class="flex items-center py-3 border-b-2">
                        <span class="flex flex-none w-32 font-medium">Nomor Telepon</span>
                        <span class="flex flex-none w-5 font-medium">:</span>
                        <span>{{ !$studentGuardian->no_tel ? '-' : $studentGuardian->no_tel }}</span>
                    </p>
                    <p class="flex items-center py-3 border-b-2">
                        <span class="flex flex-none w-32 font-medium">Password</span>
                        <span class="flex flex-none w-5 font-medium">:</span>
                        <span>{{ str_replace(' ', '', strtolower($studentGuardian->student->name)) }}</span>
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
