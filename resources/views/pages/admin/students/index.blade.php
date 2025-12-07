@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Siswa SMP</h2>
        <div class="flex flex-wrap gap-2">

            <a href="{{ route('admin.data-siswa.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                <i class="fas fa-plus mr-2"></i> Tambah Siswa
            </a>
            {{--
            <a href="{{ route('admin.data-siswa.template') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                <i class="fas fa-file-excel mr-2"></i> Download Template
            </a>
            <a href="{{ route('admin.data-siswa.export') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                <i class="fas fa-file-export mr-2"></i> Export Data
            </a>
            --}}
        </div>
    </div>

    <!-- Form Filter -->
    <div class="bg-slate-50 border border-slate-200 p-4 rounded-lg mb-6">
        <form action="{{ route('admin.data-siswa.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <select name="search_gender" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="male" {{ request('search_gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ request('search_gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <select name="search_kelas" class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Semua Kelas</option>
                     @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('search_kelas') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
                <div class="flex gap-2">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg text-sm">Filter</button>
                    <a href="{{ route('admin.data-siswa.index') }}" class="w-full text-center bg-slate-600 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded-lg text-sm flex items-center justify-center">Reset</a>
                </div>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left py-3 px-5">Nama Siswa</th>
                    <th class="text-left py-3 px-5">Jenis Kelamin</th>
                    <th class="text-left py-3 px-5">Kelas</th>
                    <th class="text-center py-3 px-5">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($students as $student)
                <tr class="border-b border-slate-200 hover:bg-slate-50">
                    <td class="py-3 px-5">{{ $student->user->name }}</td>
                    <td class="py-3 px-5">{{ $student->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="py-3 px-5">{{ $student->schoolClass->name ?? 'Belum ada kelas' }}</td>
                    <td class="py-3 px-5 text-center">
                        <a href="{{ route('admin.data-siswa.edit', $student->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4 font-medium">Edit</a>
                        <form action="{{ route('admin.data-siswa.destroy', $student->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data siswa ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Data tidak ditemukan.</td>
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
