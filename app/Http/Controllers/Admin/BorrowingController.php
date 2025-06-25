<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BorrowingsExport;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['user', 'book']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $status = $request->input('status');
            // FIX: Mengganti 'due_date' menjadi 'due_at'
            if ($status == 'active') {
                $query->whereNull('returned_at')->where('due_at', '>=', now());
            } elseif ($status == 'overdue') {
                $query->whereNull('returned_at')->where('due_at', '<', now());
            } elseif ($status == 'returned') {
                $query->whereNotNull('returned_at');
            }
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('book', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            })->orWhereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        
        $borrowings = $query->latest('borrowed_at')->paginate(10);

        return view('admin.borrowings.index', compact('borrowings'));
    }

    public function returnBook(Borrowing $borrowing)
    {
        // Tandai buku telah dikembalikan
        $borrowing->update(['returned_at' => now()]);
        
        // Tambah stok buku kembali
        $borrowing->book()->increment('stock');

        return back()->with('success', 'Buku telah ditandai sebagai dikembalikan.');
    }

    public function exportPdf()
    {
        $borrowings = Borrowing::with(['user', 'book'])->get();
        $pdf = Pdf::loadView('admin.borrowings.pdf', compact('borrowings'));
        return $pdf->download('laporan-peminjaman-'.now()->format('d-m-Y').'.pdf');
    }


    public function exportExcel()
    {
        return Excel::download(new BorrowingsExport, 'laporan-peminjaman.xlsx');
    }
}
