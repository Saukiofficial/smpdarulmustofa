<?php

namespace App\Http\Controllers;

use App\Models\GalleryAlbum;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function index()
    {
        $albums = GalleryAlbum::with('galleries')->latest()->paginate(12);
        return view('pages.frontend.gallery.index', compact('albums'));
    }


    public function show(GalleryAlbum $galleryAlbum)
    {

        $album = $galleryAlbum->load('galleries');
        return view('pages.frontend.gallery.show', compact('album'));
    }
}
