<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::truncate();

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
