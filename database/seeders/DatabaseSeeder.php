<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
// Hapus baris ini karena tidak digunakan:
// use App\Models\SuratMasuk;

// Tetap gunakan SuratKeluarSeeder
use Database\Seeders\SuratKeluarSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Admin default
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('12345'), // Ganti sesuai kebutuhan
            ]
        );

        // // Akun User biasa (opsional)
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(SuratKeluarSeeder::class);
        // $this->call(SuratMasukSeeder::class);
        // $this->call(AdminUserSeeder::class);

    }
}