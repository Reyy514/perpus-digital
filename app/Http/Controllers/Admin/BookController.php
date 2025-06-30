<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author; // Pastikan model Author diimpor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Menampilkan daftar semua buku dengan fungsionalitas pencarian.
     */
    public function index(Request $request)
    {
        $query = Book::with(['category', 'author']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhereHas('author', fn($q) => $q->where('name', 'like', "%{$search}%"));
        }

        $books = $query->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Menampilkan form untuk membuat buku baru.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        // Data $authors tidak perlu dikirim karena kita menggunakan input teks
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Menyimpan buku baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'author' => 'required|string|max:255', // Menerima nama penulis sebagai teks
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Cari atau buat penulis baru berdasarkan nama yang diinput
        $author = Author::firstOrCreate(['name' => $validated['author']]);
        
        // Siapkan data untuk disimpan ke model Book
        $bookData = $validated;
        $bookData['author_id'] = $author->id; // Ganti 'author' dengan 'author_id'
        unset($bookData['author']); // Hapus 'author' karena tidak ada di tabel books

        $bookData['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('cover_image')) {
            $bookData['cover_image_url'] = $request->file('cover_image')->store('book_covers', 'public');
        }

        Book::create($bookData);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }
    
    /**
     * Menampilkan detail dari satu buku.
     */
    public function show(Book $book)
    {
        // Memuat relasi untuk ditampilkan di halaman detail
        $book->load(['category', 'author']);
        return view('admin.books.show', compact('book'));
    }

    /**
     * Menampilkan form untuk mengedit buku.
     * Tidak perlu mengirim $authors karena view sudah diubah menggunakan input teks.
     */
    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        // Tidak ada variabel $authors yang dikirim, sesuai dengan perbaikan
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Memperbarui data buku di database.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books,title,' . $book->id,
            'author' => 'required|string|max:255', // Menerima nama penulis sebagai teks
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        
        // Logika yang sama dengan 'store': Cari atau buat penulis baru
        $author = Author::firstOrCreate(['name' => $validated['author']]);

        $bookData = $validated;
        $bookData['author_id'] = $author->id;
        unset($bookData['author']);

        $bookData['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama jika ada sebelum mengunggah yang baru
            if ($book->cover_image_url) {
                Storage::disk('public')->delete($book->cover_image_url);
            }
            $bookData['cover_image_url'] = $request->file('cover_image')->store('book_covers', 'public');
        }

        $book->update($bookData);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Menghapus buku dari database.
     */
    public function destroy(Book $book)
    {
        if ($book->cover_image_url) {
            Storage::disk('public')->delete($book->cover_image_url);
        }
        $book->delete();
        return back()->with('success', 'Buku berhasil dihapus.');
    }
}