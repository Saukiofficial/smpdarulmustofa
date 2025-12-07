<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{

    public function edit()
    {

        $profile = SchoolProfile::firstOrCreate([], [
            'name' => 'Nama Sekolah Anda',
            'vision' => 'Visi sekolah...',
            'mission' => 'Misi sekolah...',
            'history' => 'Sejarah sekolah...',
            'address' => 'Alamat...',
            'email' => 'email@sekolah.com',
            'phone_number' => '08123456789'
        ]);

        return view('pages.admin.profile.edit', compact('profile'));
    }

    /**
     * Update data profil sekolah.
     */
    public function update(Request $request, SchoolProfile $profile)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'history' => 'required|string',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'map_url' => 'nullable|url',
        ]);

        $profile = SchoolProfile::first();
        $profile->update($request->all());

        return redirect()->route('admin.profile.edit')->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
