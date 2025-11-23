<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KaryawanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'karyawan@gmail.com'],
            [
                'name' => 'karyawan',
                'password' => Hash::make('12345')
            ]
        );
        $user->assignRole('karyawan');
    }
}
