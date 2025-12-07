@extends('layouts.admin')

@section('title', 'Edit Profil Saya')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <div class="bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Informasi Profil</h2>
            <p class="text-sm text-gray-500 mb-6">Perbarui informasi profil dan alamat email Anda.</p>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('admin.my-profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-6">
                    <label for="profile_photo_path" class="block text-gray-700 font-semibold mb-2">Foto</label>
                    <div class="flex items-center gap-4">
                        <img class="h-24 w-24 rounded-full object-cover" src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : 'https://placehold.co/96x96/e2e8f0/6366f1?text='.substr(Auth::user()->name, 0, 1) }}" alt="Foto profil">
                        <input type="file" id="profile_photo_path" name="profile_photo_path" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>


    <div>
        <div class="bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Ubah Password</h2>
            <p class="text-sm text-gray-500 mb-6">Pastikan Password Bapak/Ibu Guru Menggunakan kombinasi ( huruf,angka dan simbol ) demi menjaga keamanan akun.</p>

            @if (session('success-password'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                    <p>{{ session('success-password') }}</p>
                </div>
            @endif
             @if ($errors->updatePassword->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
                     @foreach ($errors->updatePassword->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.my-profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="current_password" class="block text-gray-700 font-semibold mb-2">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
                </div>
                 <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password Baru</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
                </div>
                 <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
                </div>
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
