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
        <span>/ Page / Dashboard</span>
    </p>
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
