@extends('layouts.app')
@section('title', 'Detail Data Santri')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white-text">
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
        <div class="w-full flex items-center justify-end mb-3 max-md:text-sm">
            <a href="{{ route('sa.student.index') }}"
                class="outline-none md:h-10 max-md:h-9 rounded-md text-white-text md:w-36 max-md:w-28 flex items-center justify-center font-medium bg-red-600 shadow transition duration-300 hover:bg-red-700 focus:bg-red-700">Kembali</a>
        </div>

        <div class="w-full p-5 rounded-md shadow-lg bg-white mb-10 max-md:text-sm">
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Nama Lengkap</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">NIS</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->nis }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">NISN</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->nisn }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Kelas</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->classRoom->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Tempat Lahir</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->place_of_birth }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Tanggal Lahir</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->date_of_birth }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Jenis Kelamin</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->gender }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Alamat</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->address }}</p>
            </div>
        </div>

        {{-- payment --}}
        <div class="relative overflow-x-auto bg-white shadow-lg mb-3 max-md:text-sm">
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
                    $i = ($achievements->currentPage() - 1) * $achievements->perPage() + 1;
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
        <section class="w-full mt-4 mb-8">
            {{ $payments->links() }}
        </section>

        {{-- achievement --}}
        {{-- @include('components.alert') --}}
        <div class="relative overflow-x-auto bg-white shadow-lg mb-3 max-md:text-sm">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
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
                    $i = ($achievements->currentPage() - 1) * $achievements->perPage() + 1;
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
                                {{ \Carbon\Carbon::parse($achievement->created_at)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $achievement->achievement }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                <a href="{{ route('sa.student-achievement.edit', [$achievement->id, $student->id]) }}"
                                    class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        border_color
                                    </span>
                                </a>
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
        <section class="w-full mt-4 mb-8">
            {{ $achievements->links() }}
        </section>

        {{-- misconduct --}}
        {{-- @include('components.alert') --}}
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
                    $i = ($achievements->currentPage() - 1) * $achievements->perPage() + 1;
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
                                {{ \Carbon\Carbon::parse($misconduct->created_at)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $misconduct->misconduct }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                <a href="{{ route('sa.student-misconduct.edit', [$misconduct->id, $student->id]) }}"
                                    class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        border_color
                                    </span>
                                </a>
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
        <section class="w-full mt-4 mb-8">
            {{ $misconducts->links() }}
        </section>
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-end mb-3 max-md:text-sm">
            <a href="{{ route('admin.student.index') }}"
                class="outline-none md:h-10 max-md:h-9 rounded-md text-white-text md:w-36 max-md:w-28 flex items-center justify-center font-medium bg-red-600 shadow transition duration-300 hover:bg-red-700 focus:bg-red-700">Kembali</a>
        </div>

        <div class="w-full p-5 rounded-md shadow-lg bg-white mb-10 max-md:text-sm">
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Nama Lengkap</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">NIS</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->nis }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">NISN</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->nisn }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Kelas</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->classRoom->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Tempat Lahir</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->place_of_birth }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Tanggal Lahir</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->date_of_birth }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Jenis Kelamin</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->gender }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Alamat</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->address }}</p>
            </div>
        </div>

        {{-- payment --}}
        <div class="relative overflow-x-auto bg-white shadow-lg mb-3 max-md:text-sm">
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
                    $i = ($achievements->currentPage() - 1) * $achievements->perPage() + 1;
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
        <section class="w-full mt-4 mb-8">
            {{ $payments->links() }}
        </section>

        {{-- achievement --}}
        {{-- @include('components.alert') --}}
        <div class="relative overflow-x-auto bg-white shadow-lg mb-3 max-md:text-sm">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
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
                    $i = ($achievements->currentPage() - 1) * $achievements->perPage() + 1;
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
                                {{ \Carbon\Carbon::parse($achievement->created_at)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $achievement->achievement }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                <a href="{{ route('admin.student-achievement.edit', [$achievement->id, $student->id]) }}"
                                    class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        border_color
                                    </span>
                                </a>
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
        <section class="w-full mt-4 mb-8">
            {{ $achievements->links() }}
        </section>

        {{-- misconduct --}}
        {{-- @include('components.alert') --}}
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
                    $i = ($achievements->currentPage() - 1) * $achievements->perPage() + 1;
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
                                {{ \Carbon\Carbon::parse($misconduct->created_at)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $misconduct->misconduct }}
                            </td>
                            <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white-text">
                                <a href="{{ route('admin.student-misconduct.edit', [$misconduct->id, $student->id]) }}"
                                    class="outline-none md:size-10 max-md:size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                    <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                        border_color
                                    </span>
                                </a>
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
        <section class="w-full mt-4 mb-8">
            {{ $misconducts->links() }}
        </section>
    @endhasrole

    @hasrole('operator')
        <div class="w-full flex items-center justify-end mb-3 max-md:text-sm">
            <a href="{{ route('operator.student.index') }}"
                class="outline-none md:h-10 max-md:h-9 rounded-md text-white-text md:w-36 max-md:w-28 flex items-center justify-center font-medium bg-red-600 shadow transition duration-300 hover:bg-red-700 focus:bg-red-700">Kembali</a>
        </div>

        <div class="w-full p-5 rounded-md shadow-lg bg-white mb-10 max-md:text-sm">
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Nama Lengkap</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">NIS</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->nis }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">NISN</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->nisn }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Kelas</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->classRoom->name }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Tempat Lahir</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->place_of_birth }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Tanggal Lahir</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->date_of_birth }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Jenis Kelamin</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->gender }}</p>
            </div>
            <div class="flex md:items-center max-md:items-start md:h-12 max-md:min-h-11">
                <p class="md:font-bold max-md:font-semibold w-44">Alamat</p>
                <p class="w-5 font-bold">:</p>
                <p class="w-full">{{ $student->address }}</p>
            </div>
        </div>
    @endhasrole
@endsection
