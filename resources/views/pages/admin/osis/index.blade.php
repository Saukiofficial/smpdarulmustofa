@extends('layouts.admin')

@section('title', 'Pengurus OSIS')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kelola Pengurus OSIS</h2>
        <a href="{{ route('admin.pengurus-osis.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Pengurus
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left py-3 px-5">Nama Lengkap</th>
                    <th class="text-left py-3 px-5">Jabatan</th>
                    <th class="text-left py-3 px-5">Urutan</th>
                    <th class="text-center py-3 px-5">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($members as $member)
                <tr class="border-b border-slate-200 hover:bg-slate-50">
                    <td class="py-3 px-5 flex items-center">
                        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="Foto" class="w-10 h-10 rounded-full mr-4 object-cover">
                        <span>{{ $member->name }}</span>
                    </td>
                    <td class="py-3 px-5">{{ $member->position }}</td>
                    <td class="py-3 px-5">{{ $member->display_order }}</td>
                    <td class="py-3 px-5 text-center">
                        <a href="{{ route('admin.pengurus-osis.edit', $member->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4 font-medium">Edit</a>
                        <form action="{{ route('admin.pengurus-osis.destroy', $member->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
