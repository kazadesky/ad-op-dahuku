@php
    $user = Auth::user();
    $role = $user->roles->pluck('name')->first();
    $action = \App\Models\TeacherPicket::with('teacher', 'substitute', 'day')
        ->where('teacher_id', $user->id)
        ->orWhere('substitute_picket_teacher_id', $user->id)
        ->first();
@endphp

<aside id="sidebar"
    class="fixed sm:z-10 max-md:z-30 w-full max-md:-translate-x-[105%] [&.active]:max-md:translate-x-0 max-md:max-w-[67%] transition-all duration-300 ease-in-out sm:max-w-[18%] m-3 rounded-lg shadow-lg bg-hitam overflow-x-hidden p-5 text-white-text">
    <section class="w-full h-16 border-b border-abu-muda mb-5">
        <h1 class="font-poppins uppercase font-semibold text-xl max-md:text-lg -mb-px">
            @if ($role == 'super_admin')
                Super Admin
            @elseif($role == 'admin')
                Admin
            @elseif($role == 'operator')
                Operator
            @elseif($role == 'teacher')
                Guru
            @endif
        </h1>
        <h1 class="font-poppins uppercase font-medium text-lg max-md:text-base max-md:capitalize">Darul Huda Kutacane</h1>
    </section>

    <button type="button" onclick="hideMenu()"
        class="md:hidden outline-none absolute top-2 right-2 -ml-10 bg-hitam size-10 rounded-full flex items-center justify-center">
        <span class="material-symbols-outlined text-[22px]">
            close
        </span>
    </button>

    @hasrole('super_admin')
        <ul class="flex flex-col w-full max-md:text-sm">
            <span class="font-semibold uppercase text-[11px]">Dashboard</span>
            <li class="mt-2 mb-5">
                <a href="{{ route('sa.dashboard') }}"
                    class="
                outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                {{ request()->routeIs('sa.dashboard') ? 'bg-elf-green shadow-sm' : '' }}
                ">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    <span>Dashboard</span>
                </a>
            </li>

            <span class="font-semibold uppercase text-[11px]">content</span>
            <li class="mt-2">
                <a href="{{ route('sa.student.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs(['sa.student.*', 'sa.student-achievement.edit', 'sa.student-misconduct.edit']) ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Description
                    </span>
                    <span>Data Santri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sa.teacher.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('sa.teacher.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Description
                    </span>
                    <span>Daftar Guru</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sa.class-room.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('sa.class-room.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        list
                    </span>
                    <span>Daftar Kelas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sa.lesson.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('sa.lesson.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        local_library
                    </span>
                    <span>Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sa.time.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('sa.time.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        schedule
                    </span>
                    <span>Jam Masuk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sa.lesson-timetable.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('sa.lesson-timetable.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        date_range
                    </span>
                    <span>Jadwal Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sa.monthly-payment.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('sa.monthly-payment.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Edit_Note
                    </span>
                    <span>Pembayaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sa.teacher-picket.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('sa.teacher-picket.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        List
                    </span>
                    <span>Guru Piket</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sa.teacher-presence.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('sa.teacher-presence.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        co_present
                    </span>
                    <span>Absensi Guru</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sa.student-guardian.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('sa.student-guardian.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Group
                    </span>
                    <span>Akun Wali Santri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sa.archive.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('sa.archive.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Bookmark
                    </span>
                    <span>Arsip Data</span>
                </a>
            </li>
        </ul>
    @endhasrole

    @hasrole('admin')
        <ul class="flex flex-col w-full max-md:text-sm">
            <span class="font-semibold uppercase text-[11px]">Dashboard</span>
            <li class="mt-2 mb-5">
                <a href="{{ route('admin.dashboard') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.dashboard') ? 'bg-elf-green shadow-sm' : '' }}
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
                    {{ request()->routeIs(['admin.student.*', 'admin.student-achievement.edit', 'admin.student-misconduct.edit']) ? 'bg-elf-green shadow-sm' : '' }}
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
                    {{ request()->routeIs('admin.teacher.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Description
                    </span>
                    <span>Daftar Guru</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.class-room.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.class-room.*') ? 'bg-elf-green shadow-sm' : '' }}
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
                    {{ request()->routeIs('admin.lesson.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        local_library
                    </span>
                    <span>Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.time.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.time.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        schedule
                    </span>
                    <span>Jam Masuk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.lesson-timetable.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.lesson-timetable.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        date_range
                    </span>
                    <span>Jadwal Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.monthly-payment.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.monthly-payment.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Edit_Note
                    </span>
                    <span>Pembayaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.teacher-picket.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.teacher-picket.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        List
                    </span>
                    <span>Guru Piket</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.teacher-presence.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.teacher-presence.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        co_present
                    </span>
                    <span>Absensi Guru</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.student-guardian.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('admin.student-guardian.*') ? 'bg-elf-green shadow-sm' : '' }}
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
                    {{ request()->routeIs('admin.archive.*') ? 'bg-elf-green shadow-sm' : '' }}
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
        <ul class="flex flex-col w-full max-md:text-sm">
            <span class="font-semibold uppercase text-[11px]">Dashboard</span>
            <li class="mt-2 mb-5">
                <a href="{{ route('operator.dashboard') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('operator.dashboard') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    <span>Dashboard</span>
                </a>
            </li>

            <span class="font-semibold uppercase text-[11px]">content</span>
            <li class="mt-2">
                <a href="{{ route('operator.student.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('operator.student.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Description
                    </span>
                    <span>Data Santri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.teacher.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('operator.teacher.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Description
                    </span>
                    <span>Daftar Guru</span>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.class-room.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('operator.class-room.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        list
                    </span>
                    <span>Daftar Kelas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.lesson.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('operator.lesson.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        local_library
                    </span>
                    <span>Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.time.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('operator.time.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        schedule
                    </span>
                    <span>Jam Masuk</span>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.lesson-timetable.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('operator.lesson-timetable.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        date_range
                    </span>
                    <span>Jadwal Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.teacher-picket.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('operator.teacher-picket.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        List
                    </span>
                    <span>Guru Piket</span>
                </a>
            </li>
            <li>
                <a href="{{ route('operator.archive.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('operator.archive.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Bookmark
                    </span>
                    <span>Arsip Data</span>
                </a>
            </li>
        </ul>
    @endhasrole

    @hasrole('teacher')
        <ul class="flex flex-col w-full max-md:text-sm">
            <span class="font-semibold uppercase text-[11px]">Dashboard</span>
            <li class="mt-2 mb-5">
                <a href="{{ route('teacher.dashboard') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('teacher.dashboard') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    <span>Dashboard</span>
                </a>
            </li>

            <span class="font-semibold uppercase text-[11px]">content</span>
            @if ($action)
                <li class="mt-2">
                    <a href="{{ route('teacher.teacher-presence.index') }}"
                        class="
                        outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                        {{ request()->routeIs('teacher.teacher-presence.*') ? 'bg-elf-green shadow-sm' : '' }}
                        ">
                        <span class="material-symbols-outlined">
                            co_present
                        </span>
                        <span>Absensi Guru</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('teacher.student-achievement.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('teacher.student-achievement.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        note_alt
                    </span>
                    <span>Pencapaian Santri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('teacher.student-misconduct.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('teacher.student-misconduct.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        note_alt
                    </span>
                    <span>Pelanggaran Santri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('teacher.student-report.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('teacher.student-report.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Edit_Note
                    </span>
                    <span>Raport Santri</span>
                </a>
            </li>
            <li>
                <a href="{{ route('teacher.archive.index') }}"
                    class="
                    outline-none w-full h-10 flex items-center px-3 rounded space-x-1
                    {{ request()->routeIs('teacher.archive.*') ? 'bg-elf-green shadow-sm' : '' }}
                    ">
                    <span class="material-symbols-outlined">
                        Bookmark
                    </span>
                    <span>Arsip Data</span>
                </a>
            </li>
        </ul>
    @endhasrole
</aside>
