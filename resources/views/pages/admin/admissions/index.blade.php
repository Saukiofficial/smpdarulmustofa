@extends('layouts.admin')

@section('title', 'Data Pendaftar PPDB')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Pendaftar PPDB</h2>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-slate-100">
                <tr>
                    <th class="text-left py-3 px-5">No. Pendaftaran</th>
                    <th class="text-left py-3 px-5">Nama Lengkap</th>
                    <th class="text-left py-3 px-5">Asal Sekolah</th>
                    <th class="text-left py-3 px-5">Status</th>
                    <th class="text-center py-3 px-5">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($admissions as $admission)
                <tr class="border-b border-slate-200 hover:bg-slate-50">
                    <td class="py-3 px-5 font-mono">{{ $admission->registration_number }}</td>
                    <td class="py-3 px-5 font-semibold">{{ $admission->full_name }}</td>
                    <td class="py-3 px-5">{{ $admission->previous_school }}</td>
                    <td class="py-3 px-5">
                        <form action="{{ route('admin.ppdb.update', $admission->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="text-xs font-medium rounded-full border-0 focus:ring-2 focus:ring-indigo-500
                                @if($admission->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($admission->status == 'accepted') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                <option value="pending" @if($admission->status == 'pending') selected @endif>Pending</option>
                                <option value="accepted" @if($admission->status == 'accepted') selected @endif>Lulus</option>
                                <option value="rejected" @if($admission->status == 'rejected') selected @endif>Tidak Lulus</option>
                            </select>
                        </form>
                    </td>
                    <td class="py-3 px-5 text-center">
                        <a href="{{ route('admin.ppdb.show', $admission->id) }}" class="bg-indigo-100 text-indigo-700 hover:bg-indigo-200 text-sm font-bold py-1 px-3 rounded-lg">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Belum ada data pendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $admissions->links() }}
    </div>
</div>
@endsection
