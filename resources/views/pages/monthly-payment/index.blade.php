@extends('layouts.app')
@section('title', 'Pembayaran Bulanan Santri')

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
        <span>/ Page / Pembayaran Bulanan</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
        @include('components.modal-export')
        @include('components.modal-filter')
        <div id="modal-search"
            class="animation-fade hidden fixed z-50 w-full md:max-w-screen-lg max-md:w-screen justify-center max-md:px-3 max-md:-ml-3">
            <form action="{{ route('admin.student.index') }}" method="GET" enctype="multipart/form-data"
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
                        placeholder="Cari berdasarkan nama atau nis">
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
                <button type="button" onclick="modalGetPayment(event)"
                    class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-violet-600 transition duration-300 hover:bg-violet-700 focus:bg-violet-700 text-white">
                    <span class="material-symbols-outlined">
                        filter_alt
                    </span>
                    <span class="max-md:hidden">Filter</span>
                </button>
                <button type="button" onclick="modalGetExport(event)"
                    class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-red-600 transition duration-300 hover:bg-red-700 focus:bg-red-700 text-white">
                    <span class="material-symbols-outlined">
                        download
                    </span>
                    <span class="max-md:hidden">PDF</span>
                </button>
            </section>
            <form action="{{ route('sa.monthly-payment.index') }}" method="GET" class="md:w-80">
                <input type="hidden" name="month" value="{{ request('month') }}">
                <input type="hidden" name="year" value="{{ request('year') }}">
                <input type="search" name="search"
                    class="w-full md:h-11 max-md:h-10 max-md:hidden rounded px-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200"
                    placeholder="Cari berdasarkan nama santri">
            </form>
            <button type="button" onclick="showModalSearch(event)"
                class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-white transition duration-300 md:hidden hover:bg-gray-200 focus:bg-gray-200 text-hitam">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
        </div>
        <div class="relative overflow-x-auto bg-white shadow-lg">
            @if (count($payments) > 0)
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
                                Bulan Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tahun Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Dibuat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Diupdate
                            </th>
                        </tr>
                    </thead>
                    @php
                        $i = ($payments->currentPage() - 1) * $payments->perPage() + 1;
                    @endphp
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr class="bg-white border-b text-hitam">
                                <th class="p-4">
                                    {{ $i++ }}.
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $payment->student->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $payment->moon->name }}
                                </td>
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
                                    {{ \Carbon\Carbon::parse($payment->created_at)->format('d-M-Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($payment->updated_at)->format('d-M-Y') }}
                                </td>
                            </tr>
                        @empty
                            <caption class="caption-bottom my-3">
                                Belum terdapat pembayaran bulanan yang dilakukan.
                            </caption>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p class="text-center text-hitam">Belum ada transaksi yang dilakukan pada bulan ini.</p>
            @endif
        </div>
        <section class="w-full h-10 mt-3">
            {{ $payments->links() }}
        </section>
    @endhasrole

    @hasrole('admin')
        @include('components.modal-filter')
        @include('components.modal-export')
        <div id="modal-search"
            class="animation-fade hidden fixed z-50 w-full md:max-w-screen-lg max-md:w-screen justify-center max-md:px-3 max-md:-ml-3">
            <form action="{{ route('admin.student.index') }}" method="GET" enctype="multipart/form-data"
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
                <a href="{{ route('admin.monthly-payment.create') }}"
                    class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                    <span class="max-md:hidden">Tambah</span>
                </a>
                <button type="button" onclick="modalGetPayment(event)"
                    class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-violet-600 transition duration-300 hover:bg-violet-700 focus:bg-violet-700 text-white">
                    <span class="material-symbols-outlined">
                        filter_alt
                    </span>
                    <span class="max-md:hidden">Filter</span>
                </button>
                <button type="button" onclick="modalGetExport(event)"
                    class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-red-600 transition duration-300 hover:bg-red-700 focus:bg-red-700 text-white">
                    <span class="material-symbols-outlined">
                        download
                    </span>
                    <span class="max-md:hidden">PDF</span>
                </button>
            </section>
            <form action="{{ route('admin.monthly-payment.index') }}" method="GET" class="md:w-80">
                <input type="hidden" name="month" value="{{ request('month') }}">
                <input type="hidden" name="year" value="{{ request('year') }}">
                <input type="search" name="search"
                    class="w-full md:h-11 max-md:h-10 max-md:hidden rounded px-3 outline-none transition duration-300 border-2 border-white focus:border-green-500 ring-2 ring-white focus:ring-green-200"
                    placeholder="Cari berdasarkan nama santri">
            </form>
            <button type="button" onclick="showModalSearch(event)"
                class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-white transition duration-300 md:hidden hover:bg-gray-200 focus:bg-gray-200 text-hitam">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
        </div>
        @include('components.alert')
        <div class="relative overflow-x-auto bg-white shadow-lg">
            @if (count($payments) > 0)
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
                                Bulan Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tahun Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jumlah Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    @php
                        $i = ($payments->currentPage() - 1) * $payments->perPage() + 1;
                    @endphp
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr class="bg-white border-b text-hitam">
                                <th class="p-4">
                                    {{ $i++ }}.
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $payment->student->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $payment->moon->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $payment->year }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp. {{ number_format($payment->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $payment->status }}
                                </td>
                                <td class="px-6 py-2 flex items-center min-h-[1rem] space-x-2 text-white">
                                    <a href="{{ route('admin.monthly-payment.edit', $payment->id) }}"
                                        class="outline-none size-10 flex items-center justify-center rounded-md transition duration-300 {{ $payment->status === 'Lunas' ? 'bg-orange-400 hover:bg-orange-500 focus:bg-orange-500' : 'bg-orange-600 hover:bg-orange-700 focus:bg-orange-700' }}">
                                        <span class="material-symbols-outlined text-[21px]">
                                            border_color
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <caption class="caption-bottom my-3">
                                Belum terdapat pembayaran bulanan yang dilakukan.
                            </caption>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p class="text-center text-hitam max-md:text-sm max-md:leading-snug">Belum ada transaksi yang dilakukan pada bulan ini.</p>
            @endif
        </div>
        <section class="w-full h-10 mt-3">
            {{ $payments->links() }}
        </section>
    @endhasrole
@endsection
