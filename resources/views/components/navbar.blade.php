<nav class="w-full md:min-h-16 text-white-text mt-5 mb-7">
    <section class="flex items-center justify-between w-full -mb-1">
        <div class="flex items-center max-md:space-x-2">
            <button type="button" onclick="showMenu(event)" class="outline-none sm:hidden">
                <span class="material-symbols-outlined text-3xl">
                    menu
                </span>
            </button>
            <h1 class="font-bold uppercase sm:text-2xl max-md:text-xl">{{ $title }}</h1>
        </div>
        <ul>
            <li class="mb-2">
                <button type="button" onclick="toggleDropdown(event)" class="flex items-center space-x-3 outline-none">
                    <h1 class="uppercase font-bold text-sm max-md:hidden">{{ Auth::user()->name }}</h1>
                    <span class="material-symbols-outlined sm:hidden">
                        keyboard_arrow_down
                    </span>
                    <img src="{{ !Auth::user()->profile ? asset('img/icon/user.png') : url('storage/profile/', Auth::user()->profile) }}"
                        alt="user-icon" class="size-10 rounded-full">
                </button>
            </li>
            <ul id="dropdown-nav"
                class="animation-fade hidden absolute w-56 flex-col space-y-1 p-2 rounded-md shadow border border-black bg-hitam sm:right-5 max-md:right-3 z-30">
                <section class="text-center text-sm">
                    <p class="text-base">{{ Auth::user()->name }}</p>
                    <p>{{ Auth::user()->email }}</p>
                    <p class="capitalize">{{ Auth::user()->roles->pluck('name')->first() }}</p>
                </section>
                <li class="border-y py-1">
                    <a href=""
                        class="outline-none w-full flex items-center px-3 h-10 rounded space-x-1 transition duration-300 hover:bg-green-500/40">
                        <span class="material-symbols-outlined text-[22px]">
                            Person
                        </span>
                        <span>Profil</span>
                    </a>
                </li>
                <li class="border-b pb-1">
                    <a href=""
                        class="outline-none w-full flex items-center px-3 h-10 rounded space-x-1 transition duration-300 hover:bg-green-500/40">
                        <span class="material-symbols-outlined text-[22px]">
                            settings
                        </span>
                        <span>Ubah Sandi</span>
                    </a>
                </li>
                <li class="pt-1">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="outline-none w-full h-10 rounded text-white-text bg-flush-mahogany flex items-center justify-center space-x-1 transition duration-300 hover:bg-dark-flush focus:bg-dark-flush">
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </ul>
    </section>
    <section class="flex-none block max-md:my-1 max-md:text-sm">
        @yield('subtitle')
    </section>
</nav>
