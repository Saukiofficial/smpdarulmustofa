@extends('layouts.admin')

@section('title', 'Edit Pengurus OSIS')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Edit Pengurus</h2>
    <form action="{{ route('admin.pengurus-osis.update', $member->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('pages.admin.osis.partials.form-control')
    </form>
</div>
@endsection
