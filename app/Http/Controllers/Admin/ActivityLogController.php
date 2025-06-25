<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil log terbaru, memuat relasi user untuk efisiensi,
        // dan menggunakan paginasi.
        $logs = ActivityLog::with('user')
                           ->latest()
                           ->paginate(15); // Tampilkan 15 log per halaman

        return view('admin.activity_logs.index', compact('logs'));
    }
}
