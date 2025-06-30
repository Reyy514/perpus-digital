<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
    
        // SOLUSI: Menggunakan ->paginate()
        $activeBorrowings = Borrowing::where('user_id', $userId)
            ->whereNull('returned_at')
            ->with('book.author')
            ->latest('borrowed_at')
            ->paginate(5, ['*'], 'aktif'); // Menghasilkan Paginator
    
        // SOLUSI: Menggunakan ->paginate()
        $historyBorrowings = Borrowing::where('user_id', $userId)
            ->whereNotNull('returned_at')
            ->with('book.author')
            ->latest('returned_at')
            ->paginate(10, ['*'], 'riwayat'); // Menghasilkan Paginator
    
        return view('mahasiswa.borrowings.index', compact(
            'activeBorrowings',
            'historyBorrowings'
        ));
    }

    public function store(Request $request, Book $book)
    {
        $user = Auth::user();

        if ($book->stock < 1) {
            return back()->with('error', 'Maaf, stok buku ini sudah habis.');
        }
        if ($user->isCurrentlyBorrowing($book)) {
            return back()->with('error', 'Anda sudah sedang meminjam buku ini.');
        }

        ActivityLog::create([
            'user_id' => $user->id,
            'type' => 'book_borrowed',
            'description' => $user->name . ' meminjam buku "' . $book->title . '".'
        ]);

        $book->decrement('stock');
        $user->borrowings()->create([
            'book_id' => $book->id,
            'due_at' => Carbon::now()->addDays(7), // Batas peminjaman 7 hari
        ]);

        return redirect()->route('mahasiswa.borrowings.index')->with('success', 'Buku berhasil dipinjam!');
    }
}
