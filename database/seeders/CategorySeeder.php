<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Novel',
            'slug' => 'novel',
        ]);

        Category::create([
            'name' => 'Sejarah',
            'slug' => 'sejarah',
        ]);

        Category::create([
            'name' => 'Komputer & Teknologi',
            'slug' => 'komputer-teknologi',
        ]);
    }
}