<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\Role;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str; // <-- Ditambahkan untuk memperbaiki error 'Undefined type Str'

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['user', 'schoolClass']);

        // Logika Filter
        if ($request->filled('search_gender')) {
            $query->where('gender', $request->search_gender);
        }
        if ($request->filled('search_kelas')) {
            $query->where('school_class_id', $request->search_kelas);
        }

        // Diperbaiki: withQueryString() diubah menjadi appends(request()->query())
        $students = $query->latest()->paginate(20)->appends($request->query());

        $classes = SchoolClass::all();

        return view('pages.admin.students.index', compact('students', 'classes'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        return view('pages.admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => 'required|in:male,female',
            'school_class_id' => 'required|exists:school_classes,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $studentRole = Role::where('name', 'siswa')->first();
        if ($studentRole) {
            $user->roles()->attach($studentRole->id);
        }

        // Hapus 'jurusan' dari pembuatan data siswa
        Student::create([
            'user_id' => $user->id,
            'nisn' => 'NISN-' . Str::upper(Str::random(8)), // Dibuat otomatis
            'school_class_id' => $request->school_class_id,
            'gender' => $request->gender,
        ]);

        return redirect()->route('admin.data-siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Student $data_siswa)
    {
        $classes = SchoolClass::all();
        return view('pages.admin.students.edit', ['student' => $data_siswa, 'classes' => $classes]);
    }

    public function update(Request $request, Student $data_siswa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'school_class_id' => 'required|exists:school_classes,id',
        ]);

        $data_siswa->user->update(['name' => $request->name]);
        // Hapus 'jurusan' dari pembaruan data
        $data_siswa->update($request->only(['gender', 'school_class_id']));

        return redirect()->route('admin.data-siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Student $data_siswa)
    {
        $data_siswa->user()->delete(); // Ini akan otomatis menghapus student juga jika diatur di model
        return redirect()->route('admin.data-siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}

