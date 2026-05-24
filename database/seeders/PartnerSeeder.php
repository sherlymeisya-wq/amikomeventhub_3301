<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partner::create([
            'name' => 'Kecap Bango',
            'logo_url' => 'https://warindo.de/wp-content/uploads/2021/02/Kecap-Bango-520ml.jpg',
        ]);

        Partner::create([
            'name' => 'Coca-Cola',
            'logo_url' => 'https://www.coca-cola.co.id/themes/coca-cola/logo.png',
        ]);

        Partner::create([
            'name' => 'Indomie',
            'logo_url' => 'https://indomie.id/images/logo.png',
        ]);

        Partner::create([
            'name' => 'Gudang Garam',
            'logo_url' => 'https://www.gudanggaram.com/static/images/logo.png',
        ]);
    }
}
