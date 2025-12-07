<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
        <input type="text" id="name" name="name" value="{{ old('name', $teacher->user->name ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
    </div>
    <div>
        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $teacher->user->email ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
    </div>
    <div>
        <label for="nip" class="block text-gray-700 font-semibold mb-2">NIP</label>
        <input type="text" id="nip" name="nip" value="{{ old('nip', $teacher->nip ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
    </div>
    <div>
        <label for="mapel" class="block text-gray-700 font-semibold mb-2">Mata Pelajaran</label>
        <input type="text" id="mapel" name="mapel" value="{{ old('mapel', $teacher->mapel ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
    </div>
    @if(!$teacher->exists)
    <div>
        <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
        <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
    </div>
    <div>
        <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
    </div>
    @endif
</div>
<div class="mt-6">
    <label for="profile_photo_path" class="block text-gray-700 font-semibold mb-2">Foto Profil</label>
    <input type="file" id="profile_photo_path" name="profile_photo_path" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
    @if(isset($teacher->user) && $teacher->user->profile_photo_path)
        <img src="{{ asset('storage/' . $teacher->user->profile_photo_path) }}" alt="Foto" class="w-24 h-24 rounded-full mt-4 object-cover">
    @endif
</div>
<div class="mt-8 flex justify-end">
    <a href="{{ route('admin.data-guru.index') }}" class="text-gray-600 hover:underline py-2 px-4 mr-4">Batal</a>
    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">Simpan</button>
</div>
