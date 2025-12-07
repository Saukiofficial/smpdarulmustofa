@extends('layouts.admin')

@section('title', 'Edit Guru')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Data Guru</h2>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
            <p class="font-bold">Terjadi kesalahan:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.data-guru.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('pages.admin.teachers.partials.form-control')
    </form>
</div>
@endsection
