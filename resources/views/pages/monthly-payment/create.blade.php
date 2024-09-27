@extends('layouts.app')
@section('title', 'Tambah Pembayaran Santri')

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
        <span>/ Page / Pembayaran Bulanan / Tambah</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <form action="{{ route('admin.monthly-payment.store') }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg">
            @csrf
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="student_id" class="font-medium md:w-40">
                        <span>Nama Santri</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="student_id" id="student_id" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror">
                        <option hidden>pilih nama santri</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('student_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="moon_id" class="font-medium md:w-40">
                        <span>Bulan</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="moon_id" id="moon_id" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror">
                        {{-- <option hidden>pilih bulan</option> --}}
                        @foreach ($moons as $moon)
                            <option value="{{ $moon->id }}" {{ $moon->id === $month ? 'selected' : '' }}>{{ $moon->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('moon_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="year" class="font-medium md:w-40">
                        <span>Tahun</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="year" id="year" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('year') border-red-500 @enderror">
                        @foreach ($years as $ye)
                            <option value="{{ $ye }}" {{ $ye === $year ? 'selected' : '' }}>{{ $ye }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('year')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="price" class="font-medium md:w-40">
                        <span>Jumlah Bayar</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <!-- Input yang akan ditampilkan ke user dengan format Rupiah -->
                    <input type="text" inputmode="numeric" id="formattedPrice"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('price') border-red-500 @enderror"
                        placeholder="Rp. 500.000" value="{{ old('price') }}">

                    <!-- Hidden input untuk menyimpan nilai asli yang akan dikirim ke database -->
                    <input type="hidden" name="price" id="price" value="{{ old('price') }}">
                </div>
                @error('price')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full mb-4">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="status" class="font-medium md:w-40">
                        <span>Status</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="status" id="status" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror">
                        <option hidden>status pembayaran</option>
                        @foreach ($status as $sts)
                            <option value="{{ $sts }}">{{ $sts }}</option>
                        @endforeach
                    </select>
                </div>
                @error('status')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full flex max-md:flex-col-reverse items-center md:space-x-3 md:justify-between text-white">
                <a href="{{ route('admin.monthly-payment.index') }}"
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-600 font-medium transition duration-300 md:hover:bg-gray-700 md:focus:bg-gray-700 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-green-500">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full h-11 flex items-center justify-center font-medium bg-green-600 rounded shadow-sm transition duration-300 hover:bg-green-700 focus:bg-green-700 max-md:mb-3">Tambah</button>
            </section>
        </form>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection
