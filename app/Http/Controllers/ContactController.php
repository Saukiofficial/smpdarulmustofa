<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function index()
    {
        $profile = SchoolProfile::first(['address', 'email', 'phone_number', 'map_url']);
        return view('pages.frontend.contact.index', compact('profile'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($request->all());

        return redirect()->route('contact.index')->with('success', 'Pesan Anda telah berhasil dikirim. Terima kasih!');
    }
}
