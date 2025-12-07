@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-indigo-600 bg-clip-text text-transparent">
                    Edit Berita
                </h1>
            </div>
            <p class="text-gray-600 ml-13">Perbarui informasi berita dengan detail yang akurat dan menarik</p>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Formulir Edit Berita
                </h2>
                <p class="text-indigo-100 mt-1">Lengkapi semua informasi yang diperlukan untuk memperbarui berita</p>
            </div>

            <!-- Form Content -->
            <form action="{{ route('admin.berita.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="mb-8">
                    <label for="title" class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a.997.997 0 01-1.414 0l-7-7A1.997 1.997 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Judul Berita *
                    </label>
                    <div class="relative">
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title', $post->title) }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors duration-200 text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white"
                               placeholder="Masukkan judul berita yang menarik..."
                               required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Content Input -->
                <div class="mb-8">
                    <label for="content" class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Konten Berita *
                    </label>
                    <div class="relative">
                        <textarea id="content"
                                  name="content"
                                  rows="12"
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors duration-200 text-gray-800 placeholder-gray-400 bg-gray-50 focus:bg-white resize-none"
                                  placeholder="Tulis konten berita dengan detail dan menarik..."
                                  required>{{ old('content', $post->content) }}</textarea>
                        <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                            <span id="charCount">0</span> karakter
                        </div>
                    </div>
                </div>

                <!-- Form Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Type Selection -->
                    <div class="group">
                        <label for="type" class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"/>
                            </svg>
                            Kategori
                        </label>
                        <div class="relative">
                            <select name="type"
                                    id="type"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors duration-200 text-gray-800 bg-gray-50 focus:bg-white appearance-none cursor-pointer">
                                <option value="news" {{ $post->type == 'news' ? 'selected' : '' }}>📰 Berita</option>
                                <option value="announcement" {{ $post->type == 'announcement' ? 'selected' : '' }}>📢 Pengumuman</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status Selection -->
                    <div class="group">
                        <label for="status" class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Status Publikasi
                        </label>
                        <div class="relative">
                            <select name="status"
                                    id="status"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors duration-200 text-gray-800 bg-gray-50 focus:bg-white appearance-none cursor-pointer">
                                <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>✅ Publish</option>
                                <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>📝 Draft</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="group">
                        <label for="featured_image_path" class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Gambar Utama Baru
                        </label>
                        <div class="relative">
                            <input type="file"
                                   id="featured_image_path"
                                   name="featured_image_path"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 transition-colors duration-200 text-gray-800 bg-gray-50 focus:bg-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 file:cursor-pointer cursor-pointer"
                                   accept="image/*">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Maks. 2MB)</p>
                    </div>
                </div>

                <!-- Current Image Display -->
                @if($post->featured_image_path)
                <div class="mb-8">
                    <h3 class="text-sm font-semibold text-gray-800 mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Gambar Saat Ini
                    </h3>
                    <div class="relative inline-block">
                        <img src="{{ asset('storage/' . $post->featured_image_path) }}"
                             alt="Gambar Berita"
                             class="w-64 h-48 object-cover rounded-xl shadow-lg border-2 border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="absolute -top-2 -right-2 bg-green-500 text-white rounded-full p-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end items-center space-y-3 sm:space-y-0 sm:space-x-4 pt-8 border-t border-gray-100">
                    <a href="{{ route('admin.berita.index') }}"
                       class="w-full sm:w-auto px-6 py-3 text-gray-600 hover:text-gray-800 font-medium rounded-xl border-2 border-gray-200 hover:border-gray-300 transition-colors duration-200 text-center">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit"
                            class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Character Counter Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const contentTextarea = document.getElementById('content');
    const charCount = document.getElementById('charCount');

    function updateCharCount() {
        const count = contentTextarea.value.length;
        charCount.textContent = count.toLocaleString();
    }

    contentTextarea.addEventListener('input', updateCharCount);
    updateCharCount(); // Initial count
});
</script>
script>
<!-- Tailwind CSS and FontAwesome -->

<!-- Custom Styles -->
<style>
    .group:hover .group-hover\:scale-105 {
        transform: scale(1.05);
    }

    input:focus, textarea:focus, select:focus {
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .file-upload-animation {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .file-upload-animation:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
