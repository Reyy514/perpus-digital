<?php

namespace App\Http\Controllers; // Sesuaikan dengan namespace Anda jika berbeda

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Book; // FIX: Menambahkan impor untuk model Book
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // FIX: Menggunakan ->paginate() untuk menghasilkan objek Paginator
        // Ini akan membuat method ->links() di view berfungsi.
        $wishlistItems = Wishlist::where('user_id', Auth::id())
            ->with('book.author', 'book.category') // Eager load untuk efisiensi
            ->latest()
            ->paginate(12); // Tampilkan 12 item per halaman

        return view('mahasiswa.wishlist.index', compact('wishlistItems'));
    }

    /**
     * Store a new item in the wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Book $book)
    {
        Auth::user()->wishlists()->firstOrCreate(['book_id' => $book->id]);
        return back()->with('success', 'Buku berhasil ditambahkan ke wishlist.');
    }

    /**
     * Remove the specified item from the wishlist.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        Auth::user()->wishlists()->where('book_id', $book->id)->delete();
        return back()->with('success', 'Buku berhasil dihapus dari wishlist.');
    }
}