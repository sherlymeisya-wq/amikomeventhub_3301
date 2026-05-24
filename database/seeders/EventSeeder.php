<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Category;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::truncate();

        $musik = Category::where('slug', 'musik')->first();
        $workshop = Category::where('slug', 'workshop')->first();
        $hackathon = Category::where('slug', 'hackathon')->first();

        Event::create([
            'category_id' => $musik->id,
            'title' => 'Jazz Night 2024',
            'description' => 'Nikmati malam musik jazz spektakuler bersama musisi terbaik kampus.',
            'date' => now()->addWeeks(2),
            'location' => 'Auditorium Amikom',
            'price' => 150000,
            'stock' => 100,
            'poster_path' => 'assets/concert.png',
        ]);

        Event::create([
            'category_id' => $workshop->id,
            'title' => 'AI & Future Workshop',
            'description' => 'Belajar teknologi AI dan persiapkan diri untuk karier masa depan.',
            'date' => now()->addWeeks(4),
            'location' => 'Ruangan Workshop 3',
            'price' => 50000,
            'stock' => 50,
            'poster_path' => 'assets/workshop.png',
        ]);

        Event::create([
            'category_id' => $hackathon->id,
            'title' => 'Hackathon 2026',
            'description' => 'Bersaing dan buat solusi digital dalam 48 jam penuh tantangan.',
            'date' => now()->addWeeks(6),
            'location' => 'Lab Komputer Amikom',
            'price' => 100000,
            'stock' => 80,
            'poster_path' => 'assets/hackathon.png',
        ]);
    }
}
