<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dari kategori yang sudah kita buat
        $novelCategory = Category::where('slug', 'novel')->first();
        $sejarahCategory = Category::where('slug', 'sejarah')->first();

        Book::create([
            'title' => 'Laskar Pelangi',
            'author' => 'Andrea Hirata',
            'category_id' => $novelCategory->id, // Gunakan category_id
            'description' => 'Sebuah novel inspiratif tentang perjuangan anak-anak di Belitung untuk mendapatkan pendidikan.',
            'cover_image_url' => null, // Biarkan null agar kita bisa test upload
            'stock' => 5,
        ]);

        Book::create([
            'title' => 'Bumi Manusia',
            'author' => 'Pramoedya Ananta Toer',
            'category_id' => $sejarahCategory->id, // Gunakan category_id
            'description' => 'Kisah Minke di tengah pusaran politik dan cinta pada awal abad ke-20.',
            'cover_image_url' => null,
            'stock' => 3,
        ]);

        Book::create([
            'title' => 'Cantik Itu Luka',
            'author' => 'Eka Kurniawan',
            'category_id' => $novelCategory->id, // Gunakan category_id
            'description' => 'Sebuah epik yang memadukan sejarah, mitos, dan drama keluarga.',
            'cover_image_url' => null,
            'stock' => 0,
        ]);
    }
}