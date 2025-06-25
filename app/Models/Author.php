<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        // Tambahkan kolom lain yang relevan untuk penulis jika ada,
        // misalnya: 'bio', 'birth_date', dll.
    ];

    /**
     * Mendefinisikan relasi "hasMany" ke model Book.
     * Satu penulis bisa memiliki banyak buku.
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}