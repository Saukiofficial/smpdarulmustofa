@extends('layouts.admin')

@section('title', 'Edit Album Galeri')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Album: {{ $album->name }}</h2>


    <form action="{{ route('admin.galeri.update', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Album</label>
            <input type="text" id="name" name="name" value="{{ old('name', $album->name) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
            <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg">{{ old('description', $album->description) }}</textarea>
        </div>
        <div class="mb-6">
            <label for="images" class="block text-gray-700 font-semibold mb-2">Tambah Foto Baru</label>
            <input type="file" id="images" name="images[]" multiple class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">Simpan Perubahan</button>
        </div>
    </form>


    <div class="mt-10">
        <h3 class="text-xl font-bold text-gray-800 mb-4 border-t pt-6">Daftar Foto</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse($album->galleries as $photo)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $photo->file_path) }}" class="w-full h-32 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">

                        <form action="#" method="POST">
                             @csrf
                             @method('DELETE')
                            <button type="submit" class="text-white text-2xl"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-gray-500">Belum ada foto di album ini.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
