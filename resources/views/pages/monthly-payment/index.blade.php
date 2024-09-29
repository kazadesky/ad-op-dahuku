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
    @endhasrole

    @hasrole('admin')
        @include('components.modal-filter')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <section class="flex items-center md:space-x-3 max-md:space-x-2">
                <a href="{{ route('admin.monthly-payment.create') }}"
                    class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-blue-500 transition duration-300 hover:bg-blue-600 focus:bg-blue-600 text-white">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                    <span class="max-md:hidden">Tambah</span>
                </a>
                <button type="button" onclick="modalGetPayment(event)"
                    class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-violet-500 transition duration-300 hover:bg-violet-600 focus:bg-violet-600 text-white">
                    <span class="material-symbols-outlined">
                        filter_alt
                    </span>
                    <span class="max-md:hidden">Filter</span>
                </button>
                <button type="button" onclick=""
                    class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-red-500 transition duration-300 hover:bg-red-600 focus:bg-red-600 text-white">
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
            <button type="button" onclick=""
                class="outline-none flex items-center justify-center md:w-32 md:h-10 max-md:size-10 md:rounded-md max-md:rounded-lg shadow bg-white transition duration-300 md:hidden hover:bg-gray-200 focus:bg-gray-200 text-hitam">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
        </div>
        @if (session('success'))
            <div id="banner-alert" class="w-full h-12 px-3 flex items-center bg-sky-600 rounded-md shadow mb-3 text-white max-md:text-sm">
                <p>
                    <strong class="max-md:hidden">Success : </strong>
                    <span>{{ session('success') }}</span>
                </p>
            </div>
        @endif
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
                                        class="outline-none size-10 flex items-center justify-center rounded-md transition duration-300 {{ $payment->status === 'Lunas' ? 'bg-orange-300 hover:bg-orange-400 focus:bg-orange-400' : 'bg-orange-500 hover:bg-orange-600 focus:bg-orange-600' }}">
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
                <p class="text-center text-hitam">Belum ada transaksi yang dilakukan pada bulan ini.</p>
            @endif
        </div>
        <section class="w-full h-10 mt-3">
            {{ $payments->links() }}
        </section>
    @endhasrole
@endsection
