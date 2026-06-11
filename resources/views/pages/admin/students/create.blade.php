@extends('layouts.admin')

@section('title', 'Tambah Data Siswa')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Formulir Tambah Siswa Baru</h2>
    <p class="text-sm text-gray-500 mb-6">Siswa SMP hanya bisa masuk ke Kelas 7, Kelas 8, atau Kelas 9.</p>

    <form action="{{ route('admin.data-siswa.store') }}" method="POST">
        @csrf
        @include('pages.admin.students.partials.form-control', [
            'student' => new \App\Models\Student,
            'classes' => $classes,
        ])
    </form>
</div>
@endsection