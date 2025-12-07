<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationalStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationalStructureController extends Controller
{

    public function index()
    {
        $members = OrganizationalStructure::orderBy('display_order')->paginate(15);
        return view('pages.admin.organization.index', compact('members'));
    }


    public function create()
    {
        return view('pages.admin.organization.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'display_order' => 'required|integer',
            'photo_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('photo_path')->store('organization', 'public');

        OrganizationalStructure::create($request->except('photo_path') + ['photo_path' => $path]);

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Anggota baru berhasil ditambahkan.');
    }


    public function edit(OrganizationalStructure $struktur_organisasi)
    {
        return view('pages.admin.organization.edit', ['member' => $struktur_organisasi]);
    }


    public function update(Request $request, OrganizationalStructure $struktur_organisasi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'display_order' => 'required|integer',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $struktur_organisasi->photo_path;
        if ($request->hasFile('photo_path')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('photo_path')->store('organization', 'public');
        }

        $struktur_organisasi->update($request->except('photo_path') + ['photo_path' => $path]);

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy(OrganizationalStructure $struktur_organisasi)
    {
        if ($struktur_organisasi->photo_path) {
            Storage::disk('public')->delete($struktur_organisasi->photo_path);
        }
        $struktur_organisasi->delete();

        return redirect()->route('admin.struktur-organisasi.index')->with('success', 'Data berhasil dihapus.');
    }
}
