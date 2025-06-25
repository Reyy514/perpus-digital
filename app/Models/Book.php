<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author; // Pastikan kelas Author diimpor
use App\Models\Category;
use App\Models\Comment;
use App\Models\Borrowing;
use App\Models\Wishlist;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id', // Menggunakan author_id sebagai foreign key
        'category_id',
        'description',
        'cover_image_url',
        'stock',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model Author.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    
    public function averageRating()
    {
        return $this->comments()->avg('rating');
    }
}