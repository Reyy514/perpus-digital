<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate(['content' => 'required|string|min:10']);

        if (!Auth::user()->hasBorrowed($book)) {
            return back()->with('error', 'Anda hanya bisa mengomentari buku yang pernah Anda pinjam.');
        }

        $book->comments()->create([
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id, // Untuk balasan
            'content' => $request->content,
        ]);

        return back()->with('success', 'Komentar Anda berhasil dipublikasikan.');
    }
}