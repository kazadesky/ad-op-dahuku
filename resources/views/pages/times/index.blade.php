@extends('layouts.app')
@section('title', 'Daftar Jam Masuk')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white-text">
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
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <a href="{{ route('admin.time.create') }}"
                class="outline-none flex items-center justify-center md:w-36 max-md:w-28 h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
            </a>
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
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                <a href="{{ route('admin.time.edit', $time->id) }}"
                                    class="outline-none size-10 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        border_color
                                    </span>
                                </a>
                                <form action="{{ route('admin.time.destroy', $time->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="outline-none size-10 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
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
