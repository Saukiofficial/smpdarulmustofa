@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <div class="flex flex-col sm:flex-row justify-between items-start mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $admission->full_name }}</h2>
            <p class="font-mono text-gray-500">{{ $admission->registration_number }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.ppdb.download', $admission->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg text-sm inline-flex items-center">
                <i class="fas fa-file-pdf mr-2"></i> Unduh Formulir
            </a>
            <a href="{{ route('admin.ppdb.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg text-sm">&larr; Kembali</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Kolom Kiri & Tengah: Detail Data --}}
        <div class="md:col-span-2 space-y-8">

            <!-- Data Diri Siswa -->
            <div>
                <h3 class="font-bold text-lg text-gray-800 border-b pb-2 mb-4">Data Diri Siswa</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    <p class="text-gray-500">NISN</p><p class="text-gray-800 font-semibold">{{ $admission->nisn ?? '-' }}</p>
                    <p class="text-gray-500">Jenis Kelamin</p><p class="text-gray-800 font-semibold">{{ $admission->gender }}</p>
                    <p class="text-gray-500">Tempat, Tgl Lahir</p><p class="text-gray-800 font-semibold">{{ $admission->birth_place }}, {{ \Carbon\Carbon::parse($admission->birth_date)->isoFormat('D MMMM Y') }}</p>
                    <p class="text-gray-500">Agama</p><p class="text-gray-800 font-semibold">{{ $admission->religion ?? '-' }}</p>
                </div>
            </div>

             <!-- Data Akademik Asal -->
            <div>
                <h3 class="font-bold text-lg text-gray-800 border-b pb-2 mb-4">Data Akademik Asal</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    <p class="text-gray-500">Asal Sekolah</p><p class="text-gray-800 font-semibold">{{ $admission->previous_school }}</p>
                    <p class="text-gray-500">Tahun Lulus</p><p class="text-gray-800 font-semibold">{{ $admission->graduation_year ?? '-' }}</p>
                    <p class="text-gray-500 sm:col-span-2">Alamat Sekolah Asal</p><p class="text-gray-800 font-semibold sm:col-span-2">{{ $admission->school_address ?? '-' }}</p>
                </div>
            </div>

            <!-- Data Alamat -->
            <div>
                <h3 class="font-bold text-lg text-gray-800 border-b pb-2 mb-4">Alamat Sesuai KK</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    <p class="text-gray-500">Desa / Kelurahan</p><p class="text-gray-800 font-semibold">{{ $admission->village ?? '-' }}</p>
                    <p class="text-gray-500">Kecamatan</p><p class="text-gray-800 font-semibold">{{ $admission->district ?? '-' }}</p>
                    <p class="text-gray-500">Kota / Kabupaten</p><p class="text-gray-800 font-semibold">{{ $admission->city ?? '-' }}</p>
                    <p class="text-gray-500 sm:col-span-2">Alamat Lengkap</p><p class="text-gray-800 font-semibold sm:col-span-2">{{ $admission->address }}</p>
                </div>
            </div>

             <!-- Data Orang Tua -->
            <div>
                <h3 class="font-bold text-lg text-gray-800 border-b pb-2 mb-4">Data Orang Tua</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    <p class="text-gray-500">Nama Ayah</p><p class="text-gray-800 font-semibold">{{ $admission->father_name }}</p>
                    <p class="text-gray-500">Pekerjaan Ayah</p><p class="text-gray-800 font-semibold">{{ $admission->father_job ?? '-' }}</p>
                    <p class="text-gray-500">No. HP Ayah</p><p class="text-gray-800 font-semibold">{{ $admission->father_phone ?? '-' }}</p>
                    <p class="text-gray-500">Nama Ibu</p><p class="text-gray-800 font-semibold">{{ $admission->mother_name }}</p>
                    <p class="text-gray-500">Pekerjaan Ibu</p><p class="text-gray-800 font-semibold">{{ $admission->mother_job ?? '-' }}</p>
                    <p class="text-gray-500">No. HP Ibu</p><p class="text-gray-800 font-semibold">{{ $admission->mother_phone ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Foto & Berkas --}}
        <div class="space-y-6">
            <!-- Foto Siswa -->
            @php
                $photo = $admission->documents->where('document_name', 'pas_foto')->first();
            @endphp
            <div>
                <h3 class="font-bold text-lg text-gray-800 border-b pb-2 mb-3">Foto Siswa</h3>
                 @if($photo)
                    <img src="{{ asset('storage/' . $photo->file_path) }}" alt="Foto Siswa" class="w-full rounded-lg shadow-md">
                @else
                    <div class="text-center py-10 bg-gray-50 rounded-lg">
                        <p class="text-gray-500 text-sm">Foto tidak diupload.</p>
                    </div>
                @endif
            </div>

            <!-- Berkas Terlampir -->
            <div>
                <h3 class="font-bold text-lg text-gray-800 border-b pb-2 mb-3">Berkas Terlampir</h3>
                <ul class="space-y-2">
                    @forelse($admission->documents->where('document_name', '!=', 'pas_foto') as $doc)
                        <li>
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" class="flex items-center justify-between bg-slate-100 hover:bg-slate-200 p-3 rounded-lg text-sm transition duration-200">
                                <span class="font-semibold text-gray-700">{{ Str::title(str_replace('_', ' ', $doc->document_name)) }}</span>
                                <i class="fas fa-download text-gray-500"></i>
                            </a>
                        </li>
                    @empty
                        <li class="text-gray-500 text-sm bg-slate-50 p-3 rounded-lg">Tidak ada berkas yang diupload.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
