@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Album Galeri</h2>
        <a href="{{ route('admin.galeri.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            <i class="fas fa-plus mr-2"></i> Tambah Album
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($albums as $album)
        <div class="bg-slate-50 rounded-lg shadow-md overflow-hidden flex flex-col">
            <a href="{{ route('admin.galeri.edit', $album->id) }}">
                <img src="{{ $album->galleries->first() ? asset('storage/' . $album->galleries->first()->file_path) : 'https://placehold.co/600x400/e2e8f0/6366f1?text=No+Image' }}" alt="Cover Album" class="w-full h-40 object-cover">
            </a>
            <div class="p-4 flex flex-col flex-grow">
                <h3 class="font-bold text-lg text-gray-800 flex-grow">{{ $album->name }}</h3>
                <p class="text-sm text-gray-500">{{ $album->galleries_count }} Foto</p>
                <div class="mt-4 flex justify-end space-x-3">
                    <a href="{{ route('admin.galeri.edit', $album->id) }}" class="text-sm text-indigo-600 hover:underline font-medium">Edit</a>
                    <form action="{{ route('admin.galeri.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus album ini beserta semua fotonya?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:underline font-medium">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
            <p class="col-span-full text-gray-500 text-center">Belum ada album galeri.</p>
        @endforelse
    </div>
    <div class="mt-6">
        {{ $albums->links() }}
    </div>
</div>
@endsection
