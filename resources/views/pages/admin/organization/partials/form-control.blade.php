@php

    $positions = [
        'KEPALA SEKOLAH',
        'WAKIL KEPALA SEKOLAH',
        'KOMITE SEKOLAH',
        'KEPALA TATA USAHA',
        'STAF TATA USAHA',
        'WAKA KURIKULUM',
        'WAKA KESISWAAN',
        'WAKA SARPRAS',
        'WAKA HUMAS'
    ];
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
        <input type="text" id="name" name="name" value="{{ old('name', $member->name ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
    </div>
    <div>
        <label for="position" class="block text-gray-700 font-semibold mb-2">Jabatan</label>

        <select id="position" name="position" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
            <option value="">-- Pilih Jabatan --</option>
            @foreach($positions as $position)
                <option value="{{ $position }}" {{ (old('position', $member->position ?? '') == $position) ? 'selected' : '' }}>
                    {{ ucwords(strtolower($position)) }}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="mt-6">
    <label for="display_order" class="block text-gray-700 font-semibold mb-2">Urutan Tampil</label>
    <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $member->display_order ?? 0) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
</div>
<div class="mt-6">
    <label for="photo_path" class="block text-gray-700 font-semibold mb-2">Foto</label>
    <input type="file" id="photo_path" name="photo_path" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" {{ isset($member) ? '' : 'required' }}>
    @if(isset($member) && $member->photo_path)
        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="Foto" class="w-24 h-24 rounded-full mt-4 object-cover">
    @endif
</div>
<div class="mt-8 flex justify-end">
    <a href="{{ route('admin.struktur-organisasi.index') }}" class="text-gray-600 hover:underline py-2 px-4 mr-4">Batal</a>
    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">Simpan</button>
</div>
