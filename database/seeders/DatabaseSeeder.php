<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
public function run(): void
{
    // users
    \App\Models\User::create([
        'name' => 'Admin Amikom',
        'email' => 'admin@amikom.ac.id',
        'password' => bcrypt('password'),
        'role' => 'admin',
    ]);

    // kategori
    $kategori1 = \App\Models\Category::create([
        'name' => 'UI/UX Masterclass',
        'slug' => 'ui-ux-masterclass',
    ]);

    $kategori2 = \App\Models\Category::create([
        'name' => 'E-Sport',
        'slug' => 'e-sport',
    ]);

    $kategori3 = \App\Models\Category::create([
        'name' => 'Seminar IT',
        'slug' => 'seminar-it',
    ]);

    // 6 event
}
}