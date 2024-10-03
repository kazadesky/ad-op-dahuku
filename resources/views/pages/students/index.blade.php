@extends('layouts.app')
@section('title', 'Data Santri')

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
        <span>/ Page / Data Santri</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <a href="{{ route('sa.student.create') }}"
                class="outline-none flex items-center justify-center md:w-40 max-md:w-28 h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
            </a>
            <form action="{{ route('sa.student.index') }}" method="GET" class="md:w-80">
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
        <div class="relative overflow-x-auto bg-white shadow-lg">
            @if (count($students) > 0)
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="p-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Santri
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nis
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @php
                        $i = ($students->currentPage() - 1) * $students->perPage() + 1;
                    @endphp
                    <tbody>
                        @forelse ($students as $student)
                            <tr class="bg-white border-b text-hitam">
                                <th class="p-4">
                                    {{ $i++ }}.
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $student->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $student->nis }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $student->classRoom->name }}
                                </td>
                                <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                    <a href="{{ route('sa.student.show', $student->id) }}"
                                        class="outline-none size-10 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a>
                                    <a href="{{ route('sa.student.edit', $student->id) }}"
                                        class="outline-none size-10 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('sa.student.destroy', $student->id) }}"
                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" method="POST">
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
                                Belum ada data santri yang terinput.
                            </caption>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p class="text-center text-hitam">Data yang anda cari tidak ada.</p>
            @endif
        </div>

        <section class="w-full h-10 mt-3">
            {{ $students->links() }}
        </section>
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <a href="{{ route('admin.student.create') }}"
                class="outline-none flex items-center justify-center md:w-40 max-md:w-28 h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
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
        <div class="relative overflow-x-auto bg-white shadow-lg">
            @if (count($students) > 0)
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="p-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Santri
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nis
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @php
                        $i = ($students->currentPage() - 1) * $students->perPage() + 1;
                    @endphp
                    <tbody>
                        @forelse ($students as $student)
                            <tr class="bg-white border-b text-hitam">
                                <th class="p-4">
                                    {{ $i++ }}.
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $student->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $student->nis }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $student->classRoom->name }}
                                </td>
                                <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                    <a href="{{ route('admin.student.show', $student->id) }}"
                                        class="outline-none size-10 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a>
                                    <a href="{{ route('admin.student.edit', $student->id) }}"
                                        class="outline-none size-10 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.student.destroy', $student->id) }}"
                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')" method="POST">
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
                                Belum ada data santri yang terinput.
                            </caption>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p class="text-center text-hitam">Data yang anda cari tidak ada.</p>
            @endif
        </div>

        <section class="w-full h-10 mt-3">
            {{ $students->links() }}
        </section>
    @endhasrole

    @hasrole('operator')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <a href="{{ route('operator.student.create') }}"
                class="outline-none flex items-center justify-center md:w-40 max-md:w-28 h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
            </a>
            <form action="{{ route('operator.student.index') }}" method="GET" class="md:w-80">
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
        <div class="relative overflow-x-auto bg-white shadow-lg">
            @if (count($students) > 0)
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="p-3">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Santri
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nis
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kelas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @php
                        $i = ($students->currentPage() - 1) * $students->perPage() + 1;
                    @endphp
                    <tbody>
                        @forelse ($students as $student)
                            <tr class="bg-white border-b text-hitam">
                                <th class="p-4">
                                    {{ $i++ }}.
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $student->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $student->nis }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $student->classRoom->name }}
                                </td>
                                <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                    <a href="{{ route('operator.student.show', $student->id) }}"
                                        class="outline-none size-10 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a>
                                    <a href="{{ route('operator.student.edit', $student->id) }}"
                                        class="outline-none size-10 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('operator.student.destroy', $student->id) }}"
                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')"
                                        method="POST">
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
                                Belum ada data santri yang terinput.
                            </caption>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p class="text-center text-hitam">Data yang anda cari tidak ada.</p>
            @endif
        </div>

        <section class="w-full h-10 mt-3">
            {{ $students->links() }}
        </section>
    @endhasrole
@endsection
