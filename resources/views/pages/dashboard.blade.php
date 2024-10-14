@extends('layouts.app')
@section('title', 'Dashboard')

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
        @hasrole('teacher')
            <span>Teacher</span>
        @endhasrole
        <span>/ Page / Dashboard</span>
    </p>
@endsection

@section('content')
    @hasanyrole(['super_admin', 'admin'])
        <div class="w-full grid md:grid-cols-3 max-md:grid-cols-1 md:gap-5 max-md:space-y-4 font-poppins text-slate-700">
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Santri</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $student }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            groups
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Guru</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $teacher }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            group
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Guru Piket</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $picket }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            person
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Kelas</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $room }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            list_alt
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Mata Pelajaran</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $lesson }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            list_alt
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Jam Masuk</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $time }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            schedule
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Roster</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $timetable }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            list_alt
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Akun Wali Santri</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $guardian }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            supervisor_account
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Arsip Data</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">
                        {{ request()->routeIs('sa.dashboard') ? $sa_archive : $archive }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            description
                        </span>
                    </p>
                </section>
            </div>
        </div>
    @endhasanyrole

    @hasrole('operator')
        <div class="w-full grid md:grid-cols-3 max-md:grid-cols-1 md:gap-5 max-md:space-y-4 font-poppins text-slate-700">
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Santri</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $student }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            groups
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Guru Piket</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $picket }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            person
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Guru</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $teacher }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            group
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Kelas</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $room }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            list_alt
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Mata Pelajaran</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $lesson }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            list_alt
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Jam Masuk</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $time }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            schedule
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Roster</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $timetable }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            list_alt
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="md:text-xl max-md:text-lg uppercase font-bold mb-11">Arsip Data</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">
                        {{ $archive }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            description
                        </span>
                    </p>
                </section>
            </div>
        </div>
    @endhasrole

    @hasrole('teacher')
        <h1
            class="md:text-lg max-md:text-base font-poppins text-hitam md:font-bold max-md:font-semibold drop-shadow-lg mb-3 md:px-10 md:py-3 max-md:px-8 max-md:py-2 rounded-md shadow-md bg-white w-max uppercase border-2">
            Jadwal mengajar :
        </h1>
        @if (count($schedules) > 0)
            <div class="w-full grid md:grid-cols-3 max-md:grid-cols-1 md:gap-5 max-md:gap-y-3 text-hitam mb-10">
                @foreach ($schedules as $day => $items)
                    <section
                        class="col-span-1 p-5 rounded-lg border-2 shadow-lg {{ strtolower($day) === strtolower($action) ? 'bg-gradient-to-tr from-[#098666] to-[#1e1f1e] text-white' : 'bg-white' }}">
                        <h1 class="md:text-xl max-md:text-lg md:font-bold max-md:font-semibold">{{ $day }} :</h1>
                        @foreach ($items as $item)
                            <div class="w-full flex items-start space-x-2 my-3">
                                <p>{{ $loop->iteration }}.</p>
                                <div class="flex flex-col space-y-2">
                                    <p class="flex flex-none">
                                        <span class="w-24">Mapel</span>
                                        <span class="w-5">:</span>
                                        <span>{{ $item->lesson->name }}</span>
                                    </p>
                                    <p class="flex flex-none">
                                        <span class="w-24">Kelas</span>
                                        <span class="w-5">:</span>
                                        <span>{{ $item->classRoom->name }}</span>
                                    </p>
                                    <p class="flex flex-none">
                                        <span class="w-24">Jam Masuk</span>
                                        <span class="w-5">:</span>
                                        <span>{{ \Carbon\Carbon::parse($item->time->start)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($item->time->finish)->format('H:i') }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </section>
                @endforeach
            </div>
        @else
            <div class="w-full flex justify-center md:max-screen-lg max-md:text-sm mb-10">
                <div class="bg-white rounded-md shadow-md px-10 py-2">
                    <p class="text-center">Anda belum mempunyai jadwal mengajar yang terdaftar.</p>
                </div>
            </div>
        @endif

        @if (count($pickets) > 0)
            <h1
                class="md:text-lg max-md:text-base font-poppins text-hitam md:font-bold max-md:font-semibold drop-shadow-lg mb-3 md:px-10 md:py-3 max-md:px-8 max-md:py-2 rounded-md shadow-md bg-white w-max uppercase border-2">
                Jadwal Piket :
            </h1>
            <div class="w-full grid md:grid-cols-2 max-md:grid-cols-1 md:gap-5 max-md:gap-y-3 text-hitam">
                @foreach ($pickets as $day => $items)
                    <section
                        class="col-span-1 p-5 border-2 rounded-lg shadow-lg {{ strtolower($day) === strtolower($action) ? 'bg-gradient-to-tr from-[#098666] to-[#1e1f1e] text-white' : 'bg-white' }}">
                        <h1 class="md:text-xl max-md:text-lg md:font-bold max-md:font-semibold">{{ $day }} :</h1>
                        @foreach ($items as $item)
                            <div class="w-full flex flex-col space-y-2 mt-3">
                                <p class="flex flex-none">
                                    <span class="w-24">Piket</span>
                                    <span class="w-5">:</span>
                                    <span>{{ $item->teacher->name }}</span>
                                </p>
                                <p class="flex flex-none">
                                    <span class="w-24">Pengganti</span>
                                    <span class="w-5">:</span>
                                    <span>{{ $item->substitute_picket_teacher_id ? $item->substitute->name : '-' }}</span>
                                </p>
                            </div>
                        @endforeach
                    </section>
                @endforeach
            </div>
        @endif
    @endhasrole
@endsection
