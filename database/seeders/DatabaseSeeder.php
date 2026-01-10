<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Jalankan Seeder Kategori DULUAN agar ID-nya tersedia
        $this->call([
            KategoriUserSeeder::class,
        ]);

        // 2. User::factory(10)->create(); // Hapus atau komentar baris ini jika error, atau tambahkan state

        // 3. Perbaiki pembuatan User Test default
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'kategori_user_id' => 1, // <--- TAMBAHKAN BARIS INI (Pastikan ID 1 ada di tabel kategori)
        ]);
    }
}