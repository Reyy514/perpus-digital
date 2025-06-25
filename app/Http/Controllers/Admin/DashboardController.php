<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\User;
use App\Models\ActivityLog; // Pastikan Anda memiliki dan mengimpor model ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mengambil data statistik
        $stats = [
            'total_books' => Book::count(),
            'active_borrowings' => Borrowing::whereNull('returned_at')->count(),
            'active_users' => User::where('role', 'mahasiswa')->count(),
            'total_categories' => Category::count(),
        ];

        // 2. Mengambil data untuk grafik peminjaman 7 hari terakhir
        $borrowingsChart = Borrowing::select(
                DB::raw('DATE(borrowed_at) as date'),
                DB::raw('count(*) as count')
            )
            ->where('borrowed_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('count', 'date');
            
        // Siapkan data untuk 7 hari, isi 0 jika tidak ada peminjaman
        $chartData = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartData[$date] = $borrowingsChart->get($date, 0);
        }
        
        // 3. Mengambil aktivitas terbaru (misal: 5 aktivitas terakhir)
        $recentActivities = ActivityLog::with('user')->latest()->take(5)->get();

        // 4. Mengirim semua data ke view
        return view('admin.dashboard', compact(
            'stats',
            'chartData',
            'recentActivities'
        ));
    }
}
