<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    public function index()
    {
        $albums = GalleryAlbum::withCount('galleries')->latest()->paginate(12);
        return view('pages.admin.gallery.index', compact('albums'));
    }


    public function create()
    {
        return view('pages.admin.gallery.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $album = GalleryAlbum::create($request->only('name', 'description'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('gallery', 'public');
                $album->galleries()->create([
                    'type' => 'photo',
                    'file_path' => $path,
                    'caption' => $request->name,
                ]);
            }
        }

        return redirect()->route('admin.galeri.index')->with('success', 'Album dan foto berhasil ditambahkan.');
    }


    public function edit(GalleryAlbum $galeri)
    {
        return view('pages.admin.gallery.edit', ['album' => $galeri->load('galleries')]);
    }


    public function update(Request $request, GalleryAlbum $galeri)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $galeri->update($request->only('name', 'description'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('gallery', 'public');
                $galeri->galleries()->create([
                    'type' => 'photo',
                    'file_path' => $path,
                    'caption' => $request->name,
                ]);
            }
        }

        return redirect()->route('admin.galeri.edit', $galeri->id)->with('success', 'Album berhasil diperbarui.');
    }


    public function destroy(GalleryAlbum $galeri)
    {

        foreach ($galeri->galleries as $photo) {
            Storage::disk('public')->delete($photo->file_path);
        }


        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Album berhasil dihapus.');
    }
}
