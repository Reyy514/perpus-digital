<?php

namespace App\Http\Controllers; // Asumsi ini adalah controller untuk Mahasiswa

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Menampilkan daftar semua buku untuk mahasiswa.
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        
        // Memulai query dengan eager loading relasi author dan category
        $booksQuery = Book::with(['category', 'author']);

        // Terapkan filter pencarian jika ada
        if ($request->filled('search')) {
            $search = $request->input('search');
            
            // FIX: Mengubah query pencarian agar sesuai dengan struktur relasional
            $booksQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhereHas('author', function ($q) use ($search) {
                          // Mencari di dalam tabel 'authors' melalui relasi 'author'
                          $q->where('name', 'like', "%{$search}%");
                      });
            });
        }

        // Terapkan filter kategori jika ada
        if ($request->filled('category')) {
            // Asumsi 'category' yang dikirim dari form adalah ID kategori
            $booksQuery->where('category_id', $request->input('category'));
        }

        $books = $booksQuery->latest()->paginate(12);

        return view('mahasiswa.books.index', compact('books', 'categories'));
    }

    /**
     * Menampilkan detail buku untuk mahasiswa.
     */
    public function show(Book $book)
    {
        // FIX: Memuat relasi 'author' karena sekarang sudah ada dan valid
        $book->load(['category', 'author', 'comments.user']);

        // Mengambil buku terkait dari kategori yang sama
        $relatedBooks = Book::where('category_id', $book->category_id)
                            ->where('id', '!=', $book->id)
                            ->with('author') // Muat juga author untuk buku terkait
                            ->inRandomOrder()
                            ->take(4)
                            ->get();

        return view('mahasiswa.books.show', compact('book', 'relatedBooks'));
    }
}
