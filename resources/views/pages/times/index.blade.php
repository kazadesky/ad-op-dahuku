@extends('layouts.app')
@section('title', 'Daftar Jam Masuk')

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
        <span>/ Page / Jam Masuk</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-between mb-3">
            <a href="{{ route('admin.time.create') }}"
                class="outline-none flex items-center justify-center md:w-36 max-md:w-30 h-10 rounded-md shadow bg-blue-500 transition duration-300 hover:bg-blue-600 focus:bg-blue-600 text-white">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
            </a>
        </div>
        @if (session('success'))
            <div id="banner-alert" class="w-full h-12 px-3 flex items-center bg-sky-600 rounded-md shadow mb-3 text-white">
                <p>
                    <strong class="max-md:hidden">Success : </strong>
                    <span>{{ session('success') }}</span>
                </p>
            </div>
        @endif
        <div class="relative overflow-x-auto bg-white shadow-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="p-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jam Masuk
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jam Keluar
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
                    @forelse ($times as $time)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $loop->iteration }}.
                            </th>
                            <td class="px-6 py-4">
                                {{ $time->start }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $time->finish }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                <a href="{{ route('admin.time.edit', $time->id) }}"
                                    class="outline-none h-9 w-11 flex items-center justify-center bg-orange-500 rounded-md transition duration-300 hover:bg-orange-600 focus:bg-orange-600">
                                    <span class="material-symbols-outlined text-[21px]">
                                        border_color
                                    </span>
                                </a>
                                <form action="{{ route('admin.time.destroy', $time->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="outline-none h-9 w-11 flex items-center justify-center bg-red-500 rounded-md transition duration-300 hover:bg-red-600 focus:bg-red-600">
                                        <span class="material-symbols-outlined text-[21px]">
                                            delete
                                        </span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <caption class="caption-bottom my-3">
                            Belum ada mata pelajaran yang terdaftar.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection
