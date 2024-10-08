@extends('layouts.app')
@section('title', 'Data Guru')

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
        <span>/ Page / Data Guru</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
        <div class="w-full flex items-center justify-end mb-3 max-md:text-sm">
            <form action="{{ route('sa.teacher.index') }}" method="GET" class="md:w-80 max-md:w-52 relative">
                <label for="search" class="absolute top-2 left-2 text-gray-500 z-10">
                    <span class="material-symbols-outlined max-md:text-[21px]">
                        search
                    </span>
                </label>
                <input type="search" name="search" id="search"
                    class="w-full md:h-10 max-md:h-9 rounded pl-8 pr-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200"
                    placeholder="Cari berdasarkan nama">
            </form>
        </div>
        @include('components.alert')
        <div class="relative overflow-x-auto bg-white shadow-lg max-md:text-sm">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="p-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Profil Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Telepon
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status Akun
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($sa_teachers as $teacher)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $loop->iteration }}.
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <figure class="md:size-20 max-md:size-12 overflow-hidden rounded-full">
                                    <img src="{{ !$teacher->profile ? asset('img/icon/user.png') : url('storage/profile/', $teacher->profile) }}"
                                        alt="profile {{ $teacher->name }}" class="w-full">
                                </figure>
                            </th>
                            <td class="px-6 py-4">
                                {{ $teacher->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $teacher->nomor_telepon ? $teacher->nomor_telepon : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $teacher->teacher_status ? $teacher->teacher_status : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($teacher->hasRole('admin'))
                                    Admin
                                @elseif ($teacher->hasRole('operator'))
                                    Operator
                                @elseif ($teacher->hasRole('teacher'))
                                    Guru
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('sa.teacher.edit', $teacher->id) }}"
                                    class="outline-none text-white md:size-10 max-md:size-9 rounded flex items-center justify-center bg-orange-600 transition duration-300 hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-800">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        edit_square
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <caption class="caption-bottom my-3">
                            Belum ada data guru yang terdaftar.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-end mb-3 max-md:text-sm">
            <form action="{{ route('admin.teacher.index') }}" method="GET" class="md:w-80 max-md:w-52 relative">
                <label for="search" class="absolute top-2 left-2 text-gray-500 z-10">
                    <span class="material-symbols-outlined max-md:text-[21px]">
                        search
                    </span>
                </label>
                <input type="search" name="search" id="search"
                    class="w-full md:h-10 max-md:h-9 rounded pl-8 pr-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200"
                    placeholder="Cari berdasarkan nama">
            </form>
        </div>
        @include('components.alert')
        <div class="relative overflow-x-auto bg-white shadow-lg max-md:text-sm">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="p-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Profil Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Telepon
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status Akun
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($ad_teachers as $teacher)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $loop->iteration }}.
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <figure class="md:size-20 max-md:size-12 rounded-full overflow-hidden">
                                    <img src="{{ !$teacher->profile ? asset('img/icon/user.png') : url('storage/profile/', $teacher->profile) }}"
                                        alt="profile {{ $teacher->name }}" class="w-full">
                                </figure>
                            </th>
                            <td class="px-6 py-4">
                                {{ $teacher->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $teacher->nomor_telepon ? $teacher->nomor_telepon : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $teacher->teacher_status ? $teacher->teacher_status : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($teacher->hasRole('operator'))
                                    Operator
                                @elseif ($teacher->hasRole('teacher'))
                                    Guru
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.teacher.edit', $teacher->id) }}"
                                    class="outline-none text-white md:size-10 max-md:size-9 rounded flex items-center justify-center bg-orange-600 transition duration-300 hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-800">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        edit_square
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <caption class="caption-bottom my-3">
                            Belum ada data guru yang terdaftar.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endhasrole

    @hasrole('operator')
        <div class="w-full flex items-center justify-end mb-3 max-md:text-sm">
            <form action="{{ route('operator.teacher.index') }}" method="GET" class="md:w-80 max-md:w-52 relative">
                <label for="search" class="absolute top-2 left-2 text-gray-500 z-10">
                    <span class="material-symbols-outlined max-md:text-[21px]">
                        search
                    </span>
                </label>
                <input type="search" name="search" id="search"
                    class="w-full md:h-10 max-md:h-9 rounded pl-8 pr-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200"
                    placeholder="Cari berdasarkan nama">
            </form>
        </div>
        @include('components.alert')
        <div class="relative overflow-x-auto bg-white shadow-lg max-md:text-sm">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="p-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Profil Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Telepon
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status Akun
                        </th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($teachers as $teacher)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $loop->iteration }}.
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <figure class="md:size-20 max-md:size-12 overflow-hidden rounded-full">
                                    <img src="{{ !$teacher->profile ? asset('img/icon/user.png') : url('storage/profile/', $teacher->profile) }}"
                                        alt="profile {{ $teacher->name }}" class="w-full">
                                </figure>
                            </th>
                            <td class="px-6 py-4">
                                {{ $teacher->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $teacher->nomor_telepon ? $teacher->nomor_telepon : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $teacher->teacher_status ? $teacher->teacher_status : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $teacher->hasRole('teacher') ? 'Guru' : '-' }}
                            </td>
                        </tr>
                    @empty
                        <caption class="caption-bottom my-3">
                            Belum ada data guru yang terdaftar.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endhasrole
@endsection
