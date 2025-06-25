<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $booksQuery = Book::with('category');

        // Terapkan filter pencarian jika ada
        if ($request->filled('search')) {
            $search = $request->input('search');
            $booksQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      // FIX: Mengubah pencarian dari relasi ke kolom 'author' langsung
                      ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Terapkan filter kategori jika ada
        if ($request->filled('category')) {
            $booksQuery->where('category_id', $request->input('category'));
        }

        $books = $booksQuery->latest()->paginate(12);

        return view('mahasiswa.books.index', compact('books', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // FIX: Menghapus pemanggilan relasi 'author' yang tidak ada
        $book->load(['category', 'comments.user']);

        // Mengambil buku terkait dari kategori yang sama
        $relatedBooks = Book::where('category_id', $book->category_id)
                            ->where('id', '!=', $book->id)
                            ->inRandomOrder()
                            ->take(4)
                            ->get();

        return view('mahasiswa.books.show', compact('book', 'relatedBooks'));
    }
}