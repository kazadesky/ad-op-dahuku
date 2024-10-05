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
        @include('components.modal-export')
        @include('components.modal-filter')
        <div id="modal-search"
            class="animation-fade hidden fixed z-50 w-full md:max-w-screen-lg max-md:w-screen justify-center max-md:px-3 max-md:-ml-3">
            <form action="{{ route('sa.teacher-presence.index') }}" method="GET" enctype="multipart/form-data"
                class="w-full md:max-w-md max-md:w-full rounded-md shadow-md p-5 bg-white max-sm:text-sm">
                <h1 class="mb-3 font-poppins md:text-xl max-md:text-lg capitalize font-bold flex items-center">
                    <span class="material-symbols-outlined text-3xl -ml-2">
                        search
                    </span>
                    <span>Pencarian</span>
                </h1>

                <section class="w-full md:mb-4 max-md:mb-3">
                    <input type="text" name="search" id="search"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('search') border-red-500 @enderror"
                        placeholder="Cari berdasarkan nama">
                    @error('search')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </section>

                <section class="flex flex-col md:space-y-3 max-md:space-y-2">
                    <button type="submit"
                        class="outline-none text-white-text w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf">Search</button>
                    <a href="" onclick="showModalSearch(event)"
                        class="text-center outline-none text-slate-800 underline underline-offset-2 transition duration-300 active:text-elf-green">Close</a>
                </section>
            </form>
        </div>

        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <section class="flex items-center md:space-x-3 max-md:space-x-2">
                {{-- <a href="{{ route('sa.teacher-presence.create') }}"
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-9 md:h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
                    <span class="material-symbols-outlined max-md:text-[21px]">
                        add
                    </span>
                    <span class="max-md:hidden">Tambah</span>
                </a> --}}
                <button type="button" onclick="modalGetPayment(event)"
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-9 md:h-10 rounded-md shadow bg-violet-600 transition duration-300 hover:bg-violet-700 focus:bg-violet-700 text-white-text">
                    <span class="material-symbols-outlined max-md:text-[21px]">
                        filter_alt
                    </span>
                    <span class="max-md:hidden">Filter</span>
                </button>
                <button type="button" onclick="modalGetExport(event)"
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-9 md:h-10 rounded-md shadow bg-red-600 transition duration-300 hover:bg-red-700 focus:bg-red-700 text-white-text">
                    <span class="material-symbols-outlined max-md:text-[21px]">
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
            <button type="button" onclick="showModalSearch(event)"
                class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-9 md:rounded-md max-md:rounded-lg shadow bg-white transition duration-300 md:hidden hover:bg-gray-200 focus:bg-gray-200 text-hitam">
                <span class="material-symbols-outlined max-md:text-[21px]">
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
                                {{ \Carbon\Carbon::parse($presence->time->start)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($presence->time->finish)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $presence->status }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] md:space-x-2 max-md:space-x-1 text-white-text">
                                <a href="{{ route('sa.teacher-presence.show', $presence->id) }}"
                                    class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-sky-500 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        visibility
                                    </span>
                                </a>
                                {{-- <a href="{{ route('sa.teacher-presence.edit', $presence->id) }}"
                                    class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        border_color
                                    </span>
                                </a>
                                <form action="{{ route('sa.teacher-presence.destroy', $presence->id) }}"
                                    onsubmit="return confirm('Apakah anda ingin menghapus absensi ini?')" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            delete
                                        </span>
                                    </button>
                                </form> --}}
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
        @include('components.modal-export')
        @include('components.modal-filter')
        <div id="modal-search"
            class="animation-fade hidden fixed z-50 w-full md:max-w-screen-lg max-md:w-screen justify-center max-md:px-3 max-md:-ml-3">
            <form action="{{ route('admin.teacher-presence.index') }}" method="GET" enctype="multipart/form-data"
                class="w-full md:max-w-md max-md:w-full rounded-md shadow-md p-5 bg-white max-sm:text-sm">
                <h1 class="mb-3 font-poppins md:text-xl max-md:text-lg capitalize font-bold flex items-center">
                    <span class="material-symbols-outlined text-3xl -ml-2">
                        search
                    </span>
                    <span>Pencarian</span>
                </h1>

                <section class="w-full md:mb-4 max-md:mb-3">
                    <input type="text" name="search" id="search"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('search') border-red-500 @enderror"
                        placeholder="Cari berdasarkan nama">
                    @error('search')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </section>

                <section class="flex flex-col md:space-y-3 max-md:space-y-2">
                    <button type="submit"
                        class="outline-none text-white-text w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf">Search</button>
                    <a href="" onclick="showModalSearch(event)"
                        class="text-center outline-none text-slate-800 underline underline-offset-2 transition duration-300 active:text-elf-green">Close</a>
                </section>
            </form>
        </div>

        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <section class="flex items-center md:space-x-3 max-md:space-x-2">
                {{-- <a href="{{ route('admin.teacher-presence.create') }}"
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-9 md:h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
                    <span class="material-symbols-outlined max-md:text-[21px]">
                        add
                    </span>
                    <span class="max-md:hidden">Tambah</span>
                </a> --}}
                <button type="button" onclick="modalGetPayment(event)"
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-9 md:h-10 rounded-md shadow bg-violet-600 transition duration-300 hover:bg-violet-700 focus:bg-violet-700 text-white-text">
                    <span class="material-symbols-outlined max-md:text-[21px]">
                        filter_alt
                    </span>
                    <span class="max-md:hidden">Filter</span>
                </button>
                <button type="button" onclick="modalGetExport(event)"
                    class="outline-none flex items-center justify-center md:w-32 max-md:size-9 md:h-10 rounded-md shadow bg-red-600 transition duration-300 hover:bg-red-700 focus:bg-red-700 text-white-text">
                    <span class="material-symbols-outlined max-md:text-[21px]">
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
            <button type="button" onclick="showModalSearch(event)"
                class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-9 md:rounded-md max-md:rounded-lg shadow bg-white transition duration-300 md:hidden hover:bg-gray-200 focus:bg-gray-200 text-hitam">
                <span class="material-symbols-outlined max-md:text-[21px]">
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
                                {{ \Carbon\Carbon::parse($presence->time->start)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($presence->time->finish)->format('H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $presence->status }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] md:space-x-2 max-md:space-x-1 text-white-text">
                                <a href="{{ route('admin.teacher-presence.show', $presence->id) }}"
                                    class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-sky-500 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        visibility
                                    </span>
                                </a>
                                <a href="{{ route('admin.teacher-presence.edit', $presence->id) }}"
                                    class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        border_color
                                    </span>
                                </a>
                                {{-- <form action="{{ route('admin.teacher-presence.destroy', $presence->id) }}"
                                    onsubmit="return confirm('Apakah anda ingin menghapus absensi ini?')" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            delete
                                        </span>
                                    </button>
                                </form> --}}
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
            <div id="modal-search"
                class="animation-fade hidden fixed z-50 w-full md:max-w-screen-lg max-md:max-w-screen justify-center max-md:px-3 max-md:-ml-5 max-md:mt-32">
                <form action="{{ route('teacher.teacher-presence.index') }}" method="GET" enctype="multipart/form-data"
                    class="w-full md:max-w-md max-md:w-full rounded-md shadow-md p-5 bg-white max-sm:text-sm">
                    <h1 class="mb-3 font-poppins md:text-xl max-md:text-lg capitalize font-bold flex items-center">
                        <span class="material-symbols-outlined text-3xl -ml-2">
                            search
                        </span>
                        <span>Pencarian</span>
                    </h1>

                    <section class="w-full md:mb-4 max-md:mb-3">
                        <input type="text" name="search" id="search"
                            class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('search') border-red-500 @enderror"
                            placeholder="Cari berdasarkan nama">
                        @error('search')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </section>

                    <section class="flex flex-col md:space-y-3 max-md:space-y-2">
                        <button type="submit"
                            class="outline-none text-white-text w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf">Search</button>
                        <a href="" onclick="showModalSearch(event)"
                            class="text-center outline-none text-slate-800 underline underline-offset-2 transition duration-300 active:text-elf-green">Close</a>
                    </section>
                </form>
            </div>
            <a href="{{ $action->action === 0 ? '#' : route('teacher.teacher-presence.create') }}"
                class="outline-none flex items-center justify-center md:w-40 max-md:w-28 md:h-10 max-md:h-9 rounded-md shadow  transition duration-300 text-white-text {{ $action->action === 0 ? 'bg-zinc-400' : 'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700' }}">
                <span class="material-symbols-outlined max-md:text-[21px]">
                    add
                </span>
                <span>Tambah</span>
            </a>
            <form action="{{ route('teacher.teacher-presence.index') }}" method="GET" class="md:w-80">
                <input type="search" name="search"
                    class="w-full md:h-10 max-md:h-9 rounded px-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200 max-md:hidden"
                    placeholder="Cari berdasarkan nama guru" {{ $action->action === 0 ? 'disabled' : '' }}>
            </form>
            <button type="button" onclick="{{ $action->action === 0 ? '' : 'showModalSearch(event)' }}"
                class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-9 md:rounded-md max-md:rounded-lg shadow transition duration-300 md:hidden {{ $action->action === 0 ? 'bg-zinc-400 text-white' : 'bg-white hover:bg-gray-200 focus:bg-gray-200 text-hitam' }}">
                <span class="material-symbols-outlined max-md:text-[21px]">
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
                                <td
                                    class="px-6 py-2 flex items-center min-h-[1rem] md:space-x-2 max-md:space-x-1 text-white-text">
                                    <a href="{{ route('teacher.teacher-presence.show', $presence->id) }}"
                                        class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a>
                                    <a href="{{ route('teacher.teacher-presence.edit', $presence->id) }}"
                                        class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('teacher.teacher-presence.destroy', $presence->id) }}"
                                        onsubmit="return comfirm('Apakah anda ingin menghapus absensi ini?')" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
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
