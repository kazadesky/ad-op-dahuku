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
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
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
                    <h1 class="md:text-5xl max-md:text-4xl font-bold text-slate-800">{{ $archive }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined md:text-4xl max-md:text-3xl">
                            description
                        </span>
                    </p>
                </section>
            </div>
        </div>
    @endhasrole

    @hasrole('operator')
    @endhasrole

    @hasrole('teacher')
        @if (count($schedules) > 0)
            <div class="w-full grid md:grid-cols-3 max-md:grid-cols-1 md:gap-5 max-md:gap-y-3 text-hitam">
                @foreach ($schedules as $day => $items)
                    <section
                        class="col-span-1 p-5 rounded-lg shadow-lg {{ strtolower($day) === strtolower($action) ? 'bg-gradient-to-tr from-[#098666] to-[#1e1f1e] text-white' : 'bg-white' }}">
                        <h1 class="md:text-xl max-md:text-lg md:font-bold max-md:font-semibold">{{ $day }} :</h1>
                        @foreach ($items as $item)
                            <div class="w-full flex items-start space-x-1 my-3">
                                <p>{{ $loop->iteration }}.</p>
                                <div class="flex flex-col space-y-1">
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
            <div class="w-full flex justify-center md:max-screen-lg max-md:text-sm">
                <div class="bg-white rounded-md shadow-md px-10 py-2">
                    <p class="text-center">Anda belum mempunyai jadwal mengajar yang terdaftar.</p>
                </div>
            </div>
        @endif
    @endhasrole
@endsection
