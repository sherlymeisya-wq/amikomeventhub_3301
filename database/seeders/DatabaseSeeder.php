<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Event;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Utama
       User::firstOrCreate(
    ['email' => 'admin@amikom.ac.id'],
    [
        'name' => 'Admin Amikom',
        'password' => bcrypt('password'),
    ]
);

        // 2. Insert Kategori Event
       $category = Category::firstOrCreate(
    ['slug' => 'seminar-it'],
    ['name' => 'Seminar IT']
);

$category2 = Category::firstOrCreate(
    ['slug' => 'entertaiment'],
    ['name' => 'Entertaiment']
);

        // 3. Insert Sampel Events
        Event::updateOrCreate(
            ['title' => 'Jazz Night 2025'],
            [
                'category_id' => $category2->id,
                'description' => 'Nikmati malam yang indah dengan alunan musik jazz yang merdu.',
                'date' => '2026-05-10 19:00:00',
                'location' => 'Amikom Baru',
                'price' => 50000,
                'stock' => 100,
                'poster_path' => 'assets/concert.png',
            ]
        );

        Event::updateOrCreate(
            ['title' => 'Hackaton - Unleash Your Inner Developer'],
            [
                'category_id' => $category->id,
                'description' => 'Ayo asah skill coding kamu dan ciptakan solusi inovatif untuk tantangan masa depan!',
                'date' => '2026-05-05 10:00:00',
                'location' => 'Inkubator Amikom',
                'price' => 50000,
                'stock' => 100,
                'poster_path' => 'assets/hackathon.png',
            ]
        );

        Event::updateOrCreate(
            ['title' => 'AI & FUTURE TECH SUMMIT 2026'],
            [
                'category_id' => $category->id,
                'description' => 'Jelajahi tren terkini dalam kecerdasan buatan dan teknologi masa depan bersama para ahli di bidangnya.',
                'date' => '2026-05-01 13:00:00',
                'location' => 'Cinema Unit 6',
                'price' => 50000,
                'stock' => 100,
                'poster_path' => 'assets/workshop.png',
            ]
        );

        // 4. Insert Partners
        $this->call(PartnerSeeder::class);
    }
}