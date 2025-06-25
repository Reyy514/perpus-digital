<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

// --- Controller untuk Mahasiswa ---
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;

// --- Controller untuk Admin (dengan alias agar tidak bentrok) ---
use App\Http\Controllers\Admin\ActivityLogController as AdminActivityLogController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Di sini kita mendaftarkan semua rute untuk aplikasi kita.
*/

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute dashboard utama, akan mengarahkan user berdasarkan role setelah login
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('mahasiswa.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// --- GRUP UNTUK SEMUA USER YANG SUDAH LOGIN ---
Route::middleware('auth')->group(function () {
    
    // Rute untuk manajemen profil pengguna (bisa diakses semua role)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- GRUP RUTE KHUSUS MAHASISWA ---
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
        
        // Fitur Buku
        Route::get('/books', [BookController::class, 'index'])->name('books.index');
        Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

        // Fitur Peminjaman
        Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');
        Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('books.borrow');
        
        // Fitur Wishlist
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist/{book}', [WishlistController::class, 'store'])->name('wishlist.store');
        Route::delete('/wishlist/{book}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
        
        // Fitur Interaksi (Komentar & Rating)
        Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    });

    // --- GRUP RUTE KHUSUS ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Fitur CRUD (Create, Read, Update, Delete)
        Route::resource('books', AdminBookController::class);
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        Route::resource('comments', AdminCommentController::class)->only(['index', 'destroy']);

        // Fitur Manajemen User
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::patch('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle_status');

        // Fitur Manajemen Peminjaman & Laporan
        Route::get('/borrowings', [AdminBorrowingController::class, 'index'])->name('borrowings.index');
        Route::patch('/borrowings/{borrowing}/return', [AdminBorrowingController::class, 'returnBook'])->name('borrowings.return');
        Route::get('/borrowings/export/excel', [AdminBorrowingController::class, 'exportExcel'])->name('borrowings.export.excel');
        Route::get('/borrowings/export/pdf', [AdminBorrowingController::class, 'exportPdf'])->name('borrowings.export.pdf');

        // Fitur Log Aktivitas
        Route::get('/activity-logs', [AdminActivityLogController::class, 'index'])->name('activity_logs.index');
    });
});

// Memuat rute untuk autentikasi (login, register, dll.) dari Laravel Breeze
require __DIR__.'/auth.php';
