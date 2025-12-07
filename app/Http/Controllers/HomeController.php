<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User; // Pastikan ini di-import
use App\Models\Gallery;
use App\Models\Facility;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {

        $latestPosts = Post::where('status', 'published')->latest()->take(3)->get();


        $studentCount = User::whereHas('roles', fn($q) => $q->where('name', 'siswa'))->count();
        $teacherCount = User::whereHas('roles', fn($q) => $q->where('name', 'guru'))->count();
        $extracurricularCount = 12; //
        $visitorCount = 900;;


        return view('pages.frontend.home', compact(
            'latestPosts',
            'studentCount',
            'teacherCount',
            'extracurricularCount',
            'visitorCount'
        ));
    }
}
