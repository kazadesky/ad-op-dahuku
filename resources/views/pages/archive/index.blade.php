@extends('layouts.app')
@section('title', 'Arsip Data')

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
        <span>/ Page / Arsip Data</span>
    </p>
@endsection

@section('content')
    @include('components.modal-archive')

    @hasrole('super_admin')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <button type="button" onclick="showModalArchive(event)"
                class="outline-none flex items-center justify-center md:w-36 max-md:w-28 h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
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
                            Nama User
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama File
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            File
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @php
                    $i = ($sa_archives->currentPage() - 1) * $sa_archives->perPage() + 1;
                @endphp
                <tbody>
                    @forelse ($sa_archives as $archive)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $i++ }}.
                            </th>
                            <td class="px-6 py-4">
                                {{ $archive->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $archive->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($archive->created_at)->format('d-M-Y H:i:s') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $archive->file }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                <a href="{{ url('storage/archives/', $archive->file) }}"
                                    class="outline-none size-10 flex items-center justify-center bg-green-600 rounded-md transition duration-300 hover:bg-green-700 focus:bg-green-700 active:bg-green-800">
                                    <span class="material-symbols-outlined text-[21px]">
                                        download
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <caption class="caption-bottom my-3">
                            Belum ada data yang diarsipkan.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>
        <section class="w-full h-10 mt-3">
            {{ $sa_archives->links() }}
        </section>
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <button type="button" onclick="showModalArchive(event)"
                class="outline-none flex items-center justify-center md:w-36 max-md:w-28 h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
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
                            Nama File
                        </th>
                        <th scope="col" class="px-6 py-3">
                            File
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @php
                    $i = ($archives->currentPage() - 1) * $archives->perPage() + 1;
                @endphp
                <tbody>
                    @forelse ($archives as $archive)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $i++ }}.
                            </th>
                            <td class="px-6 py-4">
                                {{ $archive->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $archive->file }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                <a href="{{ url('storage/archives/', $archive->file) }}"
                                    class="outline-none size-10 flex items-center justify-center bg-green-600 rounded-md transition duration-300 hover:bg-green-700 focus:bg-green-700 active:bg-green-800">
                                    <span class="material-symbols-outlined text-[21px]">
                                        download
                                    </span>
                                </a>
                                <form action="{{ route('teacher.archive.destroy', $archive->id) }}"
                                    onsubmit="return confirm('Apakah anda yakin menghapus arsip data ini?')" method="POST">
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
                            Belum ada data yang diarsipkan.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>
        <section class="w-full h-10 mt-3">
            {{ $archives->links() }}
        </section>
    @endhasrole

    @hasrole('operator')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <button type="button" onclick="showModalArchive(event)"
                class="outline-none flex items-center justify-center md:w-36 max-md:w-28 h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
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
                            Nama File
                        </th>
                        <th scope="col" class="px-6 py-3">
                            File
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @php
                    $i = ($archives->currentPage() - 1) * $archives->perPage() + 1;
                @endphp
                <tbody>
                    @forelse ($archives as $archive)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $i++ }}.
                            </th>
                            <td class="px-6 py-4">
                                {{ $archive->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $archive->file }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                <a href="{{ url('storage/archives/', $archive->file) }}"
                                    class="outline-none size-10 flex items-center justify-center bg-green-600 rounded-md transition duration-300 hover:bg-green-700 focus:bg-green-700 active:bg-green-800">
                                    <span class="material-symbols-outlined text-[21px]">
                                        download
                                    </span>
                                </a>
                                <form action="{{ route('teacher.archive.destroy', $archive->id) }}"
                                    onsubmit="return confirm('Apakah anda yakin menghapus arsip data ini?')" method="POST">
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
                            Belum ada data yang diarsipkan.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>
        <section class="w-full h-10 mt-3">
            {{ $archives->links() }}
        </section>
    @endhasrole

    @hasrole('teacher')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <button type="button" onclick="showModalArchive(event)"
                class="outline-none flex items-center justify-center md:w-36 max-md:w-28 h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
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
                            Nama File
                        </th>
                        <th scope="col" class="px-6 py-3">
                            File
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @php
                    $i = ($archives->currentPage() - 1) * $archives->perPage() + 1;
                @endphp
                <tbody>
                    @forelse ($archives as $archive)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $i++ }}.
                            </th>
                            <td class="px-6 py-4">
                                {{ $archive->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $archive->file }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                <a href="{{ url('storage/archives/', $archive->file) }}"
                                    class="outline-none size-10 flex items-center justify-center bg-green-600 rounded-md transition duration-300 hover:bg-green-700 focus:bg-green-700 active:bg-green-800">
                                    <span class="material-symbols-outlined text-[21px]">
                                        download
                                    </span>
                                </a>
                                <form action="{{ route('teacher.archive.destroy', $archive->id) }}"
                                    onsubmit="return confirm('Apakah anda yakin menghapus arsip data ini?')" method="POST">
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
                            Belum ada data yang diarsipkan.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>
        <section class="w-full h-10 mt-3">
            {{ $archives->links() }}
        </section>
    @endhasrole
@endsection
