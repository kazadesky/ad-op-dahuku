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
                <h2 class="text-xl uppercase font-bold mb-11">Jumlah Santri</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="text-5xl font-bold text-slate-800">{{ $student }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined text-4xl">
                            groups
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="text-xl uppercase font-bold mb-11">Jumlah Guru</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="text-5xl font-bold text-slate-800">{{ $teacher }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined text-4xl">
                            group
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="text-xl uppercase font-bold mb-11">Guru Piket</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="text-5xl font-bold text-slate-800">{{ $picket }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined text-4xl">
                            person
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="text-xl uppercase font-bold mb-11">Jumlah Kelas</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="text-5xl font-bold text-slate-800">{{ $room }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined text-4xl">
                            list_alt
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="text-xl uppercase font-bold mb-11">Akun Wali Santri</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="text-5xl font-bold text-slate-800">{{ $guardian }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined text-4xl">
                            supervisor_account
                        </span>
                    </p>
                </section>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-40">
                <h2 class="text-xl uppercase font-bold mb-11">Arsip Data</h2>
                <section class="flex items-end justify-end space-x-2">
                    <h1 class="text-5xl font-bold text-slate-800">{{ $archive }}</h1>
                    <p class="text-gray-600">
                        <span class="material-symbols-outlined text-4xl">
                            description
                        </span>
                    </p>
                </section>
            </div>
        </div>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection
