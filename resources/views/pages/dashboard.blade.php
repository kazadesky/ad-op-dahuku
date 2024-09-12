@extends('layouts.app')
@section('title', 'Dashboard')

@section('subtitle')
    @hasrole('super_admin')
        <p class="flex items-center space-x-px capitalize text-white">
            <span>Super Admin</span>
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
        <p class="flex items-center space-x-px capitalize text-white">
            <span>Operator</span>
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
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
        <div class="w-full grid md:grid-cols-3 max-md:grid-cols-1 md:gap-5 max-md:space-y-4">
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-44">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio perferendis ea veniam ullam minima delectus.
                </p>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-44">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio perferendis ea veniam ullam minima delectus.
                </p>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-44">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio perferendis ea veniam ullam minima delectus.
                </p>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-44">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio perferendis ea veniam ullam minima delectus.
                </p>
            </div>
            <div class="col-span-1 shadow-lg rounded-lg bg-white p-5 min-h-44">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odio perferendis ea veniam ullam minima delectus.
                </p>
            </div>
        </div>
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection
