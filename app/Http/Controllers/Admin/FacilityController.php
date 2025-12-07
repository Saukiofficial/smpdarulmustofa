<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{

    public function index()
    {
        $facilities = Facility::latest()->paginate(10);
        return view('pages.admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('pages.admin.facilities.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image_path')->store('facilities', 'public');

        Facility::create($request->except('image_path') + ['image_path' => $path]);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }


    public function edit(Facility $fasilitas)
    {
        return view('pages.admin.facilities.edit', ['facility' => $fasilitas]);
    }

    public function update(Request $request, Facility $fasilitas)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $fasilitas->image_path;
        if ($request->hasFile('image_path')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('image_path')->store('facilities', 'public');
        }

        $fasilitas->update($request->except('image_path') + ['image_path' => $path]);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }


    public function destroy(Facility $fasilitas)
    {
        if ($fasilitas->image_path) {
            Storage::disk('public')->delete($fasilitas->image_path);
        }
        $fasilitas->delete();

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
