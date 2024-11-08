@extends('layouts.app')
@section('title', 'Akun Wali Santri')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white">
        @hasrole('super_admin')
            <span>Super Admin</span>
        @endhasrole
        @hasrole('admin')
            <span>Admin</span>
        @endhasrole
        <span>/ Page / Akun Wali Santri</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <div id="modal-search"
            class="animation-fade hidden fixed z-50 w-full md:max-w-screen-lg max-md:w-screen justify-center max-md:px-3 max-md:-ml-3">
            <form action="{{ route('admin.student-guardian.index') }}" method="GET" enctype="multipart/form-data"
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
                        placeholder="Cari berdasarkan nama atau nis...">
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
            <a href="{{ route('admin.student-guardian.create') }}"
                class="outline-none flex items-center justify-center md:w-36 max-md:w-28 md:h-10 max-md:h-9 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white">
                <span class="material-symbols-outlined max-md:text-[21px]">
                    add
                </span>
                <span>Tambah</span>
            </a>
            <form action="{{ route('admin.student-guardian.index') }}" method="GET" class="md:w-80">
                <input type="search" name="search"
                    class="w-full md:h-10 max-md:h-9 rounded px-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200 max-md:hidden"
                    placeholder="Cari berdasarkan nama atau nis">
            </form>
            <button type="button" onclick="showModalSearch(event)"
                class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-9 md:rounded-md max-md:rounded-lg shadow bg-white transition duration-300 md:hidden hover:bg-gray-200 focus:bg-gray-200 text-hitam">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
        </div>
        @include('components.alert')
        <div class="relative overflow-x-auto bg-white shadow-lg max-md:text-sm">
            @if (count($studentGuardians) > 0)
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="p-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Profil
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Wali
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Santri
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIS
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @php
                        $i = ($studentGuardians->currentPage() - 1) * $studentGuardians->perPage() + 1;
                    @endphp
                    <tbody>
                        @forelse ($studentGuardians as $guardian)
                            <tr class="bg-white border-b text-hitam">
                                <th class="p-4">
                                    {{ $i++ }}.
                                </th>
                                <td class="px-6 py-4">
                                    <figure class="md:size-20 max-md:size-12 overflow-hidden rounded-full">
                                        <img src="{{ !$guardian->profile ? asset('img/icon/user.png') : url('storage/profile/guardian/', $guardian->profile) }}"
                                            alt="profile {{ $guardian->name }}" class="w-full">
                                    </figure>
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $guardian->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $guardian->student->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $guardian->student->classRoom->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $guardian->nis }}
                                </td>
                                <td class="px-6 py-2 justify-start flex items-center md:pt-8 max-md:pt-5 min-h-[1rem] md:space-x-2 max-md:space-x-1 text-white">
                                    <a href="{{ route('admin.student-guardian.show', $guardian->id) }}"
                                        class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-sky-500 rounded-md transition duration-300 hover:bg-sky-600 focus:bg-sky-600">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a>
                                    <a href="{{ route('admin.student-guardian.edit', $guardian->id) }}"
                                        class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-orange-500 rounded-md transition duration-300 hover:bg-orange-600 focus:bg-orange-600">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.student-guardian.destroy', $guardian->id) }}" onsubmit="return confirm('Apakah anda ingin menghapus akun ini?')" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-red-500 rounded-md transition duration-300 hover:bg-red-600 focus:bg-red-600">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                delete
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <caption class="caption-bottom my-3">
                                Belum ada akun wali santri yang terdaftar.
                            </caption>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p class="text-center text-hitam py-2">Akun wali santri belum ada.</p>
            @endif
        </div>

        <section class="w-full h-10 mt-3">
            {{ $studentGuardians->links() }}
        </section>
    @endhasrole
@endsection
