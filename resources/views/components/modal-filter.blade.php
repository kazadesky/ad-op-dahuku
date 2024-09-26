<div id="modal-filter" class="animation-fade hidden fixed z-50 w-full max-w-screen-lg justify-center">
    <form action="{{ route('admin.monthly-payment.index') }}" method="GET"
        class="w-full max-w-md rounded-md shadow-md p-5 bg-white">
        <h1 class="mb-5 font-poppins text-xl capitalize font-bold flex items-center">
            <span class="material-symbols-outlined text-3xl -ml-2">
                filter_alt
            </span>
            <span>Filter Data Yang ditampilkan</span>
        </h1>

        <section class="w-full mb-4">
            <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                <label for="month" class="font-medium md:w-40">
                    <span>Bulan</span>
                    <span class="float-end max-md:hidden">:</span>
                </label>
                <select name="month" id="month" size="-1"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300">
                    <option value="" hidden>pilih bulan</option>
                    @foreach ($moons as $moon)
                        <option value="{{ $moon->id }}">{{ $moon->name }}</option>
                    @endforeach
                </select>
            </div>
        </section>

        <section class="w-full mb-4">
            <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                <label for="year" class="font-medium md:w-40">
                    <span>Tahun</span>
                    <span class="float-end max-md:hidden">:</span>
                </label>
                <select name="year" id="year" size="-1"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300">
                    <option value="" hidden>pilih tahun</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </section>

        <section class="flex flex-col space-y-3">
            <button type="submit"
            class="outline-none text-white w-full h-11 flex items-center justify-center font-medium bg-green-600 rounded shadow-sm transition duration-300 hover:bg-green-700 focus:bg-green-700 max-md:mb-3">Filter</button>
            <a href="" onclick="modalGetPayment(event)" class="text-center outline-none text-slate-800 underline underline-offset-2 transition duration-300 active:text-green-500">Close</a>
        </section>
    </form>
</div>
