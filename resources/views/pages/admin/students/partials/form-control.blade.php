@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
        <p class="font-bold">Terjadi kesalahan:</p>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $student->user->name ?? '') }}"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg"
            required
        >
    </div>

    <div>
        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $student->user->email ?? '') }}"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg"
            required
        >
    </div>

    <div>
        <label for="nisn" class="block text-gray-700 font-semibold mb-2">NISN</label>
        <input
            type="text"
            id="nisn"
            name="nisn"
            value="{{ old('nisn', $student->nisn ?? '') }}"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg"
            placeholder="Kosongkan jika ingin otomatis"
        >
    </div>

    <div>
        <label for="gender" class="block text-gray-700 font-semibold mb-2">Jenis Kelamin</label>
        <select id="gender" name="gender" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="male" {{ old('gender', $student->gender ?? '') == 'male' ? 'selected' : '' }}>
                Laki-laki
            </option>
            <option value="female" {{ old('gender', $student->gender ?? '') == 'female' ? 'selected' : '' }}>
                Perempuan
            </option>
        </select>
    </div>

    <div>
        <label for="school_class_id" class="block text-gray-700 font-semibold mb-2">Kelas</label>
        <select id="school_class_id" name="school_class_id" class="w-full px-4 py-2 border border-slate-300 rounded-lg" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ old('school_class_id', $student->school_class_id ?? '') == $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="address" class="block text-gray-700 font-semibold mb-2">Alamat</label>
        <input
            type="text"
            id="address"
            name="address"
            value="{{ old('address', $student->address ?? '') }}"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg"
            placeholder="Alamat siswa"
        >
    </div>

    <div>
        <label for="password" class="block text-gray-700 font-semibold mb-2">
            Password
            @if($student->exists)
                <span class="text-xs text-gray-500 font-normal">(kosongkan jika tidak diubah)</span>
            @endif
        </label>
        <input
            type="password"
            id="password"
            name="password"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg"
            {{ $student->exists ? '' : 'required' }}
        >
    </div>

    <div>
        <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Konfirmasi Password</label>
        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            class="w-full px-4 py-2 border border-slate-300 rounded-lg"
            {{ $student->exists ? '' : 'required' }}
        >
    </div>
</div>

<div class="mt-8 flex justify-end">
    <a href="{{ route('admin.data-siswa.index') }}" class="text-gray-600 hover:underline py-2 px-4 mr-4">
        Batal
    </a>

    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">
        Simpan
    </button>
</div>