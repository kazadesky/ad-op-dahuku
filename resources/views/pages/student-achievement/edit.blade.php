@extends('layouts.app')
@section('title', 'Edit Pencapaian Santri')

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
            <span>Operator</span>
        @endhasrole
        <span>/ Page / Pencapaian Santri / Edit</span>
    </p>
@endsection

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')

    @endhasrole

    @hasrole('operator')
    @endhasrole

    @hasrole('teacher')
    @endhasrole
@endsection
