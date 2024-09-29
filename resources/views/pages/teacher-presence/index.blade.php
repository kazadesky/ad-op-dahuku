@extends('layouts.app')
@section('title', 'Absensi Guru')

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
        <span>/ Page / Absensi Guru</span>
    </p>
@endsection

@section('content')
    @hasrole('admin')
        @include('components.modal-filter')
        <div class="w-full flex items-center justify-between mb-3">
            <section class="flex items-center space-x-3">
                <a href="{{ route('admin.teacher-presence.create') }}"
                    class="outline-none flex items-center justify-center md:w-32 max-md:w-28 h-10 rounded-md shadow bg-blue-500 transition duration-300 hover:bg-blue-600 focus:bg-blue-600 text-white">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                    <span>Tambah</span>
                </a>
                <button type="button" onclick="modalGetPayment(event)"
                    class="outline-none flex items-center justify-center md:w-32 max-md:w-28 h-10 rounded-md shadow bg-violet-500 transition duration-300 hover:bg-violet-600 focus:bg-violet-600 text-white">
                    <span class="material-symbols-outlined">
                        filter_alt
                    </span>
                    <span>Filter</span>
                </button>
                <button type="button" onclick=""
                    class="outline-none flex items-center justify-center md:w-32 max-md:w-28 h-10 rounded-md shadow bg-red-500 transition duration-300 hover:bg-red-600 focus:bg-red-600 text-white">
                    <span class="material-symbols-outlined">
                        download
                    </span>
                    <span>PDF</span>
                </button>
            </section>
            <form action="{{ route('admin.teacher-presence.index') }}" method="GET" class="md:w-80">
                <input type="hidden" name="month" value="{{ request('month') }}">
                <input type="hidden" name="year" value="{{ request('year') }}">
                <input type="search" name="search"
                    class="w-full h-11 rounded px-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200"
                    placeholder="Cari berdasarkan nama guru">
            </form>
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
                            Nama Guru
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pelajaran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jadwal Kelas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @php
                    $i = ($presences->currentPage() - 1) * $presences->perPage() + 1;
                @endphp
                <tbody>
                    @forelse ($presences as $presence)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $i++ }}.
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $presence->teacher->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $presence->lesson->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $presence->classRoom->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $presence->time->start }} - {{ $presence->time->finish }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $presence->status }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                <a href="{{ route('admin.teacher-presence.show', $presence->id) }}"
                                    class="outline-none h-9 w-11 flex items-center justify-center bg-sky-500 rounded-md transition duration-300 hover:bg-sky-600 focus:bg-sky-600">
                                    <span class="material-symbols-outlined text-[21px]">
                                        visibility
                                    </span>
                                </a>
                                <a href="{{ route('admin.teacher-presence.edit', $presence->id) }}"
                                    class="outline-none h-9 w-11 flex items-center justify-center bg-orange-500 rounded-md transition duration-300 hover:bg-orange-600 focus:bg-orange-600">
                                    <span class="material-symbols-outlined text-[21px]">
                                        border_color
                                    </span>
                                </a>
                                <form action="{{ route('admin.teacher-presence.destroy', $presence->id) }}" method="POST">
                                    @csrf
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
                            Belum ada data absensi yang anda lakukan.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>

        <section class="w-full h-10 mt-3">
            {{ $presences->links() }}
        </section>
    @endhasrole

    @hasrole('teacher')
        <div class="w-full flex items-center justify-between mb-3">
            <a href="{{ $action->action === 0 ? '#' : route('teacher.teacher-presence.create') }}"
                class="outline-none flex items-center justify-center md:w-40 max-md:w-32 h-10 rounded-md shadow  transition duration-300 text-white {{ $action->action === 0 ? 'bg-zinc-400' : 'bg-blue-500 hover:bg-blue-600 focus:bg-blue-600' }}">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
            </a>
            <form action="{{ route('teacher.teacher-presence.index') }}" method="GET" class="md:w-80">
                <input type="search" name="search"
                    class="w-full h-11 rounded px-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200"
                    placeholder="Cari berdasarkan nama guru" {{ $action->action === 0 ? 'disabled' : '' }}>
            </form>
        </div>
        @if (session('success'))
            <div id="banner-alert" class="w-full h-12 px-3 flex items-center bg-sky-600 rounded-md shadow mb-3 text-white">
                <p>
                    <strong class="max-md:hidden">Success : </strong>
                    <span>{{ session('success') }}</span>
                </p>
            </div>
        @endif
        @if ($action->action === 1)
            <div class="relative overflow-x-auto bg-white shadow-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="p-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Guru
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pelajaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jadwal Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hari, Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @php
                        $i = ($presences->currentPage() - 1) * $presences->perPage() + 1;
                    @endphp
                    <tbody>
                        @forelse ($presences as $presence)
                            <tr class="bg-white border-b text-hitam">
                                <th class="p-4">
                                    {{ $i++ }}.
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $presence->teacher->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $presence->lesson->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $presence->classRoom->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $presence->time->start }} - {{ $presence->time->finish }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $presence->day->name }}, {{ \Carbon\Carbon::parse($presence->created_at)->format("d-m-Y") }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $presence->status }}
                                </td>
                                <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                    <a href="{{ route('teacher.teacher-presence.show', $presence->id) }}"
                                        class="outline-none h-9 w-11 flex items-center justify-center bg-sky-500 rounded-md transition duration-300 hover:bg-sky-600 focus:bg-sky-600">
                                        <span class="material-symbols-outlined text-[21px]">
                                            visibility
                                        </span>
                                    </a>
                                    <a href="{{ route('teacher.teacher-presence.edit', $presence->id) }}"
                                        class="outline-none h-9 w-11 flex items-center justify-center bg-orange-500 rounded-md transition duration-300 hover:bg-orange-600 focus:bg-orange-600">
                                        <span class="material-symbols-outlined text-[21px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('teacher.teacher-presence.destroy', $presence->id) }}"
                                        method="POST">
                                        @csrf
                                        @method("DELETE")
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
                                Belum ada data absensi yang anda lakukan.
                            </caption>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <section class="w-full h-10 mt-3">
                {{ $presences->links() }}
            </section>
        @elseif ($action->action === 0)
            <div class="relative overflow-x-auto bg-white shadow-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="p-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Guru
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pelajaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jadwal Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <caption class="caption-bottom my-3">
                            Jadwal piket absensi guru belum diaktifkan.
                        </caption>
                    </tbody>
                </table>
            </div>
        @endif
    @endhasrole
@endsection
