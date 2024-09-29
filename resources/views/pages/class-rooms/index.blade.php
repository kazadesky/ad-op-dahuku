@extends('layouts.app')
@section('title', 'Daftar Kelas')

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
        <span>/ Page / Daftar Kelas</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <a href="{{ route('admin.class-room.create') }}"
                class="outline-none flex items-center justify-center md:w-36 max-md:w-28 h-10 rounded-md shadow bg-blue-500 transition duration-300 hover:bg-blue-600 focus:bg-blue-600 text-white">
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
                            Nama Kelas
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
                    @forelse ($classRoom as $room)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $loop->iteration }}.
                            </th>
                            <td class="px-6 py-4">
                                {{ $room->name }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                <a href="{{ route('admin.class-room.edit', $room->id) }}"
                                    class="outline-none size-10 flex items-center justify-center bg-orange-500 rounded-md transition duration-300 hover:bg-orange-600 focus:bg-orange-600">
                                    <span class="material-symbols-outlined text-[21px]">
                                        border_color
                                    </span>
                                </a>
                                <form action="{{ route('admin.class-room.destroy', $room->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit"
                                        class="outline-none size-10 flex items-center justify-center bg-red-500 rounded-md transition duration-300 hover:bg-red-600 focus:bg-red-600">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            delete
                                        </span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <caption class="caption-bottom my-3">
                            Belum ada kelas yang terdaftar.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection
