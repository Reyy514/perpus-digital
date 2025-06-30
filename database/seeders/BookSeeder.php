<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil atau buat Kategori yang dibutuhkan
        // Pastikan CategorySeeder sudah dijalankan sebelumnya atau buat di sini
        $novelCategory = Category::firstOrCreate(['name' => 'Novel', 'slug' => 'novel']);
        $sejarahCategory = Category::firstOrCreate(['name' => 'Sejarah', 'slug' => 'sejarah']);
        $selfHelpCategory = Category::firstOrCreate(['name' => 'Self-Help', 'slug' => 'self-help']);
        $fantasiCategory = Category::firstOrCreate(['name' => 'Fantasi', 'slug' => 'fantasi']);
        $biografiCategory = Category::firstOrCreate(['name' => 'Biografi', 'slug' => 'biografi']);
        $psikologiCategory = Category::firstOrCreate(['name' => 'Psikologi', 'slug' => 'psikologi']);

        // 2. Buat data Penulis terlebih dahulu
        $authorAndrea = Author::firstOrCreate(['name' => 'Andrea Hirata']);
        $authorPramoedya = Author::firstOrCreate(['name' => 'Pramoedya Ananta Toer']);
        $authorEka = Author::firstOrCreate(['name' => 'Eka Kurniawan']);
        $authorTere = Author::firstOrCreate(['name' => 'Tere Liye']);
        $authorMark = Author::firstOrCreate(['name' => 'Mark Manson']);
        $authorRowling = Author::firstOrCreate(['name' => 'J.K. Rowling']);
        $authorWalter = Author::firstOrCreate(['name' => 'Walter Isaacson']);
        $authorJames = Author::firstOrCreate(['name' => 'James Clear']);
        $authorHarari = Author::firstOrCreate(['name' => 'Yuval Noah Harari']);

        // 3. Siapkan data Buku yang akan dibuat
        $books = [
            ['title' => 'Laskar Pelangi', 'author_id' => $authorAndrea->id, 'category_id' => $novelCategory->id, 'description' => 'Sebuah novel inspiratif tentang perjuangan anak-anak di Belitung.', 'stock' => 5],
            ['title' => 'Bumi Manusia', 'author_id' => $authorPramoedya->id, 'category_id' => $sejarahCategory->id, 'description' => 'Kisah Minke di tengah pusaran politik dan cinta pada awal abad ke-20.', 'stock' => 3],
            ['title' => 'Cantik Itu Luka', 'author_id' => $authorEka->id, 'category_id' => $novelCategory->id, 'description' => 'Sebuah epik yang memadukan sejarah, mitos, dan drama keluarga.', 'stock' => 4],
            ['title' => 'Rindu', 'author_id' => $authorTere->id, 'category_id' => $novelCategory->id, 'description' => 'Kisah perjalanan panjang sebuah kerinduan, menempuh perjalanan haji di masa lalu.', 'stock' => 8],
            ['title' => 'Steve Jobs', 'author_id' => $authorWalter->id, 'category_id' => $biografiCategory->id, 'description' => 'Biografi mendalam tentang salah satu inovator paling berpengaruh.', 'stock' => 4],
            ['title' => 'Sebuah Seni untuk Bersikap Bodo Amat', 'author_id' => $authorMark->id, 'category_id' => $selfHelpCategory->id, 'description' => 'Pendekatan yang berlawanan dengan intuisi untuk menjalani kehidupan yang lebih baik.', 'stock' => 10],
            ['title' => 'Atomic Habits', 'author_id' => $authorJames->id, 'category_id' => $selfHelpCategory->id, 'description' => 'Cara mudah dan terbukti untuk membangun kebiasaan baik.', 'stock' => 12],
            ['title' => 'Harry Potter and the Sorcerer\'s Stone', 'author_id' => $authorRowling->id, 'category_id' => $fantasiCategory->id, 'description' => 'Kisah seorang anak laki-laki yang mengetahui bahwa dia adalah seorang penyihir.', 'stock' => 9],
            ['title' => 'Sapiens: Riwayat Singkat Umat Manusia', 'author_id' => $authorHarari->id, 'category_id' => $sejarahCategory->id, 'description' => 'Sebuah penelusuran provokatif tentang bagaimana Homo Sapiens berhasil mendominasi planet ini.', 'stock' => 6],
        ];

        // 4. Loop melalui data dan buat entri buku
        foreach ($books as $bookData) {
            Book::updateOrCreate(
                ['title' => $bookData['title']],
                [
                    'author_id' => $bookData['author_id'],
                    'category_id' => $bookData['category_id'],
                    'slug' => Str::slug($bookData['title']),
                    'description' => $bookData['description'],
                    'stock' => $bookData['stock'],
                    'cover_image_url' => null,
                ]
            );
        }
    }
}
