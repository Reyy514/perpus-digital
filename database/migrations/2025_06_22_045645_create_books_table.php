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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            
            // FIX: Tambahkan kolom 'slug' yang dibutuhkan oleh Seeder dan Controller
            $table->string('slug')->unique(); 
            
            // Kolom ini akan dimodifikasi oleh migrasi berikutnya, 
            // jadi untuk sementara didefinisikan sebagai string biasa.
            $table->string('author'); 
            
            // Kolom ini juga akan ditambahkan dan dihapus oleh migrasi lain.
            // Biarkan seperti ini agar urutan migrasi Anda tetap valid.
            $table->string('category')->nullable();
            
            $table->text('description')->nullable();
            $table->string('cover_image_url')->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
