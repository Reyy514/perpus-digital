<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException; // Pastikan ini diimpor

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
        // 1. Lakukan autentikasi email & password seperti biasa
        $request->authenticate();

        // --- BLOK LOGIKA BARU UNTUK MEMERIKSA STATUS ---
        // 2. Ambil pengguna yang baru saja diautentikasi
        $user = Auth::user();

        // 3. Cek apakah status pengguna adalah 'suspended'
        if ($user->status === 'suspended') {
            // Jika ya, segera logout pengguna
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Lemparkan ValidationException untuk menampilkan pesan error di halaman login
            throw ValidationException::withMessages([
                'email' => __('Akun Anda telah ditangguhkan. Silakan hubungi administrator.'),
            ]);
        }
        // --- AKHIR BLOK LOGIKA BARU ---

        // 4. Jika status aman, lanjutkan proses login seperti biasa
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
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