@extends('layouts.admin')

@section('title', 'Tambah Pengurus OSIS')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Tambah Pengurus</h2>
    <form action="{{ route('admin.pengurus-osis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('pages.admin.osis.partials.form-control')
    </form>
</div>
@endsection
