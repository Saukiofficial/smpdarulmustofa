@extends('layouts.admin')

@section('title', 'Tambah Alumni')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Tambah Alumni</h2>
    <form action="{{ route('admin.alumni.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('pages.admin.alumni.partials.form-control')
    </form>
</div>
@endsection
