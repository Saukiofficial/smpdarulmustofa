<?php

namespace App\Http\Controllers;

use App\Models\Alumnus;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AlumniController extends Controller
{

    public function index()
    {

        $alumni = Alumnus::orderBy('graduation_year', 'desc')->paginate(20);


        $testimonials = Testimonial::where('is_published', true)->with('alumnus')->latest()->get();

        return view('pages.frontend.alumni.index', compact('alumni', 'testimonials'));
    }
}
