@extends('layouts.admin')

@section('title', 'Edit Data Siswa')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Formulir Edit Data Siswa</h2>
    <p class="text-sm text-gray-500 mb-6">Siswa SMP hanya bisa masuk ke Kelas 7, Kelas 8, atau Kelas 9.</p>

    <form action="{{ route('admin.data-siswa.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('pages.admin.students.partials.form-control', [
            'student' => $student,
            'classes' => $classes,
        ])
    </form>
</div>
@endsection