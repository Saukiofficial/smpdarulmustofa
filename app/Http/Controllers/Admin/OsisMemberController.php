<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OsisMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OsisMemberController extends Controller
{
    public function index()
    {
        $members = OsisMember::orderBy('display_order')->paginate(15);
        return view('pages.admin.osis.index', compact('members'));
    }

    public function create()
    {
        return view('pages.admin.osis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'display_order' => 'required|integer',
            'photo_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('photo_path')->store('osis', 'public');

        OsisMember::create($request->except('photo_path') + ['photo_path' => $path]);

        return redirect()->route('admin.pengurus-osis.index')->with('success', 'Anggota OSIS baru berhasil ditambahkan.');
    }

    public function edit(OsisMember $pengurus_osi)
    {
        return view('pages.admin.osis.edit', ['member' => $pengurus_osi]);
    }

    public function update(Request $request, OsisMember $pengurus_osi)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'display_order' => 'required|integer',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $pengurus_osi->photo_path;
        if ($request->hasFile('photo_path')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('photo_path')->store('osis', 'public');
        }

        $pengurus_osi->update($request->except('photo_path') + ['photo_path' => $path]);

        return redirect()->route('admin.pengurus-osis.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(OsisMember $pengurus_osi)
    {
        if ($pengurus_osi->photo_path) {
            Storage::disk('public')->delete($pengurus_osi->photo_path);
        }
        $pengurus_osi->delete();

        return redirect()->route('admin.pengurus-osis.index')->with('success', 'Data berhasil dihapus.');
    }
}
