<aside id="sidebar"
    class="fixed sm:z-10 max-md:z-30 w-full max-md:-translate-x-[105%] [&.active]:max-md:translate-x-0 max-md:max-w-[65%] transition-all duration-300 ease-in-out sm:max-w-[18%] m-3 rounded-lg shadow-lg bg-hitam overflow-x-hidden max-md:p-3 sm:p-5 text-white">
    <section class="w-full h-16 border-b border-abu-muda mb-5">
        <h1 class="font-poppins uppercase font-semibold text-xl max-md:text-lg -mb-px">
            {{ Auth::user()->roles->pluck('name')->first() }}
        </h1>
        <h1 class="font-poppins uppercase font-medium text-lg max-md:text-base">Darul Huda Kutacane</h1>
    </section>

    <button type="button" onclick="hideMenu()"
        class="md:hidden outline-none absolute top-2 right-0 -ml-10 bg-hitam size-10 rounded-full flex items-center justify-center">
        <span class="material-symbols-outlined">
            close
        </span>
    </button>

    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <ul class="flex flex-col w-full">
            <span class="font-semibold uppercase text-[11px]">Dashboard</span>
            <li class="mt-2 mb-5">
                <a href="{{ route('admin.dashboard') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.dashboard') ? 'bg-green-600 shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    <span>Dashboard</span>
                </a>
            </li>

            <span class="font-semibold uppercase text-[11px]">content</span>
            <li class="mt-2">
                <a href="{{ route('admin.student.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.student.*') ? 'bg-green-600 shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Description
                    </span>
                    <span>Data Santri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.teacher.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.teacher.*') ? 'bg-green-600 shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Description
                    </span>
                    <span>Data Guru</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.class-room.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.class-room.*') ? 'bg-green-600 shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        list
                    </span>
                    <span>Daftar Kelas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.lesson.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.lesson.*') ? 'bg-green-600 shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        local_library
                    </span>
                    <span>Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.monthly-payment.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.monthly-payment.*') ? 'bg-green-600 shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Edit_Note
                    </span>
                    <span>Pembayaran Bulanan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.teacher-picket.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.teacher-picket.*') ? 'bg-green-600 shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        List
                    </span>
                    <span>Guru Piket</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.student-guardian.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.student-guardian.*') ? 'bg-green-600 shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Group
                    </span>
                    <span>Akun Wali Santri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.archive.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.archive.*') ? 'bg-green-600 shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Bookmark
                    </span>
                    <span>Arsip Data</span>
                </a>
            </li>
        </ul>
    @endhasrole

    @hasrole('operator')
    @endhasrole
</aside>
