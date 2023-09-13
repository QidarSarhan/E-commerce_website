<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'type' => 'admin',
        ]);

        \App\Models\User::factory(10)->create([
            'type' => 'user',
        ]);

        \App\Models\Category::factory(20)->create([
            'parent_id' => 0,

        ]);
    }
}
