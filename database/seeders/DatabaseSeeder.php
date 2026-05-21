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

    \App\Models\User::create([
        'name' => 'Revalia',
        'email' => 'reva@gmail.com',
        'password' => bcrypt('12345678'),
        'role' => 'user',
    ]);

    \App\Models\User::create([
        'name' => 'Zalzabila',
        'email' => 'Zaza@gmail.com',
        'password' => bcrypt('12345678'),
        'role' => 'user',
    ]);

    \App\Models\User::create([
        'name' => 'Andriana',
        'email' => 'Andriana@gmail.com',
        'password' => bcrypt('12345678'),
        'role' => 'user',
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
    \App\Models\Event::create([
        'category_id' => $kategori1->id,
        'title' => 'Figma Design Bootcamp',
        'description' => 'Belajar desain UI modern.',
        'date' => '2026-05-01 09:00:00',
        'location' => 'Lab 1',
        'price' => 50000,
        'stock' => 50,
        'poster_path' => 'posters/event1.png',
    ]);

    \App\Models\Event::create([
        'category_id' => $kategori1->id,
        'title' => 'UX Research Workshop',
        'description' => 'Belajar riset pengguna.',
        'date' => '2026-05-02 10:00:00',
        'location' => 'Lab 2',
        'price' => 60000,
        'stock' => 40,
        'poster_path' => 'posters/event2.png',
    ]);

    \App\Models\Event::create([
        'category_id' => $kategori2->id,
        'title' => 'Mobile Legends Tournament',
        'description' => 'Turnamen antar mahasiswa.',
        'date' => '2026-05-03 13:00:00',
        'location' => 'Hall A',
        'price' => 30000,
        'stock' => 100,
        'poster_path' => 'posters/event3.png',
    ]);

    \App\Models\Event::create([
        'category_id' => $kategori2->id,
        'title' => 'Valorant Campus Cup',
        'description' => 'Kompetisi e-sport kampus.',
        'date' => '2026-05-04 14:00:00',
        'location' => 'Hall B',
        'price' => 30000,
        'stock' => 100,
        'poster_path' => 'posters/event4.png',
    ]);

    \App\Models\Event::create([
        'category_id' => $kategori3->id,
        'title' => 'AI Future Summit',
        'description' => 'Seminar AI dan teknologi.',
        'date' => '2026-05-05 08:00:00',
        'location' => 'Auditorium',
        'price' => 75000,
        'stock' => 80,
        'poster_path' => 'posters/event5.png',
    ]);

    \App\Models\Event::create([
        'category_id' => $kategori3->id,
        'title' => 'Cyber Security Talk',
        'description' => 'Seminar keamanan digital.',
        'date' => '2026-05-06 10:00:00',
        'location' => 'Ruang Seminar',
        'price' => 40000,
        'stock' => 60,
        'poster_path' => 'posters/event6.png',
    ]);
}
}