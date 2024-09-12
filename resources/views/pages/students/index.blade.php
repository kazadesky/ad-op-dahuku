@extends('layouts.app')
@section('title', 'Data Santri')

@section('subtitle')
    @hasrole('super_admin')
        <p class="flex items-center space-x-px capitalize text-white">
            <span>Super Admin</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span>Page</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span class="text-gray-200">Data Santri</span>
        </p>
    @endhasrole

    @hasrole('admin')
        <p class="flex items-center space-x-px capitalize text-white">
            <span>Admin</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span>Page</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span class="text-gray-200">Data Santri</span>
        </p>
    @endhasrole

    @hasrole('operator')
        <p class="flex items-center space-x-px capitalize text-white">
            <span>Operator</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span>Page</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span class="text-gray-200">Data Santri</span>
        </p>
    @endhasrole
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-between">
            <a href="{{ route('admin.student.create') }}"
                class="outline-none flex items-center justify-center md:w-40 max-md:w-32 h-10 rounded-md shadow bg-blue-500 transition duration-300 hover:bg-blue-600 focus:bg-blue-600 text-white mb-3">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
            </a>
        </div>
        <div class="relative overflow-x-auto bg-white shadow-lg">
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
                            <td class="px-6 py-4">
                                <!-- Actions here -->
                            </td>
                        </tr>
                    @empty
                        <caption class="caption-bottom my-3">
                            Belum ada data santri yang terinput.
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>

        <section class="w-full h-10 mt-3">
            {{ $students->links() }}
        </section>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection
