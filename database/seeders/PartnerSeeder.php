<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        Partner::create([
            'name'=>'Kecap Bango',
            'logo_url'=>'https://warindo.de/wp-content/uploads/2021/02/Kecap-Bango-520ml.jpg'
        ]);

        Partner::create([
            'name'=>'Coca-Cola',
            'logo_url'=>'https://upload.wikimedia.org/wikipedia/commons/c/ce/Coca-Cola_logo.svg'
        ]);

        Partner::create([
            'name'=>'Indomie',
            'logo_url'=>'https://upload.wikimedia.org/wikipedia/commons/3/35/Indomie-Logo.png'
        ]);

        Partner::create([
            'name'=>'Gudang Garam',
            'logo_url'=>'https://upload.wikimedia.org/wikipedia/id/4/48/Gudang_Garam_logo.png'
        ]);
    }
}