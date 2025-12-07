@extends('layouts.admin')

@section('title', 'Tambah Fasilitas')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Tambah Fasilitas</h2>
    <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('pages.admin.facilities.partials.form-control')
    </form>
</div>
@endsection
