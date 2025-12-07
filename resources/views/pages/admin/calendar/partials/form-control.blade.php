<div class="mb-4">
    <label for="title" class="block text-gray-700 font-semibold mb-2">Nama Kegiatan</label>
    <input type="text" id="title" name="title" value="{{ old('title', $event->title ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
</div>
<div class="mb-4">
    <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi (Opsional)</label>
    <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg">{{ old('description', $event->description ?? '') }}</textarea>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="start_date" class="block text-gray-700 font-semibold mb-2">Tanggal Mulai</label>
        <input type="date" id="start_date" name="start_date" value="{{ old('start_date', isset($event) ? $event->start_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
    </div>
    <div>
        <label for="end_date" class="block text-gray-700 font-semibold mb-2">Tanggal Selesai (Opsional)</label>
        <input type="date" id="end_date" name="end_date" value="{{ old('end_date', isset($event) && $event->end_date ? $event->end_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg">
    </div>
</div>
<div class="mt-8 flex justify-end">
    <a href="{{ route('admin.kalender-akademik.index') }}" class="text-gray-600 hover:underline py-2 px-4 mr-4">Batal</a>
    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">Simpan</button>
</div>
