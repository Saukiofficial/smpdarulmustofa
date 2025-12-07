@extends('layouts.admin')
@section('title', 'Tambah Kegiatan Kalender')
@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Tambah Kegiatan Baru</h2>
    <form action="{{ route('admin.kalender-akademik.store') }}" method="POST">
        @csrf
        @include('pages.admin.calendar.partials.form-control')
    </form>
</div>
@endsection
