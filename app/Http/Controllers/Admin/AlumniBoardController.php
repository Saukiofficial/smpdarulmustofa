<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlumniBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniBoardController extends Controller
{
    public function index()
    {
        $members = AlumniBoard::orderBy('display_order')->paginate(15);
        return view('pages.admin.alumni-boards.index', compact('members'));
    }

    public function create()
    {
        return view('pages.admin.alumni-boards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:alumni_boards,name',
            'position' => 'required|string|max:255',
            'display_order' => 'required|integer',
            'photo_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('photo_path')->store('alumni-boards', 'public');

        AlumniBoard::create($request->except('photo_path') + ['photo_path' => $path]);

        return redirect()->route('admin.pengurus-alumni.index')->with('success', 'Anggota pengurus alumni berhasil ditambahkan.');
    }

    public function edit(AlumniBoard $pengurus_alumni)
    {
        return view('pages.admin.alumni-boards.edit', ['member' => $pengurus_alumni]);
    }

    public function update(Request $request, AlumniBoard $pengurus_alumni)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:alumni_boards,name,' . $pengurus_alumni->id,
            'position' => 'required|string|max:255',
            'display_order' => 'required|integer',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $pengurus_alumni->photo_path;
        if ($request->hasFile('photo_path')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('photo_path')->store('alumni-boards', 'public');
        }

        $pengurus_alumni->update($request->except('photo_path') + ['photo_path' => $path]);

        return redirect()->route('admin.pengurus-alumni.index')->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy($id)
    {

        $pengurus_alumni = AlumniBoard::find($id);


        if ($pengurus_alumni) {
            if ($pengurus_alumni->photo_path) {
                Storage::disk('public')->delete($pengurus_alumni->photo_path);
            }


            AlumniBoard::where('id', $id)->delete();

            return redirect()->route('admin.pengurus-alumni.index')->with('success', 'Data berhasil dihapus.');
        }


        return redirect()->route('admin.pengurus-alumni.index')->with('error', 'Data tidak ditemukan.');
    }
}
