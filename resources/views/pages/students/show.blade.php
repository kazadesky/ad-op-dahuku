@extends('layouts.app')
@section('title', 'Detail Data Santri')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white">
        @hasrole('super_admin')
            <span>Super Admin </span>
        @endhasrole
        @hasrole('admin')
            <span>Admin </span>
        @endhasrole
        @hasrole('operator')
            <span>Operator </span>
        @endhasrole
        <span> / Page / Detail Santri</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-end mb-3">
            <a href="{{ route('admin.student.index') }}"
                class="outline-none h-11 rounded-md text-white w-36 flex items-center justify-center font-medium bg-red-500 shadow transition duration-300 hover:bg-red-600 focus:bg-red-600">Kembali</a>
        </div>

        <div class="w-full p-5 rounded-md shadow-lg bg-white mb-10">
            <div class="flex items-center h-12">
                <p class="font-bold w-44">Nama Lengkap</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->name }}</p>
            </div>
            <div class="flex items-center h-12">
                <p class="font-bold w-44">NIS</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->nis }}</p>
            </div>
            <div class="flex items-center h-12">
                <p class="font-bold w-44">NISN</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->nisn }}</p>
            </div>
            <div class="flex items-center h-12">
                <p class="font-bold w-44">Kelas</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->classRoom->name }}</p>
            </div>
            <div class="flex items-center h-12">
                <p class="font-bold w-44">Tempat Lahir</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->place_of_birth }}</p>
            </div>
            <div class="flex items-center h-12">
                <p class="font-bold w-44">Tanggal Lahir</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->date_of_birth }}</p>
            </div>
            <div class="flex items-center h-12">
                <p class="font-bold w-44">Jenis Kelamin</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->gender }}</p>
            </div>
            <div class="flex items-center h-12">
                <p class="font-bold w-44">Alamat</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->address }}</p>
            </div>
        </div>

        <div class="relative overflow-x-auto bg-white shadow-lg mb-10">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="p-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Bulan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tahun
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pembayaran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Pembayaran
                        </th>
                    </tr>
                </thead>
                @php
                    // $i = ($achievements->currentPage() - 1) * $achievements->perPage() + 1;
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($payments as $payment)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $i++ }}.
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $payment->moon->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $payment->year }}
                            </td>
                            <td class="px-6 py-4">
                                Rp. {{ number_format($payment->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $payment->status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y') }}
                            </td>
                            {{-- <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">

                            </td> --}}
                        </tr>
                    @empty
                        <caption class="caption-bottom my-3">
                            Belum ada pembayaran bulanan atas nama <span
                                class="font-medium italic">{{ $student->name }}.</span>
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="relative overflow-x-auto bg-white shadow-lg mb-10">
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
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pencapaian
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @php
                    // $i = ($achievements->currentPage() - 1) * $achievements->perPage() + 1;
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($achievements as $achievement)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $i++ }}.
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $achievement->teacher->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ \Carbon::differenthuman($achievement->created_at) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $achievement->achievement }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                class="outline-none h-9 w-11 flex items-center justify-center bg-sky-500 rounded-md transition duration-300 hover:bg-sky-600 focus:bg-sky-600">
                                <span class="material-symbols-outlined text-[21px]">
                                    visibility
                                </span>
                                </a>
                                <a href="{{ route('admin.achievement.edit', $achievement->id) }}"
                                    class="outline-none h-9 w-11 flex items-center justify-center bg-orange-500 rounded-md transition duration-300 hover:bg-orange-600 focus:bg-orange-600">
                                    <span class="material-symbols-outlined text-[21px]">
                                        border_color
                                    </span>
                                </a>
                                <form action="{{ route('admin.achievement.destroy', $achievement->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="outline-none h-9 w-11 flex items-center justify-center bg-red-500 rounded-md transition duration-300 hover:bg-red-600 focus:bg-red-600">
                                        <span class="material-symbols-outlined text-[21px]">
                                            delete
                                        </span>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @empty
                        <caption class="caption-bottom my-3">
                            Belum ada pencapaian yang dilakukan oleh <span
                                class="font-medium italic">{{ $student->name }}.</span>
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>

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
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pelanggaran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                @php
                    // $i = ($misconducts->currentPage() - 1) * $misconducts->perPage() + 1;
                    $i = 1;
                @endphp
                <tbody>
                    @forelse ($misconducts as $misconduct)
                        <tr class="bg-white border-b text-hitam">
                            <th class="p-4">
                                {{ $i++ }}.
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $misconduct->teacher->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ \Carbon::differenhuman($misconduct->created_at) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $misconduct->misconduct }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                {{-- <a href="{{ route('admin.misconduct.show', $misconduct->id) }}"
                                        class="outline-none h-9 w-11 flex items-center justify-center bg-sky-500 rounded-md transition duration-300 hover:bg-sky-600 focus:bg-sky-600">
                                        <span class="material-symbols-outlined text-[21px]">
                                            visibility
                                        </span>
                                    </a>
                                    <a href="{{ route('admin.misconduct.edit', $misconduct->id) }}"
                                        class="outline-none h-9 w-11 flex items-center justify-center bg-orange-500 rounded-md transition duration-300 hover:bg-orange-600 focus:bg-orange-600">
                                        <span class="material-symbols-outlined text-[21px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.misconduct.destroy', $misconduct->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="outline-none h-9 w-11 flex items-center justify-center bg-red-500 rounded-md transition duration-300 hover:bg-red-600 focus:bg-red-600">
                                            <span class="material-symbols-outlined text-[21px]">
                                                delete
                                            </span>
                                        </button>
                                    </form> --}}
                            </td>
                        </tr>
                    @empty
                        <caption class="caption-bottom my-3">
                            Belum ada pelanggaran yang dilakukan oleh <span
                                class="font-medium italic">{{ $student->name }}.</span>
                        </caption>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection
