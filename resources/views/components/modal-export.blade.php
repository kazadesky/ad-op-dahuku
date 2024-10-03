<div id="modal-export"
    class="animation-fade hidden fixed z-50 w-full md:max-w-screen-lg max-md:w-screen justify-center max-md:px-3 max-md:-ml-3">
    <form
        action="{{ request()->routeIs(['sa.teacher-presence.index', 'admin.teacher-presence.index']) ? route('teacher-presence.export') : route('monthly-payment.export') }}"
        method="GET" class="w-full md:max-w-md max-md:w-full rounded-md shadow-md p-5 bg-white max-sm:text-sm">
        <h1 class="mb-5 font-poppins md:text-xl max-md:text-lg capitalize font-bold flex items-center">
            <span class="material-symbols-outlined text-3xl -ml-2">
                filter_alt
            </span>
            <span>Filter Data Yang Diexport</span>
        </h1>

        <section class="w-full md:mb-4 max-md:mb-3">
            <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                <label for="month" class="font-medium md:w-40">
                    <span>Bulan</span>
                    <span class="float-end max-md:hidden">:</span>
                </label>
                <select name="month" id="month" size="-1"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300">
                    <option value="">Pilih Bulan</option>
                    @foreach ($moons as $moon)
                        <option value="{{ $moon->id }}"
                            {{ request()->input('month') == $moon->id ? 'selected' : '' }}>
                            {{ $moon->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </section>

        <section class="w-full md:mb-4 max-md:mb-3">
            <div class="flex max-md:flex-col max-md:space-y-1 md:space-x-4 md:items-center">
                <label for="year" class="font-medium md:w-40">
                    <span>Tahun</span>
                    <span class="float-end max-md:hidden">:</span>
                </label>
                <select name="year" id="year" size="-1"
                    class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300">
                    <option value="">Pilih Tahun</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" {{ request()->input('year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>
        </section>

        <section class="flex flex-col md:space-y-3 max-md:space-y-2">
            <button type="submit"
                class="outline-none text-white-text w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf">Export</button>
            <a href="" onclick="modalGetExport(event)"
                class="text-center outline-none text-slate-800 underline underline-offset-2 transition duration-300 active:text-elf-green">Close</a>
        </section>
    </form>
</div>
