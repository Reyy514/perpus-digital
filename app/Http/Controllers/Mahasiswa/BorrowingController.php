<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the user's borrowings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil peminjaman yang masih aktif (returned_at IS NULL)
        $activeBorrowings = Borrowing::where('user_id', $userId)
            ->whereNull('returned_at')
            ->with('book.author') // Eager load untuk efisiensi
            ->latest('borrowed_at')
            ->get();

        // 2. Ambil riwayat peminjaman (returned_at IS NOT NULL)
        $historyBorrowings = Borrowing::where('user_id', $userId)
            ->whereNotNull('returned_at')
            ->with('book.author')
            ->latest('returned_at')
            ->paginate(10); // Gunakan paginasi untuk riwayat

        // 3. Kirim kedua koleksi data ke view
        return view('mahasiswa.borrowings.index', compact(
            'activeBorrowings',
            'historyBorrowings'
        ));
    }
}