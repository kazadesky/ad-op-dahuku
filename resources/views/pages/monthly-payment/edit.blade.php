@extends('layouts.app')
@section('title', 'Edit Pembayaran Santri')

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
        <span>/ Page / Pembayaran Bulanan / Edit</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <form action="{{ route('admin.monthly-payment.update', $payment->id) }}" method="POST"
            class="w-full md:p-10 max-sm:p-6 rounded-lg bg-white text-hitam shadow-lg max-md:text-sm">
            @csrf
            @method('PATCH')
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="student_id" class="font-medium md:w-40">
                        <span>Nama Santri</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="student_id" id="student_id" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror">
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ $student->id === $payment->student_id ? 'selected' : '' }}>
                                {{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('student_id')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="moon_id" class="font-medium md:w-40">
                        <span>Bulan</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="moon_id" id="moon_id" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror">
                        @foreach ($moons as $moon)
                            <option value="{{ $moon->id }}" {{ $moon->id === $payment->moon_id ? 'selected' : '' }}>
                                {{ $moon->name }}
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
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="year" class="font-medium md:w-40">
                        <span>Tahun</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="year" id="year" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('year') border-red-500 @enderror">
                        @foreach ($years as $ye)
                            <option value="{{ $ye }}" {{ $ye === $payment->year ? 'selected' : '' }}>
                                {{ $ye }}
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
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="price" class="font-medium md:w-40">
                        <span>Jumlah Bayar</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <!-- Input yang akan ditampilkan ke user dengan format Rupiah -->
                    <input type="text" inputmode="numeric" id="formattedPrice"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('price') border-red-500 @enderror"
                        placeholder="Rp. 500.000" value="{{ old('price', number_format($payment->price, 0, ',', '.')) }}">

                    <!-- Hidden input untuk menyimpan nilai asli yang akan dikirim ke database -->
                    <input type="hidden" name="price" id="price" value="{{ old('price', $payment->price) }}">
                </div>
                @error('price')
                    <div class="w-full md:pl-40">
                        <small class="text-red-500">{{ $message }}</small>
                    </div>
                @enderror
            </section>
            <section class="w-full md:mb-4 max-md:mb-3">
                <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                    <label for="status" class="font-medium md:w-40">
                        <span>Status</span>
                        <span class="float-end max-md:hidden">:</span>
                    </label>
                    <select name="status" id="status" size="-1"
                        class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror">
                        <option hidden>status pembayaran</option>
                        @foreach ($status as $sts)
                            <option value="{{ $sts }}" {{ $sts === $payment->status ? 'selected' : '' }}>
                                {{ $sts }}
                            </option>
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
                    class="outline-none w-full max-md:space-x-1 md:h-11 flex items-center justify-center rounded shadow-sm md:bg-gray-700 font-medium transition duration-300 md:hover:bg-gray-800 md:focus:bg-gray-800 max-md:text-hitam max-md:underline max-md:underline-offset-2 max-md:active:text-elf-green">
                    <span>Kembali</span>
                </a>
                <button type="submit"
                    class="outline-none w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf max-md:mb-2">Update</button>
            </section>
        </form>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection

@push('script')
    <script>
        const formattedPriceInput = document.getElementById('formattedPrice');
        const rawPriceInput = document.getElementById('price');

        function formatRupiah(value) {
            let numberString = value.replace(/[^,\d]/g, '').toString(),
                split = numberString.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        }

        formattedPriceInput.addEventListener('focus', function() {
            formattedPriceInput.addEventListener('input', function(e) {
                let value = e.target.value;
                formattedPriceInput.value = formatRupiah(value);
                rawPriceInput.value = value.replace(/[^0-9]/g,
                '');
            });
        });
    </script>
@endpush
