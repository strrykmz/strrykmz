<?php

namespace Database\Seeders;

use App\Models\KategoriUser;
use Illuminate\Database\Seeder;

class KategoriUserSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = ['Member', 'VIP', 'Admin', 'Operator'];

        foreach ($kategori as $kat) {
            KategoriUser::create(['nama_kategori' => $kat]);
        }
    }
}