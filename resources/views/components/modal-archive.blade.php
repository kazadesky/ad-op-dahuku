<div id="modal-archive"
    class="animation-fade hidden fixed z-50 w-full md:max-w-screen-lg max-md:w-screen justify-center max-md:px-3 max-md:-ml-3">
    <form action="{{ route('archive.store') }}" method="POST" enctype="multipart/form-data"
        class="w-full md:max-w-md max-md:w-full rounded-md shadow-md p-5 bg-white max-sm:text-sm">
        @csrf
        <h1 class="mb-5 font-poppins md:text-xl max-md:text-lg capitalize font-bold flex items-center">
            <span class="material-symbols-outlined text-3xl -ml-2">
                bookmark_added
            </span>
            <span>Arsipkan Data</span>
        </h1>

        <section class="w-full md:mb-4 max-md:mb-3">
            <label for="name" class="block md:mb-2 max-md:mb-1 font-medium">Nama Lengkap</label>
            <input type="text" name="name" id="name"
                class="outline-none w-full rounded-md md:h-12 max-md:h-11 px-3 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 @error('name') border-red-500 @enderror"
                placeholder="Name Lengkap" value="{{ old('name') }}">
            @error('name')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </section>

        <section class="w-full md:mb-4 max-md:mb-3">
            <label for="file" class="block md:mb-2 max-md:mb-1 font-medium">Foto Profil</label>
            <input type="file" name="file" id="file" accept=".pdf"
                class="outline-none w-full rounded-md md:h-12 max-md:h-11 border-2 transition duration-300 focus:border-green-500 focus:shadow-sm focus:ring-2 focus:ring-green-300 file:outline-none file:h-full file:border-none file:cursor-pointer file:hover:bg-gray-200 file:transition file:duration-300 file:active:bg-gray-200 file:rounded-l-md @error('file') border-red-500 @enderror">
            @error('file')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </section>

        <section class="flex flex-col md:space-y-3 max-md:space-y-2">
            <button type="submit"
                class="outline-none text-white-text w-full md:h-11 max-md:h-10 flex items-center justify-center font-medium bg-elf-green rounded shadow-sm transition duration-300 hover:bg-dark-elf focus:bg-dark-elf">Simpan</button>
            <a href="" onclick="showModalArchive(event)"
                class="text-center outline-none text-slate-800 underline underline-offset-2 transition duration-300 active:text-elf-green">Close</a>
        </section>
    </form>
</div>
