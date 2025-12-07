@extends('layouts.admin')

@section('title', 'Tambah Album Galeri')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Tambah Album Baru</h2>

    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Album</label>
            <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi (Opsional)</label>
            <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
        </div>

        <div class="mb-6">
            <label for="images" class="block text-gray-700 font-semibold mb-2">Upload Foto (Bisa lebih dari satu)</label>
            <input type="file" id="images" name="images[]" multiple class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('admin.galeri.index') }}" class="text-gray-600 hover:underline py-2 px-4 mr-4">Batal</a>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">Simpan Album</button>
        </div>
    </form>
</div>
@endsection
