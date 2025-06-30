<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Hapus kolom 'author' yang lama jika ada
            if (Schema::hasColumn('books', 'author')) {
                $table->dropColumn('author');
            }

            // Tambahkan kolom 'author_id' yang baru sebagai foreign key
            // Pastikan ini ditambahkan setelah kolom 'title' atau di posisi yang sesuai
            if (!Schema::hasColumn('books', 'author_id')) {
                $table->foreignId('author_id')->after('title')->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Logika untuk mengembalikan perubahan jika diperlukan
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
            $table->string('author');
        });
    }
};