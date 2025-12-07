@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <div class="p-3 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-lg mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Buat Berita Baru</h1>
                    <p class="text-gray-600 mt-1">Tambahkan berita atau pengumuman untuk website Anda</p>
                </div>
            </div>

            <!-- Breadcrumb -->
            <nav class="flex text-sm text-gray-500">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="{{ route('admin.berita.index') }}" class="hover:text-blue-600 transition-colors">Berita</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-medium">Tambah Baru</span>
            </nav>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Formulir Berita
                </h2>
                <p class="text-blue-100 mt-1">Isi semua informasi yang diperlukan dengan lengkap</p>
            </div>


            @if ($errors->any())
                <div class="m-6 bg-red-50 border-l-4 border-red-400 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <h3 class="font-semibold text-red-800">Terjadi Kesalahan</h3>
                    </div>
                    <ul class="text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-start">
                                <span class="text-red-400 mr-2">•</span>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                <!-- Title Section -->
                <div class="space-y-2">
                    <label for="title" class="flex items-center text-gray-700 font-semibold">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4z"></path>
                        </svg>
                        Judul Berita <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Masukkan judul berita yang menarik..."
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:border-gray-300"
                        required
                    >
                </div>

                <!-- Content Section -->
                <div class="space-y-2">
                    <label for="content" class="flex items-center text-gray-700 font-semibold">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Konten Berita <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <textarea
                            id="content"
                            name="content"
                            rows="12"
                            placeholder="Tulis konten berita Anda di sini..."
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:border-gray-300 resize-none"
                            required
                        >{{ old('content') }}</textarea>
                        <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                            <span id="charCount">0</span> karakter
                        </div>
                    </div>
                </div>

                <!-- Settings Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Type Selection -->
                    <div class="space-y-2">
                        <label for="type" class="flex items-center text-gray-700 font-semibold">
                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Kategori
                        </label>
                        <div class="relative">
                            <select
                                name="type"
                                id="type"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:border-gray-300 appearance-none bg-white"
                            >
                                <option value="news" {{ old('type') == 'news' ? 'selected' : '' }}>📰 Berita</option>
                                <option value="announcement" {{ old('type') == 'announcement' ? 'selected' : '' }}>📢 Pengumuman</option>
                            </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Status Selection -->
                    <div class="space-y-2">
                        <label for="status" class="flex items-center text-gray-700 font-semibold">
                            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Status
                        </label>
                        <div class="relative">
                            <select
                                name="status"
                                id="status"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:border-gray-300 appearance-none bg-white"
                            >
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>🟢 Published</option>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>🟡 Draft</option>
                            </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Featured Image Upload -->
                    <div class="space-y-2">
                        <label for="featured_image_path" class="flex items-center text-gray-700 font-semibold">
                            <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Gambar Utama
                        </label>
                        <div class="relative">
                            <input
                                type="file"
                                id="featured_image_path"
                                name="featured_image_path"
                                accept="image/*"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 hover:border-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:transition-colors"
                            >
                        </div>
                        <p class="text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end items-center space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-100">
                    <a
                        href="{{ route('admin.berita.index') }}"
                        class="w-full sm:w-auto px-6 py-3 text-gray-600 hover:text-gray-800 font-medium rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-300 text-center"
                    >
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105"
                    >
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Berita
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Info Card -->
        <div class="mt-6 bg-blue-50 rounded-xl p-6 border border-blue-100">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <h3 class="font-semibold text-blue-800 mb-2">Tips Menulis Berita</h3>
                    <ul class="text-blue-700 text-sm space-y-1">
                        <li>• Gunakan judul yang menarik dan informatif</li>
                        <li>• Mulai dengan lead yang menjawab 5W+1H (What, Who, When, Where, Why, How)</li>
                        <li>• Gunakan gambar yang relevan untuk meningkatkan engagement</li>
                        <li>• Periksa kembali ejaan dan tata bahasa sebelum publish</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const contentTextarea = document.getElementById('content');
    const charCount = document.getElementById('charCount');

    function updateCharCount() {
        const count = contentTextarea.value.length;
        charCount.textContent = count.toLocaleString();
    }

    contentTextarea.addEventListener('input', updateCharCount);
    updateCharCount();
});
</script>
@endsection
