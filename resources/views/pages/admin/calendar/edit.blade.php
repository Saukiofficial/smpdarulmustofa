@extends('layouts.admin')
@section('title', 'Edit Kegiatan Kalender')
@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Kegiatan</h2>
    <form action="{{ route('admin.kalender-akademik.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('pages.admin.calendar.partials.form-control')
    </form>
</div>
@endsection
