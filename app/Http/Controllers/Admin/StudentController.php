<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentsExport;
use App\Exports\StudentsTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use App\Models\Role;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    private array $smpClasses = [
        'Kelas 7',
        'Kelas 8',
        'Kelas 9',
    ];

    private function ensureSmpClasses(): void
    {
        foreach ($this->smpClasses as $className) {
            SchoolClass::firstOrCreate([
                'name' => $className,
            ]);
        }
    }

    private function getSmpClasses()
    {
        $this->ensureSmpClasses();

        return SchoolClass::whereIn('name', $this->smpClasses)
            ->orderByRaw("FIELD(name, 'Kelas 7', 'Kelas 8', 'Kelas 9')")
            ->get();
    }

    public function index(Request $request)
    {
        $classes = $this->getSmpClasses();

        $query = Student::with(['user', 'schoolClass'])
            ->whereHas('schoolClass', function ($classQuery) {
                $classQuery->whereIn('name', $this->smpClasses);
            });

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nisn', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->filled('search_gender')) {
            $query->where('gender', $request->search_gender);
        }

        if ($request->filled('search_kelas')) {
            $query->where('school_class_id', $request->search_kelas);
        }

        $students = $query->latest()
            ->paginate(20)
            ->appends($request->query());

        return view('pages.admin.students.index', compact('students', 'classes'));
    }

    public function create()
    {
        $classes = $this->getSmpClasses();

        return view('pages.admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $classes = $this->getSmpClasses();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nisn' => ['nullable', 'string', 'max:50', 'unique:students,nisn'],
            'gender' => ['required', 'in:male,female'],
            'school_class_id' => ['required', 'exists:school_classes,id'],
            'address' => ['nullable', 'string', 'max:1000'],
        ]);

        if (! $classes->pluck('id')->contains((int) $request->school_class_id)) {
            return back()
                ->withErrors(['school_class_id' => 'Kelas harus Kelas 7, Kelas 8, atau Kelas 9.'])
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $studentRole = Role::where('name', 'siswa')->first();

        if ($studentRole) {
            $user->roles()->syncWithoutDetaching([$studentRole->id]);
        }

        Student::create([
            'user_id' => $user->id,
            'nisn' => $request->filled('nisn')
                ? $request->nisn
                : 'NISN-' . Str::upper(Str::random(8)),
            'school_class_id' => $request->school_class_id,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        return redirect()
            ->route('admin.data-siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Student $data_siswa)
    {
        $classes = $this->getSmpClasses();

        return view('pages.admin.students.edit', [
            'student' => $data_siswa,
            'classes' => $classes,
        ]);
    }

    public function update(Request $request, Student $data_siswa)
    {
        $classes = $this->getSmpClasses();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $data_siswa->user_id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'nisn' => ['nullable', 'string', 'max:50', 'unique:students,nisn,' . $data_siswa->id],
            'gender' => ['required', 'in:male,female'],
            'school_class_id' => ['required', 'exists:school_classes,id'],
            'address' => ['nullable', 'string', 'max:1000'],
        ]);

        if (! $classes->pluck('id')->contains((int) $request->school_class_id)) {
            return back()
                ->withErrors(['school_class_id' => 'Kelas harus Kelas 7, Kelas 8, atau Kelas 9.'])
                ->withInput();
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $data_siswa->user->update($userData);

        $data_siswa->update([
            'nisn' => $request->filled('nisn')
                ? $request->nisn
                : $data_siswa->nisn,
            'school_class_id' => $request->school_class_id,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        return redirect()
            ->route('admin.data-siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Student $data_siswa)
    {
        $data_siswa->user()->delete();

        return redirect()
            ->route('admin.data-siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function template()
    {
        $this->ensureSmpClasses();

        return Excel::download(new StudentsTemplateExport(), 'template-import-siswa-smp.xlsx');
    }

    public function export(Request $request)
    {
        $this->ensureSmpClasses();

        return Excel::download(
            new StudentsExport(
                search: $request->search,
                gender: $request->search_gender,
                classId: $request->search_kelas,
            ),
            'data-siswa-smp.xlsx'
        );
    }

    public function import(Request $request)
    {
        $this->ensureSmpClasses();

        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120'],
        ]);

        Excel::import(new StudentsImport(), $request->file('file'));

        return redirect()
            ->route('admin.data-siswa.index')
            ->with('success', 'Data siswa berhasil diimport.');
    }
}