@extends('layouts.admin')

@section('title', 'Edit Alumni')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Alumni</h2>
    <form action="{{ route('admin.alumni.update', $alumnus->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('pages.admin.alumni.partials.form-control')
    </form>
</div>
@endsection
