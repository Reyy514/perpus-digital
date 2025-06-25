<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category; // Pastikan Anda mengimpor model Category
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // FIX: Mengambil semua kategori untuk dikirim ke view
        $categories = Category::orderBy('name')->get();

        // Memulai query builder untuk model Book
        $booksQuery = Book::with(['category', 'author']);

        // Menerapkan filter PENCARIAN jika ada input 'search'
        if ($request->filled('search')) {
            $search = $request->input('search');
            $booksQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhereHas('author', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            });
        }

        // Menerapkan filter KATEGORI jika ada input 'category'
        if ($request->filled('category')) {
            $booksQuery->where('category_id', $request->input('category'));
        }

        // Mengambil hasil dengan paginasi
        $books = $booksQuery->latest()->paginate(12);

        // Mengirim data buku DAN kategori ke view
        return view('mahasiswa.books.index', compact('books', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View
     */
    public function show(Book $book)
    {
        // Eager load relasi untuk efisiensi
        $book->load(['category', 'author', 'comments.user']);
        
        return view('mahasiswa.books.show', compact('book'));
    }
}