<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Wishlist;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor untuk mahasiswa.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // Query final yang efisien dengan eager loading
        $activeBorrows = Borrowing::where('user_id', $user->id)
                                  ->whereNull('returned_at')
                                  ->with('book.author') // Memuat relasi book DAN author di dalam book
                                  ->latest()
                                  ->get();

        // Mengambil data statistik
        $stats = [
            'active_borrowings' => $activeBorrows->count(),
            'wishlist_count'    => Wishlist::where('user_id', $user->id)->count(),
            'borrowing_history' => Borrowing::where('user_id', $user->id)->count(),
        ];

        // Mengambil data rekomendasi buku, lengkap dengan penulisnya
        $recommendations = Book::with('author')->inRandomOrder()->take(3)->get();

        // Mengirim semua data ke view
        return view('mahasiswa.dashboard', compact(
            'activeBorrows',
            'stats',
            'recommendations'
        ));
    }
}
