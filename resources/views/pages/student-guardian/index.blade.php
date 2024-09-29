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
        @hasrole('operator')
            <span>Operator</span>
        @endhasrole
        <span>/ Page / Akun Wali Santri</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <a href="{{ route('admin.student.create') }}"
                class="outline-none flex items-center justify-center md:w-36 max-md:w-28 h-10 rounded-md shadow bg-blue-500 transition duration-300 hover:bg-blue-600 focus:bg-blue-600 text-white">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
            </a>
            <form action="{{ route('admin.student.index') }}" method="GET" class="md:w-80">
                <input type="search" name="search"
                    class="w-full md:h-11 max-md:h-10 rounded px-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200 max-md:hidden"
                    placeholder="Cari berdasarkan nama atau nis">
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
            @if (count($studentGuardians) > 0)
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="p-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Wali
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Santri
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NIS
                            </th>
                            <th scope="col" class="px-6 py-3">
                                NISN
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
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $guardian->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $guardian->student->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $guardian->nis }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $guardian->nisn }}
                                </td>
                                <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                    <a href="{{ route('admin.student-guardian.show', $guardian->id) }}"
                                        class="outline-none h-9 w-11 flex items-center justify-center bg-sky-500 rounded-md transition duration-300 hover:bg-sky-600 focus:bg-sky-600">
                                        <span class="material-symbols-outlined text-[21px]">
                                            visibility
                                        </span>
                                    </a>
                                    <a href="{{ route('admin.student-guardian.edit', $guardian->id) }}"
                                        class="outline-none h-9 w-11 flex items-center justify-center bg-orange-500 rounded-md transition duration-300 hover:bg-orange-600 focus:bg-orange-600">
                                        <span class="material-symbols-outlined text-[21px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.student-guardian.destroy', $guardian->id) }}" method="POST">
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

    @hasrole('operator')
    @endhasrole
@endsection
