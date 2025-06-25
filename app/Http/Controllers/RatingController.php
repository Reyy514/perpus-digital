<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Cek apakah user sudah pernah meminjam buku ini
        if (!Auth::user()->hasBorrowed($book)) {
            return back()->with('error', 'Anda hanya bisa memberi rating pada buku yang pernah Anda pinjam.');
        }

        // Gunakan updateOrCreate untuk handle rating baru atau update rating lama
        $book->ratings()->updateOrCreate(
            [
                'user_id' => Auth::id(), // Kondisi pencarian
            ],
            [
                'rating' => $request->rating, // Data untuk di-update atau di-create
            ]
        );

        return back()->with('success', 'Terima kasih, rating Anda berhasil disimpan!');
    }
}