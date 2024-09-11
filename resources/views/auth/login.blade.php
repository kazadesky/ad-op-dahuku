@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <div class="w-full text-center">
        <h1 class="font-poppins md:text-3xl uppercase font-bold">Login</h1>
        <p class="text-gray-500 text-sm capitalize mt-1">Sistem informasi pondok darul huda kutacane</p>
    </div>
    <form action="{{ route('login.proses') }}" method="POST" class="w-full mt-2 sm:rounded-lg sm:shadow-lg sm:p-5 border">
        @csrf
        <div class="mb-4">
            <label for="email" class="block mb-2 font-medium">Email</label>
            <input type="email" name="email" id="email"
                class="outline-none w-full rounded-md h-12 px-3 border-[1.5px] border-gray-300 transition duration-300 focus:border-sky-500 focus:shadow-sm focus:ring-2 focus:ring-sky-300"
                placeholder="email@example.com">
        </div>
        <div class="mb-4">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block font-medium">Password</label>
                <a href="" onclick="return false"
                    class="outline-none capitalize text-gray-600 text-sm underline underline-offset-2 active:text-sky-500">forgot
                    password?</a>
            </div>
            <div class="relative w-full">
                <input type="password" name="password" id="password"
                    class="outline-none w-full rounded-md h-12 pl-3 pr-12 border-[1.5px] border-gray-300 transition duration-300 focus:border-sky-500 focus:shadow-sm focus:ring-2 focus:ring-sky-300"
                    placeholder="******">
                <button type="button" onclick="passwordShow(event)"
                    class="absolute top-[0.30rem] right-2 text-gray-500 active:text-sky-500 w-10 h-10 flex items-center justify-center outline-none">
                    <span id="icon" class="material-symbols-outlined">
                        visibility
                    </span>
                </button>
            </div>
        </div>
        <button type="submit"
            class="w-full mt-2 h-11 flex items-center justify-center uppercase font-medium bg-sky-500 rounded-md shadow transition duration-300 text-white hover:bg-sky-600 focus:bg-sky-600">login</button>
    </form>
@endsection
