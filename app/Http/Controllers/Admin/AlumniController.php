<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumnus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\AlumniTemplateExport;
use App\Imports\AlumniImport;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{

    public function index()
    {
        $alumni = Alumnus::latest()->paginate(15);
        return view('pages.admin.alumni.index', compact('alumni'));
    }


    public function create()
    {
        return view('pages.admin.alumni.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|digits:4',
            'occupation' => 'nullable|string|max:255',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('photo_path')) {
            $path = $request->file('photo_path')->store('alumni', 'public');
        }

        Alumnus::create($request->except('photo_path') + ['photo_path' => $path]);

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil ditambahkan.');
    }


    public function edit(Alumnus $alumnus)
    {
        return view('pages.admin.alumni.edit', compact('alumnus'));
    }


    public function update(Request $request, Alumnus $alumnus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|integer|digits:4',
            'occupation' => 'nullable|string|max:255',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $alumnus->photo_path;
        if ($request->hasFile('photo_path')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('photo_path')->store('alumni', 'public');
        }

        $alumnus->update($request->except('photo_path') + ['photo_path' => $path]);

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diperbarui.');
    }


    public function destroy(Alumnus $alumnus)
    {
        if ($alumnus->photo_path) {
            Storage::disk('public')->delete($alumnus->photo_path);
        }
        $alumnus->delete();

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil dihapus.');
    }


    public function downloadTemplate()
    {
        return Excel::download(new AlumniTemplateExport, 'template_alumni.xlsx');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new AlumniImport, $request->file('file'));
            return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->route('admin.alumni.index')->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }
}
