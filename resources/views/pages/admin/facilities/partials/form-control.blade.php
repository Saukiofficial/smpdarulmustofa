<div class="mb-4">
    <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Fasilitas</label>
    <input type="text" id="name" name="name" value="{{ old('name', $facility->name ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
</div>
<div class="mb-4">
    <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
    <textarea id="description" name="description" rows="5" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>{{ old('description', $facility->description ?? '') }}</textarea>
</div>
<div class="mt-6">
    <label for="image_path" class="block text-gray-700 font-semibold mb-2">Gambar</label>
    <input type="file" id="image_path" name="image_path" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" {{ isset($facility) ? '' : 'required' }}>
    @if(isset($facility) && $facility->image_path)
        <img src="{{ asset('storage/' . $facility->image_path) }}" alt="Gambar" class="w-48 h-auto rounded-lg mt-4">
    @endif
</div>
<div class="mt-8 flex justify-end">
    <a href="{{ route('admin.fasilitas.index') }}" class="text-gray-600 hover:underline py-2 px-4 mr-4">Batal</a>
    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">Simpan</button>
</div>
