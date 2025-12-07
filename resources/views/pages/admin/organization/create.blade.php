@extends('layouts.admin')

@section('title', 'Tambah Anggota Organisasi')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Tambah Anggota</h2>
    <form action="{{ route('admin.struktur-organisasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('pages.admin.organization.partials.form-control')
    </form>
</div>
@endsection
