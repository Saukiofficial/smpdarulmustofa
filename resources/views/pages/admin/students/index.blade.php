@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Siswa SMP</h2>
            <p class="text-sm text-gray-500 mt-1">Data siswa hanya untuk Kelas 7, Kelas 8, dan Kelas 9.</p>
        </div>

        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.data-siswa.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                <i class="fas fa-plus mr-2"></i> Tambah Siswa
            </a>

            <a href="{{ route('admin.data-siswa.template') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                <i class="fas fa-file-excel mr-2"></i> Download Template
            </a>

            <a href="{{ route('admin.data-siswa.export', request()->query()) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                <i class="fas fa-file-export mr-2"></i> Export Data
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
            <p class="font-bold mb-2">Terjadi kesalahan:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-slate-50 border border-slate-200 p-4 rounded-lg mb-6">
        <form action="{{ route('admin.data-siswa.import') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            @csrf

            <div class="md:col-span-2">
                <label for="file" class="block text-gray-700 font-semibold mb-2">Import Data Siswa</label>
                <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm bg-white" required>
                <p class="text-xs text-gray-500 mt-1">Format yang didukung: xlsx, xls, csv. Gunakan template agar kolom sesuai.</p>
            </div>

            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                <i class="fas fa-upload mr-2"></i> Import
            </button>
        </form>
    </div>

    <div class="bg-slate-50 border border-slate-200 p-4 rounded-lg mb-6">
        <form action="{{ route('admin.data-siswa.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama, email, atau NISN..."
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >

                <select name="search_gender" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="male" {{ request('search_gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ request('search_gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                </select>

                <select name="search_kelas" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Kelas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('search_kelas') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>

                <div class="flex gap-2">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                        Filter
                    </button>

                    <a href="{{ route('admin.data-siswa.index') }}" class="w-full text-center bg-slate-600 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-lg text-sm flex items-center justify-center">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left py-3 px-5">Nama Siswa</th>
                    <th class="text-left py-3 px-5">Email</th>
                    <th class="text-left py-3 px-5">NISN</th>
                    <th class="text-left py-3 px-5">Jenis Kelamin</th>
                    <th class="text-left py-3 px-5">Kelas</th>
                    <th class="text-center py-3 px-5">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
                @forelse ($students as $student)
                    <tr class="border-b border-slate-200 hover:bg-slate-50">
                        <td class="py-3 px-5 font-medium">{{ $student->user->name ?? '-' }}</td>
                        <td class="py-3 px-5">{{ $student->user->email ?? '-' }}</td>
                        <td class="py-3 px-5">{{ $student->nisn ?? '-' }}</td>
                        <td class="py-3 px-5">{{ $student->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="py-3 px-5">{{ $student->schoolClass->name ?? 'Belum ada kelas' }}</td>
                        <td class="py-3 px-5 text-center whitespace-nowrap">
                            <a href="{{ route('admin.data-siswa.edit', $student->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4 font-medium">
                                Edit
                            </a>

                            <form action="{{ route('admin.data-siswa.destroy', $student->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $students->links() }}
    </div>
</div>
@endsection