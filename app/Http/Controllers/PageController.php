<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use App\Models\OrganizationalStructure;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Pastikan nama class di sini adalah PageController
class PageController extends Controller
{
    public function visionMission()
    {
        $profile = SchoolProfile::first();
        return view('pages.frontend.profile.vision-mission', compact('profile'));

    }
    public function teachers()
{
    $teachers = \App\Models\Teacher::with('user')->get();
    return view('pages.frontend.teachers', compact('teachers'));
}

public function osis()
{
    $osisMembers = \App\Models\OsisMember::orderBy('display_order')->get();
    return view('pages.frontend.osis', compact('osisMembers'));
}
public function alumniBoard()
{
    $alumniBoards = \App\Models\AlumniBoard::orderBy('display_order')->get();
    return view('pages.frontend.alumni-board', compact('alumniBoards'));
}

    public function history()
    {
        $profile = SchoolProfile::first();
        return view('pages.frontend.profile.history', compact('profile'));
    }

    public function organization()
    {
        $members = OrganizationalStructure::orderBy('display_order')->get();
        $organization = $members->groupBy(function($item) {
            return Str::upper($item->position);
        });
        return view('pages.frontend.profile.organization', compact('organization'));
    }

    public function facilities()
    {
        $facilities = Facility::latest()->paginate(9);
        return view('pages.frontend.profile.facilities', compact('facilities'));
    }
}
