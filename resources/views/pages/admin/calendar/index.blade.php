@extends('layouts.admin')

@section('title', 'Kelola Kalender Akademik')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Kegiatan Akademik</h2>
        <a href="{{ route('admin.kalender-akademik.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Kegiatan
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
                    <th class="text-left py-3 px-5">Nama Kegiatan</th>
                    <th class="text-left py-3 px-5">Tanggal Mulai</th>
                    <th class="text-left py-3 px-5">Tanggal Selesai</th>
                    <th class="text-center py-3 px-5">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($events as $event)
                <tr class="border-b border-slate-200 hover:bg-slate-50">
                    <td class="py-3 px-5 font-semibold">{{ $event->title }}</td>
                    <td class="py-3 px-5">{{ \Carbon\Carbon::parse($event->start_date)->isoFormat('D MMMM YYYY') }}</td>
                    <td class="py-3 px-5">{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->isoFormat('D MMMM YYYY') : '-' }}</td>
                    <td class="py-3 px-5 text-center">
                        <a href="{{ route('admin.kalender-akademik.edit', $event->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4 font-medium">Edit</a>
                        <form action="{{ route('admin.kalender-akademik.destroy', $event->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada kegiatan yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
