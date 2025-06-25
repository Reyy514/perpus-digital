<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status', // Ditambahkan untuk fitur suspend
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Cek apakah user memiliki peran 'admin'.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // --- RELASI ---

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // --- HELPER METHODS ---

    public function hasInWishlist(Book $book): bool
    {
        return $this->wishlists()->where('book_id', $book->id)->exists();
    }

    public function isCurrentlyBorrowing(Book $book): bool
    {
        return $this->borrowings()
                    ->where('book_id', $book->id)
                    ->whereNull('returned_at')
                    ->exists();
    }

    public function hasBorrowed(Book $book): bool
    {
        return $this->borrowings()->where('book_id', $book->id)->exists();
    }
}
