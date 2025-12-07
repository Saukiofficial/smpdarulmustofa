
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
        <input type="text" id="name" name="name" value="{{ old('name', $alumnus->name ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
    </div>
    <div>
        <label for="graduation_year" class="block text-gray-700 font-semibold mb-2">Tahun Lulus</label>
        <input type="number" id="graduation_year" name="graduation_year" value="{{ old('graduation_year', $alumnus->graduation_year ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required placeholder="Contoh: 2015">
    </div>
</div>
<div class="mt-6">
    <label for="occupation" class="block text-gray-700 font-semibold mb-2">Pekerjaan / Profesi</label>
    <input type="text" id="occupation" name="occupation" value="{{ old('occupation', $alumnus->occupation ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg">
</div>
<div class="mt-6">
    <label for="photo_path" class="block text-gray-700 font-semibold mb-2">Foto</label>
    <input type="file" id="photo_path" name="photo_path" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
    @if(isset($alumnus) && $alumnus->photo_path)
        <img src="{{ asset('storage/' . $alumnus->photo_path) }}" alt="Foto" class="w-24 h-24 rounded-full mt-4 object-cover">
    @endif
</div>
<div class="mt-8 flex justify-end">
    <a href="{{ route('admin.alumni.index') }}" class="text-gray-600 hover:underline py-2 px-4 mr-4">Batal</a>
    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">Simpan</button>
</div>
