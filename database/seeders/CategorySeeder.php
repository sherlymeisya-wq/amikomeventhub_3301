<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk bisa menjalankan perintah SQL mentah

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan pengecekan foreign key agar tabel bisa dikosongkan (di-truncate)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2. Kosongkan tabel categories sebelum mengisi data baru
        Category::truncate();

        // 3. Nyalakan kembali pengecekan foreign key demi keamanan relasi database
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 4. Proses input data kategori
        Category::create([
            'name' => 'Musik',
            'slug' => 'musik',
        ]);

        Category::create([
            'name' => 'Workshop',
            'slug' => 'workshop',
        ]);

        Category::create([
            'name' => 'Hackathon',
            'slug' => 'hackathon',
        ]);
    }
}
