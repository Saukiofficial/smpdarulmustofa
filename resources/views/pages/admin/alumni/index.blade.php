@extends('layouts.admin')

@section('title', 'Kelola Alumni')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Alumni</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.alumni.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 text-sm">
                <i class="fas fa-plus mr-2"></i> Tambah Alumni
            </a>
            <a href="{{ route('admin.alumni.template') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 text-sm">
                <i class="fas fa-file-excel mr-2"></i> Download Template
            </a>
        </div>
    </div>


    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{--Import Excel --}}
    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
        <form action="{{ route('admin.alumni.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4">
            @csrf
            <label for="file-upload" class="font-semibold text-gray-700">Import Data dari Excel:</label>
            <input type="file" name="file" id="file-upload" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 text-sm">
                <i class="fas fa-upload mr-2"></i> Import
            </button>
        </form>
    </div>


    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left py-3 px-5 text-gray-600 font-semibold uppercase text-sm">Nama Lengkap</th>
                    <th class="text-left py-3 px-5 text-gray-600 font-semibold uppercase text-sm">Tahun Lulus</th>
                    <th class="text-left py-3 px-5 text-gray-600 font-semibold uppercase text-sm">Pekerjaan</th>
                    <th class="text-center py-3 px-5 text-gray-600 font-semibold uppercase text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($alumni as $item)
                <tr class="border-b border-slate-200 hover:bg-slate-50">
                    <td class="py-3 px-5 flex items-center">
                        <img src="{{ $item->photo_path ? asset('storage/' . $item->photo_path) : 'https://placehold.co/40x40/e2e8f0/6366f1?text='.substr($item->name, 0, 1) }}" alt="Foto" class="w-10 h-10 rounded-full mr-4 object-cover">
                        <span>{{ $item->name }}</span>
                    </td>
                    <td class="py-3 px-5">{{ $item->graduation_year }}</td>
                    <td class="py-3 px-5">{{ $item->occupation ?? '-' }}</td>
                    <td class="py-3 px-5 text-center">
                        <a href="{{ route('admin.alumni.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4 font-medium">Edit</a>
                        <form action="{{ route('admin.alumni.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada data alumni.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $alumni->links() }}
    </div>
</div>
@endsection
