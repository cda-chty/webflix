<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(5)->create();
        Category::factory()->create(['name' => 'Action']);

        Movie::factory(100)->create(function () {
            // 100 fois une catégorie aléatoire
            return ['category_id' => rand(1, 6)];
        });
    }
}
