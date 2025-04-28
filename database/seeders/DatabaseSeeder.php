<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Membuat user admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Membuat 20 kategori
        Categorie::factory(20)->create();

        // Membuat 100 artikel dummy
        Article::factory(100)->create();

        // Membuat 10 tag
        Tag::factory(10)->create();
    }
}
