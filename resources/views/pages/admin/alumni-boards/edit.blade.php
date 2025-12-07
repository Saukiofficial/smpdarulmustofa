@extends('layouts.admin')

@section('title', 'Edit Pengurus Alumni')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Pengurus Alumni</h2>
    <form action="{{ url('admin/pengurus-alumni/' . $member->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('pages.admin.alumni-boards.partials.form-control')
    </form>
</div>
@endsection
