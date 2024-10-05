<nav class="w-full md:min-h-16 text-white-text mt-5 mb-7">
    <section class="flex items-center justify-between w-full -mb-1">
        <div class="flex items-center max-md:space-x-1">
            <button type="button" onclick="showMenu(event)" class="outline-none sm:hidden pt-1">
                <span class="material-symbols-outlined max-md:text-2xl">
                    menu
                </span>
            </button>
            <h1 class="font-bold uppercase sm:text-2xl max-md:text-lg">{{ $title }}</h1>
        </div>
        <ul>
            <li class="mb-2">
                <button type="button" onclick="toggleDropdown(event)" class="flex items-center md:space-x-3 max-md:space-x-2 outline-none">
                    <h1 class="uppercase font-bold text-sm max-md:hidden">{{ Auth::user()->name }}</h1>
                    <span class="material-symbols-outlined sm:hidden">
                        keyboard_arrow_down
                    </span>
                    <figure class="size-10 rounded-full overflow-hidden shadow-sm">
                        <img src="{{ !Auth::user()->profile ? asset('img/icon/user.png') : url('storage/profile/', Auth::user()->profile) }}"
                        alt="user-icon" class="w-full">
                    </figure>
                </button>
            </li>
            <ul id="dropdown-nav"
                class="animation-fade hidden absolute md:w-56 max-md:w-52 flex-col space-y-1 p-2 rounded-md shadow border border-black bg-hitam sm:right-5 max-md:right-3 z-30 max-md:text-sm">
                <section class="text-center text-sm">
                    <p class="text-base">{{ Auth::user()->name }}</p>
                    <p>{{ Auth::user()->email }}</p>
                    <p class="capitalize">{{ Auth::user()->roles->pluck('name')->first() }}</p>
                </section>
                <li class="border-y py-1">
                    <a @hasrole('super_admin')
                    href="{{ route('sa.profile', Auth::user()->id) }}"
                    @endhasrole
                        @hasrole('admin')
                    href="{{ route('admin.profile', Auth::user()->id) }}"
                    @endhasrole
                        @hasrole('operator')
                    href="{{ route('operator.profile', Auth::user()->id) }}"
                    @endhasrole
                        @hasrole('teacher')
                    href="{{ route('teacher.profile', Auth::user()->id) }}"
                    @endhasrole
                        class="outline-none w-full flex items-center px-3 h-10 rounded space-x-1 transition duration-300 {{ request()->routeIs(['sa.profile', 'admin.profile', 'operator.profile', 'teacher.profile']) ? 'bg-elf-green hover:bg-dark-elf focus:bg-dark-elf' : 'hover:bg-green-500/40' }}">
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
