<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|min:10|max:1000',
        ]);

        // FIX: Definisikan variabel $user di awal method
        $user = Auth::user();

        if (!$user->hasBorrowed($book)) {
            return back()->with('error', 'Anda hanya bisa memberi ulasan pada buku yang pernah Anda pinjam.');
        }

        // Gunakan updateOrCreate untuk membuat atau mengedit ulasan yang ada
        $book->comments()->updateOrCreate(
            [
                'user_id' => $user->id, // Kondisi pencarian
                'book_id' => $book->id,
            ],
            [
                'rating' => $request->rating, // Data untuk di-update atau di-create
                'content' => $request->content,
            ]
        );

        // Mencatat aktivitas menggunakan variabel $user yang sudah didefinisikan
        ActivityLog::create([
            'user_id' => $user->id,
            'type' => 'review_created',
            'description' => $user->name . ' memberikan ulasan pada buku "' . $book->title . '".'
        ]);

        return back()->with('success', 'Terima kasih, ulasan Anda berhasil disimpan!');
    }
}
