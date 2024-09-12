@extends('layouts.app')
@section('title', 'Tambah Data Santri')

@section('content')
    @hasrole('super_admin')
    @endhasrole

    @hasrole('admin')
    @endhasrole

    @hasrole('operator')
    @endhasrole
@endsection
