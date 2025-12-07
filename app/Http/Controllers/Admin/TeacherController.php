<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class TeacherController extends Controller
{
    /**
     * Menampilkan daftar semua guru.
     */
    public function index()
    {
        // Mengambil data guru beserta relasi user-nya
        $teachers = Teacher::with('user')->latest()->paginate(15);
        return view('pages.admin.teachers.index', compact('teachers'));
    }

    /**
     * Menampilkan form untuk menambah guru baru.
     */
    public function create()
    {
        return view('pages.admin.teachers.create');
    }

    /**
     * Menyimpan data guru baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nip' => ['required', 'string', 'max:255', 'unique:'.Teacher::class],
            'mapel' => ['required', 'string', 'max:255'],
            'profile_photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $path = null;
        if ($request->hasFile('profile_photo_path')) {
            $path = $request->file('profile_photo_path')->store('teachers', 'public');
        }

        // 1. Buat User baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_path' => $path,
        ]);

        // 2. Beri role 'guru'
        $teacherRole = Role::where('name', 'guru')->first();
        if ($teacherRole) {
            $user->roles()->attach($teacherRole->id);
        }

        // 3. Buat data Teacher
        Teacher::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'gender' => 'male', // Anda bisa menambahkan field ini di form jika perlu
        ]);

        return redirect()->route('admin.data-guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data guru.
     */
    public function edit(Teacher $data_guru)
    {
        return view('pages.admin.teachers.edit', ['teacher' => $data_guru]);
    }

    /**
     * Memperbarui data guru.
     */
    public function update(Request $request, Teacher $data_guru)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class.',email,'.$data_guru->user_id],
            'nip' => ['required', 'string', 'max:255', 'unique:'.Teacher::class.',nip,'.$data_guru->id],
            'mapel' => ['required', 'string', 'max:255'],
            'profile_photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Update data di tabel User
        $user = $data_guru->user;
        $path = $user->profile_photo_path;
        if ($request->hasFile('profile_photo_path')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('profile_photo_path')->store('teachers', 'public');
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile_photo_path' => $path,
        ]);

        // Update data di tabel Teacher
        $data_guru->update([
            'nip' => $request->nip,
            'mapel' => $request->mapel,
        ]);

        return redirect()->route('admin.data-guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Menghapus data guru.
     */
    public function destroy(Teacher $data_guru)
    {
        // Hapus user terkait, yang akan otomatis menghapus data teacher karena relasi
        $user = $data_guru->user;
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }
        $user->delete();

        return redirect()->route('admin.data-guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
