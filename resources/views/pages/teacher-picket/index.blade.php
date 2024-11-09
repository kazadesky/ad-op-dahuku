@extends('layouts.app')
@section('title', 'Daftar Guru Piket')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white-text">
        @hasrole('super_admin')
            <span>Super Admin</span>
        @endhasrole
        @hasrole('admin')
            <span>Admin</span>
        @endhasrole
        @hasrole('operator')
            <span>Operator</span>
        @endhasrole
        <span>/ Page / Guru Piket</span>
    </p>
@endsection

@section('content')

    @hasrole('super_admin')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <a href="{{ route('sa.teacher-picket.create') }}"
                class="outline-none flex items-center justify-center md:w-32 max-md:w-28 md:h-10 max-md:h-9 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
                <span class="material-symbols-outlined max-md:text-[21px]">
                    add
                </span>
                <span>Tambah</span>
            </a>
        </div>
        @include('components.alert')
        @if (count($pickets) > 0)
            <div class="w-full grid md:grid-cols-2 max-md:grid-cols-1 md:gap-5 max-md:gap-y-3 text-hitam max-md:text-sm">
                @foreach ($pickets as $day => $items)
                    <section
                        class="col-span-1 rounded-md shadow-lg border p-5 max-md:h-max {{ strtolower($day) === strtolower($action) ? 'bg-gradient-to-tr from-elf-green to-black text-white-text' : 'bg-white' }}">
                        <h2 class="text-base font-semibold font-poppins uppercase mb-3">{{ $day }} :</h2>
                        <ul class="flex flex-col space-y-3">
                            @forelse ($items as $item)
                                <li class="flex items-start justify-between w-full">
                                    <section class="flex items-start space-x-2 font-medium">
                                        <p>{{ $loop->iteration }} .</p>
                                        <ul class="flex flex-col space-y-2 list-disc">
                                            <span>Piket :</span>
                                            <li class="ml-3">
                                                <p class="font-medium">{{ $item->teacher->name }}</p>
                                            </li>
                                            <span>Pengganti :</span>
                                            <li class="ml-3">
                                                <p class="font-medium">{{ $item->substitute ? $item->substitute->name : '-' }}
                                                </p>
                                            </li>
                                        </ul>
                                    </section>
                                    <section class="flex items-center md:space-x-2 max-md:space-x-1 text-white-text">
                                        <a href="{{ route('admin.teacher-picket.edit', $item->id) }}"
                                            class="outline-none md:size-9 max-md:size-8 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                            <span
                                                class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">border_color</span>
                                        </a>
                                        <form action="{{ route('admin.teacher-picket.destroy', $item->id) }}"
                                            onsubmit="return confirm('Apakah anda ingin menghapus guru piket ini?')"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="outline-none md:size-9 max-md:size-8 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                                <span
                                                    class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </section>
                                </li>
                            @empty
                                <li>Belum ada guru piket pada hari ini.</li>
                            @endforelse
                        </ul>
                        <div class="w-full flex justify-end items-center py-3">
                            <p
                                class="{{ strtolower($day) === strtolower($action) ? 'text-white' : 'text-indigo-600' }} italic font-medium">
                                {{ $items->first()->action === 1 ? 'Active' : 'Inactive' }}
                            </p>
                        </div>
                    </section>
                @endforeach
            </div>
        @else
            <section class="bg-white text-hitam p-3 rounded-md shadow-md max-md:text-sm">
                <p class="text-center">Belum ada guru piket yang terdaftar.</p>
            </section>
        @endif
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <a href="{{ route('admin.teacher-picket.create') }}"
                class="outline-none flex items-center justify-center md:w-32 max-md:w-28 md:h-10 max-md:h-9 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
                <span class="material-symbols-outlined max-md:text-[21px]">
                    add
                </span>
                <span>Tambah</span>
            </a>
        </div>
        @include('components.alert')
        @if (count($pickets) > 0)
            <div class="w-full grid md:grid-cols-2 max-md:grid-cols-1 md:gap-5 max-md:gap-y-3 text-hitam max-md:text-sm">
                @foreach ($pickets as $day => $items)
                    <section
                        class="col-span-1 rounded-md shadow-lg border p-5 max-md:h-max {{ strtolower($day) === strtolower($action) ? 'bg-gradient-to-tr from-elf-green to-black text-white-text' : 'bg-white' }}">
                        <h2 class="text-base font-semibold font-poppins uppercase mb-3">{{ $day }} :</h2>
                        <ul class="flex flex-col space-y-3">
                            @forelse ($items as $item)
                                <li class="flex items-start justify-between w-full">
                                    <section class="flex items-start space-x-2 font-medium">
                                        <p>{{ $loop->iteration }} .</p>
                                        <ul class="flex flex-col space-y-2 list-disc">
                                            <span>Piket :</span>
                                            <li class="ml-3">
                                                <p class="font-medium">{{ $item->teacher->name }}</p>
                                            </li>
                                            <span>Pengganti :</span>
                                            <li class="ml-3">
                                                <p class="font-medium">{{ $item->substitute ? $item->substitute->name : '-' }}
                                                </p>
                                            </li>
                                        </ul>
                                    </section>
                                    <section class="flex items-center md:space-x-2 max-md:space-x-1 text-white-text">
                                        <a href="{{ route('admin.teacher-picket.edit', $item->id) }}"
                                            class="outline-none md:size-9 max-md:size-8 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                            <span
                                                class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">border_color</span>
                                        </a>
                                        <form action="{{ route('admin.teacher-picket.destroy', $item->id) }}"
                                            onsubmit="return confirm('Apakah anda ingin menghapus guru piket ini?')"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="outline-none md:size-9 max-md:size-8 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                                <span
                                                    class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </section>
                                </li>
                            @empty
                                <li>Belum ada guru piket pada hari ini.</li>
                            @endforelse
                        </ul>
                        <div class="w-full flex justify-end items-center py-3">
                            <p
                                class="{{ strtolower($day) === strtolower($action) ? 'text-white' : 'text-indigo-600' }} italic font-medium">
                                {{ $items->first()->action === 1 ? 'Active' : 'Inactive' }}
                            </p>
                        </div>
                    </section>
                @endforeach
            </div>
        @else
            <section class="bg-white text-hitam p-3 rounded-md shadow-md max-md:text-sm">
                <p class="text-center">Belum ada guru piket yang terdaftar.</p>
            </section>
        @endif
    @endhasrole

    @hasrole('operator')
        @include('components.alert')
        @if (count($pickets) > 0)
            <div class="w-full grid md:grid-cols-2 max-md:grid-cols-1 md:gap-5 max-md:gap-y-3 text-hitam max-md:text-sm">
                @foreach ($pickets as $day => $items)
                    <section
                        class="col-span-1 rounded-md shadow-lg border p-5 max-md:h-max {{ strtolower($day) === strtolower($action) ? 'bg-gradient-to-tr from-elf-green to-black text-white-text' : 'bg-white' }}">
                        <h2 class="text-base font-semibold font-poppins uppercase mb-3">{{ $day }} :</h2>
                        <ul class="flex flex-col space-y-3">
                            @forelse ($items as $item)
                                <li class="flex items-start justify-between w-full">
                                    <section class="flex items-start space-x-2 font-medium">
                                        <p>{{ $loop->iteration }} .</p>
                                        <ul class="flex flex-col space-y-2 list-disc">
                                            <span>Piket :</span>
                                            <li class="ml-3">
                                                <p class="font-medium">{{ $item->teacher->name }}</p>
                                            </li>
                                            <span>Pengganti :</span>
                                            <li class="ml-3">
                                                <p class="font-medium">{{ $item->substitute ? $item->substitute->name : '-' }}
                                                </p>
                                            </li>
                                        </ul>
                                    </section>
                                    <section class="flex items-center md:space-x-2 max-md:space-x-1 text-white-text">
                                        <a href="{{ route('admin.teacher-picket.edit', $item->id) }}"
                                            class="outline-none md:size-9 max-md:size-8 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                            <span
                                                class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">border_color</span>
                                        </a>
                                        <form action="{{ route('admin.teacher-picket.destroy', $item->id) }}"
                                            onsubmit="return confirm('Apakah anda ingin menghapus guru piket ini?')"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="outline-none md:size-9 max-md:size-8 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                                <span
                                                    class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </section>
                                </li>
                            @empty
                                <li>Belum ada guru piket pada hari ini.</li>
                            @endforelse
                        </ul>
                        <div class="w-full flex justify-end items-center py-3">
                            <p
                                class="{{ strtolower($day) === strtolower($action) ? 'text-white' : 'text-indigo-600' }} italic font-medium">
                                {{ $items->first()->action === 1 ? 'Active' : 'Inactive' }}
                            </p>
                        </div>
                    </section>
                @endforeach
            </div>
        @else
            <section class="bg-white text-hitam p-3 rounded-md shadow-md max-md:text-sm">
                <p class="text-center">Belum ada guru piket yang terdaftar.</p>
            </section>
        @endif
    @endhasrole
@endsection
