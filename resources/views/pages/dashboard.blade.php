@extends('layouts.app')
@section('title', 'Dashboard')

@section('subtitle')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <p class="flex items-center space-x-px capitalize text-white">
            <span>Admin</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span>Page</span>
            <span class="material-symbols-outlined text-[17px]">
                chevron_right
            </span>
            <span class="text-gray-200">Dashboard</span>
        </p>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection

@section('content')
    @hasrole('super_admin')
        <h1 class="text-xl font-bold">Dashboard Super Admin</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-3 py-1 rounded shadow-sm text-white bg-red-500">Logout</button>
        </form>
    @endhasrole

    @hasrole('admin')
        <h1 class="text-xl font-bold">Dashboard Admin</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-3 py-1 rounded shadow-sm text-white bg-red-500">Logout</button>
        </form>
    @endhasrole

    @hasrole('operator')
        <h1 class="text-xl font-bold">Dashboard Operator</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="px-3 py-1 rounded shadow-sm text-white bg-red-500">Logout</button>
        </form>
    @endhasrole
@endsection
