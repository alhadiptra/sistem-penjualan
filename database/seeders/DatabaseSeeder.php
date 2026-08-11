<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Owner
        User::create([
            'name' => 'Pemilik Usaha',
            'username' => 'owner',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        // Buat Admin
        User::create([
            'name' => 'Admin Utama',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Buat Customer
        User::create([
            'name' => 'Pelanggan',
            'username' => 'customer',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // Buat Kategori
        Category::create([
            'nama_kategori' => 'Premium',
            'deskripsi' => 'Mochi dengan bahan pilihan dan isian premium'
        ]);

        Category::create([
            'nama_kategori' => 'Reguler',
            'deskripsi' => 'Mochi standar dengan rasa klasik'
        ]);
    }
}
