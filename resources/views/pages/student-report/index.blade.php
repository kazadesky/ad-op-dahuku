@extends('layouts.app')
@section('title', 'Raport Santri')

@section('subtitle')
    <p class="flex items-center space-x-px capitalize text-white">
        @hasrole('teacher')
            <span>Teacher</span>
        @endhasrole
        <span>/ Page / Raport Santri</span>
    </p>
@endsection

@section('content')
    @hasrole('teacher')
    @endhasrole
@endsection
