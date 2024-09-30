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
    @endhasrole

    @hasrole('admin')
        <div class="w-full flex items-center justify-between mb-3 max-md:text-sm">
            <a href="{{ route('admin.teacher-picket.create') }}"
                class="outline-none flex items-center justify-center md:w-32 max-md:w-28 h-10 rounded-md shadow bg-blue-600 transition duration-300 hover:bg-blue-700 focus:bg-blue-700 text-white-text">
                <span class="material-symbols-outlined">
                    add
                </span>
                <span>Tambah</span>
            </a>
        </div>
        @include('components.alert')
        @if (count($pickets) > 0)
            <div class="w-full grid md:grid-cols-2 max-md:grid-cols-1 md:gap-5 max-md:gap-y-3 text-hitam max-md:text-sm">
                <section class="col-span-1 bg-white rounded-md shadow-lg border p-5">
                    <h2 class="text-base font-semibold font-poppins uppercase mb-3">Senin :</h2>
                    <ul class="flex flex-col space-y-2 text-slate-800">
                        @forelse ($senin as $item)
                            <li class="flex items-center justify-between w-full">
                                <section class="flex items-center space-x-2 font-medium">
                                    <span>{{ $loop->iteration }} .</span>
                                    <span>{{ $item->teacher->name }}</span>
                                </section>
                                <section class="flex items-center space-x-2 text-white-text">
                                    {{-- <a href="{{ route('admin.teacher-picket.show', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a> --}}
                                    <a href="{{ route('admin.teacher-picket.edit', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.teacher-picket.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="outline-none size-9 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                delete
                                            </span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.teacher-picket.action', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="{{ $item->action === 0 ? 1 : 0 }}">
                                        <button type="submit"
                                            class="outline-none text-white-text size-9 rounded flex items-center justify-center bg-indigo-600 transition duration-300 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                {{ $item->action === 0 ? 'radio_button_unchecked' : 'radio_button_checked' }}
                                            </span>
                                        </button>
                                    </form>
                                </section>
                            </li>
                        @empty
                            <li>Belum ada guru piket pada hari ini.</li>
                        @endforelse
                    </ul>
                </section>
                <section class="col-span-1 bg-white rounded-md shadow-lg border p-5">
                    <h2 class="text-base font-semibold font-poppins uppercase mb-3">Selasa :</h2>
                    <ul class="flex flex-col space-y-2 text-slate-800">
                        @forelse ($selasa as $item)
                            <li class="flex items-center justify-between w-full">
                                <section class="flex items-center space-x-2 font-medium">
                                    <span>{{ $loop->iteration }} .</span>
                                    <span>{{ $item->teacher->name }}</span>
                                </section>
                                <section class="flex items-center space-x-2 text-white-text">
                                    {{-- <a href="{{ route('admin.teacher-picket.show', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a> --}}
                                    <a href="{{ route('admin.teacher-picket.edit', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.teacher-picket.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="outline-none size-9 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                delete
                                            </span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.teacher-picket.action', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="{{ $item->action === 0 ? 1 : 0 }}">
                                        <button type="submit"
                                            class="outline-none text-white-text size-9 rounded flex items-center justify-center bg-indigo-600 transition duration-300 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                {{ $item->action === 0 ? 'radio_button_unchecked' : 'radio_button_checked' }}
                                            </span>
                                        </button>
                                    </form>
                                </section>
                            </li>
                        @empty
                            <li>Belum ada guru piket pada hari ini.</li>
                        @endforelse
                    </ul>
                </section>
                <section class="col-span-1 bg-white rounded-md shadow-lg border p-5">
                    <h2 class="text-base font-semibold font-poppins uppercase mb-3">Rabu :</h2>
                    <ul class="flex flex-col space-y-2 text-slate-800">
                        @forelse ($rabu as $item)
                            <li class="flex items-center justify-between w-full">
                                <section class="flex items-center space-x-2 font-medium">
                                    <span>{{ $loop->iteration }} .</span>
                                    <span>{{ $item->teacher->name }}</span>
                                </section>
                                <section class="flex items-center space-x-2 text-white-text">
                                    {{-- <a href="{{ route('admin.teacher-picket.show', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a> --}}
                                    <a href="{{ route('admin.teacher-picket.edit', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.teacher-picket.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="outline-none size-9 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                delete
                                            </span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.teacher-picket.action', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="{{ $item->action === 0 ? 1 : 0 }}">
                                        <button type="submit"
                                            class="outline-none text-white-text size-9 rounded flex items-center justify-center bg-indigo-600 transition duration-300 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                {{ $item->action === 0 ? 'radio_button_unchecked' : 'radio_button_checked' }}
                                            </span>
                                        </button>
                                    </form>
                                </section>
                            </li>
                        @empty
                            <li>Belum ada guru piket pada hari ini.</li>
                        @endforelse
                    </ul>
                </section>
                <section class="col-span-1 bg-white rounded-md shadow-lg border p-5">
                    <h2 class="text-base font-semibold font-poppins uppercase mb-3">Kamis :</h2>
                    <ul class="flex flex-col space-y-2 text-slate-800">
                        @forelse ($kamis as $item)
                            <li class="flex items-center justify-between w-full">
                                <section class="flex items-center space-x-2 font-medium">
                                    <span>{{ $loop->iteration }} .</span>
                                    <span>{{ $item->teacher->name }}</span>
                                </section>
                                <section class="flex items-center space-x-2 text-white-text">
                                    {{-- <a href="{{ route('admin.teacher-picket.show', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a> --}}
                                    <a href="{{ route('admin.teacher-picket.edit', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.teacher-picket.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="outline-none size-9 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                delete
                                            </span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.teacher-picket.action', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="{{ $item->action === 0 ? 1 : 0 }}">
                                        <button type="submit"
                                            class="outline-none text-white-text size-9 rounded flex items-center justify-center bg-indigo-600 transition duration-300 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                {{ $item->action === 0 ? 'radio_button_unchecked' : 'radio_button_checked' }}
                                            </span>
                                        </button>
                                    </form>
                                </section>
                            </li>
                        @empty
                            <li>Belum ada guru piket pada hari ini.</li>
                        @endforelse
                    </ul>
                </section>
                <section class="col-span-1 bg-white rounded-md shadow-lg border p-5">
                    <h2 class="text-base font-semibold font-poppins uppercase mb-3">Jumat :</h2>
                    <ul class="flex flex-col space-y-2 text-slate-800">
                        @forelse ($jumat as $item)
                            <li class="flex items-center justify-between w-full">
                                <section class="flex items-center space-x-2 font-medium">
                                    <span>{{ $loop->iteration }} .</span>
                                    <span>{{ $item->teacher->name }}</span>
                                </section>
                                <section class="flex items-center space-x-2 text-white-text">
                                    {{-- <a href="{{ route('admin.teacher-picket.show', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a> --}}
                                    <a href="{{ route('admin.teacher-picket.edit', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.teacher-picket.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="outline-none size-9 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                delete
                                            </span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.teacher-picket.action', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="{{ $item->action === 0 ? 1 : 0 }}">
                                        <button type="submit"
                                            class="outline-none text-white-text size-9 rounded flex items-center justify-center bg-indigo-600 transition duration-300 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                {{ $item->action === 0 ? 'radio_button_unchecked' : 'radio_button_checked' }}
                                            </span>
                                        </button>
                                    </form>
                                </section>
                            </li>
                        @empty
                            <li>Belum ada guru piket pada hari ini.</li>
                        @endforelse
                    </ul>
                </section>
                <section class="col-span-1 bg-white rounded-md shadow-lg border p-5">
                    <h2 class="text-base font-semibold font-poppins uppercase mb-3">Sabtu :</h2>
                    <ul class="flex flex-col space-y-2 text-slate-800">
                        @forelse ($sabtu as $item)
                            <li class="flex items-center justify-between w-full">
                                <section class="flex items-center space-x-2 font-medium">
                                    <span>{{ $loop->iteration }} .</span>
                                    <span>{{ $item->teacher->name }}</span>
                                </section>
                                <section class="flex items-center space-x-2 text-white-text">
                                    {{-- <a href="{{ route('admin.teacher-picket.show', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-sky-600 rounded-md transition duration-300 hover:bg-sky-700 focus:bg-sky-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            visibility
                                        </span>
                                    </a> --}}
                                    <a href="{{ route('admin.teacher-picket.edit', $item->id) }}"
                                        class="outline-none size-9 flex items-center justify-center bg-orange-600 rounded-md transition duration-300 hover:bg-orange-700 focus:bg-orange-700">
                                        <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                            border_color
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.teacher-picket.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="outline-none size-9 flex items-center justify-center bg-red-600 rounded-md transition duration-300 hover:bg-red-700 focus:bg-red-700">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                delete
                                            </span>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.teacher-picket.action', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="{{ $item->action === 0 ? 1 : 0 }}">
                                        <button type="submit"
                                            class="outline-none text-white-text size-9 rounded flex items-center justify-center bg-indigo-600 transition duration-300 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800">
                                            <span class="material-symbols-outlined md:text-[21px] max-md:text-[20px]">
                                                {{ $item->action === 0 ? 'radio_button_unchecked' : 'radio_button_checked' }}
                                            </span>
                                        </button>
                                    </form>
                                </section>
                            </li>
                        @empty
                            <li>Belum ada guru piket pada hari ini.</li>
                        @endforelse
                    </ul>
                </section>
            </div>
        @else
            <section class="bg-white text-hitam p-3 rounded-md shadow-md max-md:text-sm">
                <p class="text-center">Belum ada guru piket yang terdaftar.</p>
            </section>
        @endif
    @endhasrole

    @hasrole('operator')
    @endhasrole

@endsection
