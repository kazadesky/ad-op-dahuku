@extends('layouts.app')
@section('title', 'Absensi Guru')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white-text">
        @hasrole('super_admin')
            <span>Super Admin</span>
        @endhasrole
        @hasrole('admin')
            <span>Admin</span>
        @endhasrole
        @hasrole('teacher')
            <span>Teacher</span>
        @endhasrole
        <span>/ Page / Absensi Guru</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
        @include('components.modal-filter')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <section class="flex items-center md:space-x-3 max-md:space-x-2">
                <a href="{{ route('sa.teacher-presence.create') }}"
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-10 md:h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                    <span class="max-md:hidden">Tambah</span>
                </a>
                <button type="button" onclick="modalGetPayment(event)"
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-10 md:h-10 rounded-md shadow bg-violet-600 transition duration-300 hover:bg-violet-700 focus:bg-violet-700 text-white-text">
                    <span class="material-symbols-outlined">
                        filter_alt
                    </span>
                    <span class="max-md:hidden">Filter</span>
                </button>
                <button type="button" onclick=""
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-10 md:h-10 rounded-md shadow bg-red-600 transition duration-300 hover:bg-red-700 focus:bg-red-700 text-white-text">
                    <span class="material-symbols-outlined">
                        download
                    </span>
                    <span class="max-md:hidden">PDF</span>
                </button>
            </section>
            <form action="{{ route('sa.teacher-presence.index') }}" method="GET" class="md:w-80">
                <input type="hidden" name="month" value="{{ request('month') }}">
                <input type="hidden" name="year" value="{{ request('year') }}">
                <input type="search" name="search"
                    class="w-full md:h-11 max-md:h-10 rounded px-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200 max-md:hidden"
                    placeholder="Cari berdasarkan nama guru">
            </form>
            <button type="button" onclick=""
                class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-white transition duration-300 md:hidden hover:bg-gray-200 focus:bg-gray-200 text-hitam">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
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
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                <a href="{{ route('sa.teacher-presence.show', $presence->id) }}"
                                    class="outline-none size-10 flex items-center justify-center bg-sky-500 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        visibility
                                    </span>
                                </a>
                                <a href="{{ route('sa.teacher-presence.edit', $presence->id) }}"
                                    class="outline-none size-10 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        border_color
                                    </span>
                                </a>
                                <form action="{{ route('sa.teacher-presence.destroy', $presence->id) }}"
                                    onsubmit="return confirm('Apakah anda ingin menghapus absensi ini?')" method="POST">
                                    @csrf
                                    @method("DELETE")
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

    @hasrole('admin')
        @include('components.modal-filter')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <section class="flex items-center md:space-x-3 max-md:space-x-2">
                <a href="{{ route('admin.teacher-presence.create') }}"
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-10 md:h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                    <span class="max-md:hidden">Tambah</span>
                </a>
                <button type="button" onclick="modalGetPayment(event)"
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-10 md:h-10 rounded-md shadow bg-violet-600 transition duration-300 hover:bg-violet-700 focus:bg-violet-700 text-white-text">
                    <span class="material-symbols-outlined">
                        filter_alt
                    </span>
                    <span class="max-md:hidden">Filter</span>
                </button>
                <button type="button" onclick=""
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-10 md:h-10 rounded-md shadow bg-red-600 transition duration-300 hover:bg-red-700 focus:bg-red-700 text-white-text">
                    <span class="material-symbols-outlined">
                        download
                    </span>
                    <span class="max-md:hidden">PDF</span>
                </button>
            </section>
            <form action="{{ route('admin.teacher-presence.index') }}" method="GET" class="md:w-80">
                <input type="hidden" name="month" value="{{ request('month') }}">
                <input type="hidden" name="year" value="{{ request('year') }}">
                <input type="search" name="search"
                    class="w-full md:h-11 max-md:h-10 rounded px-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200 max-md:hidden"
                    placeholder="Cari berdasarkan nama guru">
            </form>
            <button type="button" onclick=""
                class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-white transition duration-300 md:hidden hover:bg-gray-200 focus:bg-gray-200 text-hitam">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
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
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                <a href="{{ route('admin.teacher-presence.show', $presence->id) }}"
                                    class="outline-none size-10 flex items-center justify-center bg-sky-500 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        visibility
                                    </span>
                                </a>
                                <a href="{{ route('admin.teacher-presence.edit', $presence->id) }}"
                                    class="outline-none size-10 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        border_color
                                    </span>
                                </a>
                                <form action="{{ route('admin.teacher-presence.destroy', $presence->id) }}"
                                    onsubmit="return confirm('Apakah anda ingin menghapus absensi ini?')" method="POST">
                                    @csrf
                                    @method("DELETE")
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
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <a href="{{ $action->action === 0 ? '#' : route('teacher.teacher-presence.create') }}"
                class="outline-none flex items-center justify-center md:w-40 max-md:w-28 h-10 rounded-md shadow  transition duration-300 text-white-text {{ $action->action === 0 ? 'bg-zinc-400' : 'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700' }}">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
            </a>
            <form action="{{ route('teacher.teacher-presence.index') }}" method="GET" class="md:w-80">
                <input type="search" name="search"
                    class="w-full md:h-11 max-md:h-10 rounded px-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200 max-md:hidden"
                    placeholder="Cari berdasarkan nama guru" {{ $action->action === 0 ? 'disabled' : '' }}>
            </form>
            <button type="button" onclick=""
                class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-white transition duration-300 md:hidden hover:bg-gray-200 focus:bg-gray-200 text-hitam">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
        </div>
        @include('components.alert')
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
                                    {{ $presence->day->name }},
                                    {{ \Carbon\Carbon::parse($presence->created_at)->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $presence->status }}
                                </td>
                                <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                    <a href="{{ route('teacher.teacher-presence.show', $presence->id) }}"
                                        class="outline-none size-10 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a>
                                    <a href="{{ route('teacher.teacher-presence.edit', $presence->id) }}"
                                        class="outline-none size-10 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('teacher.teacher-presence.destroy', $presence->id) }}"
                                        onsubmit="return comfirm('Apakah anda ingin menghapus absensi ini?')" method="POST">
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
