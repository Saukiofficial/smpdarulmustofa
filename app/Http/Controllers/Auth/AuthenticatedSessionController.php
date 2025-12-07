<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        // Cek jika user punya role 'admin'
        if ($user->roles()->where('name', 'admin')->exists()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // Cek jika user punya role 'guru'
        if ($user->roles()->where('name', 'guru')->exists()) {
            // Anda perlu membuat rute ini nanti
            // return redirect()->intended(route('guru.dashboard'));
            return redirect('/guru/dashboard');
        }

        // Cek jika user punya role 'siswa'
        if ($user->roles()->where('name', 'siswa')->exists()) {
            // Anda perlu membuat rute ini nanti
            // return redirect()->intended(route('siswa.dashboard'));
            return redirect('/siswa/dashboard');
        }

        // Redirect default untuk user biasa (tanpa role spesifik)
        // atau jika rute role belum ada. Ini akan mengarah ke rute 'dashboard.user'
        // yang sudah kita definisikan di web.php
        return redirect()->intended(route('dashboard.user'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
