<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan kolom rating ke tabel comments
        Schema::table('comments', function (Blueprint $table) {
            $table->tinyInteger('rating')->after('book_id')->nullable()->comment('Rating from 1 to 5');
            $table->unique(['user_id', 'book_id']); // Pastikan setiap user hanya bisa 1 ulasan per buku
        });

        // Hapus tabel ratings yang lama
        Schema::dropIfExists('ratings');
    }

    public function down(): void
    {
        // Logika untuk rollback jika diperlukan
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('rating');
            $table->dropUnique(['user_id', 'book_id']);
        });

        // Buat kembali tabel ratings jika di-rollback
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('rating');
            $table->timestamps();
            $table->unique(['user_id', 'book_id']);
        });
    }
};
