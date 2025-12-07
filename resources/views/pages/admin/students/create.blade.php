@extends('layouts.admin')

@section('title', 'Tambah Data Siswa')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Tambah Siswa Baru</h2>
    <form action="{{ route('admin.data-siswa.store') }}" method="POST">
        @csrf
        @include('pages.admin.students.partials.form-control', ['student' => new \App\Models\Student])
    </form>
</div>
@endsection
